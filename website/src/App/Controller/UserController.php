<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Model\TokenModel;

/**
 * UserController.php
 *
 * Contrôleur des pages liées à l'utilisateur :
 * connexion, inscription, profil, suppression de compte
 * et réinitialisation du mot de passe.
 */
class UserController extends Controller
{
    public const ROUTABLE = true;

    /**
     * Vérifie les identifiants envoyés par le formulaire de connexion.
     * Ouvre la session puis redirige vers /profile, ou revient sur /login avec une erreur.
     *
     * @param array $args Arguments de l'URL (inutilisés).
     * @return void
     */
    public function requestAuthentification(array $args): void {
        $mail = trim($_POST["mail"] ?? '');
        if (empty($mail)) {
            $_SESSION["error"] = "Merci de remplir l'email.";
            header('Location: /login');
            exit;
        }

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"] = "Adresse email invalide.";
            header('Location: /login');
            exit;
        }

        $password = trim($_POST["password"] ?? '');
        if ($password === '') {
            $_SESSION["error"] = "Merci de remplir le mot de passe.";
            header('Location: /login');
            exit;
        }

        // Utilisation de repository et de la méthode find_email
        $userRepository = new \App\Model\UserModel();
        $user = $userRepository->findEmail($mail);

        if ($user === null) {
            $_SESSION["error"] = "Email ou mot de passe incorrect.";
            header('Location: /login');
            exit;
        }

        // Comme find_email retourne un objet user_model, on utilise le getter
        if (!password_verify($password, $user['password_hash'])) {
            $_SESSION["error"] = "Email ou mot de passe incorrect.";
            header('Location: /login');
            exit;
        }

        // Nouvel id de session après la connexion (évitequ'un attaquant utilise cet id de session)
        session_regenerate_id(true);

        // On stocke que l'id car l'objet contient le hash du mot de passe)
        $_SESSION['user_id'] = $user['user_id'];
        // on a beosin de la ligne car on doit récuperer les infos de l'utilisateur
        $_SESSION['user'] = $user;

        header('Location: /profile');
        exit;
    }

    /**
     * Affiche la page de connexion (GET) ou traite le formulaire (POST).
     *
     * @param array $args Arguments de l'URL (inutilisés).
     * @return void
     */
    public function requestLogin(array $args): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
            $this->requestAuthentification($args);

        (new \App\View\User\LoginView())->show();
    }

    /**
     * Détruit la session de l'utilisateur et redirige vers l'accueil.
     *
     * @param array $args Arguments de l'URL (inutilisés).
     * @return void
     */
    public function requestLogout(array $args): void
    {
        // Vider le tableau de session
        $_SESSION = [];

        // Détruire la session côté serveur
        session_destroy();

        // Rediriger
        header('Location: /');
        exit;
    }

    /**
     * Affiche la confirmation (GET) puis supprime le compte connecté (POST).
     * Redirige vers /login si l'utilisateur n'est pas connecté.
     *
     * @param array $args Arguments de l'URL (inutilisés).
     * @return void
     */
    public function requestDeleteAccount(array $args): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            (new \App\View\User\DeleteAccountView())->show();
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            header('Allow: POST');
            exit();
        }

        if (!isset($_SESSION["user"])) {
            header('Location: /login');
            exit;
        }

        if (($_POST['confirm'] ?? '') !== 'yes') {
            (new \App\View\User\DeleteAccountView())->show();
            return;
        }

        $user = $_SESSION["user"];
        $id = $user['user_id'] ?? null;

        if ($id === null) {
            header('Location: /login');
            exit;
        }
        if (!(new UserModel())->deleteUser($id)) {
            $_SESSION['error_message'] = "Erreur lors la suppression de l'utilisateur";
            header('Location: /profile');
            exit;
        }

        $_SESSION = [];
        session_destroy();
        header('Location: /login');
        exit;
    }

    /**
     * Affiche la page d'inscription (GET) ou traite le formulaire (POST).
     *
     * @param array $args Arguments de l'URL (inutilisés).
     * @return void
     */
    public function requestRegister(array $args): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processRegister();
            return;
        }

        // Affichage de la vue d'inscription
        (new \App\View\User\RegisterView())->show();
    }

    /**
     * Affiche la page de profil de l'utilisateur connecté.
     * Redirige vers /login si aucune session n'est ouverte.
     *
     * @param array $args Arguments de l'URL (inutilisés).
     * @return void
     */
    public function requestProfile(array $args): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        (new \App\View\User\ProfileView())->show($_SESSION['user']);
    }

    /**
     * Affiche le formulaire « mot de passe oublié » (GET) ou génère un token
     * et envoie le lien de réinitialisation par mail (POST).
     * Le message affiché est identique que l'adresse existe ou non.
     *
     * @param array $args Arguments de l'URL (inutilisés).
     * @return void
     */
    public function requestForgotPassword(array $args): void
    {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $mail = trim($_POST["mail"] ?? '');

                if (empty($mail)) {
                    $_SESSION["error"] = "Merci de remplir l'email.";
                    header('Location: /forgot-password');
                    exit;
                }

                if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION["error"] = "Adresse email invalide.";
                    header('Location: /forgot-password');
                    exit;
                }

                $user_repository = new UserModel();
                $token_repository = new TokenModel();
                $user = $user_repository->findEmail($mail);

                // Message générique de sécurité
                $_SESSION["success"] = "Si cet email est associé à un compte, un lien de réinitialisation a été généré.";

                if ($user !== null) {
                    $token = $token_repository->createToken($user['user_id']);

                    if ($token !== false) {
                        $resetLink = 'http://' . $_SERVER['HTTP_HOST'] . '/reset-password?token=' . $token;
                        $subject = 'Réinitialisation de votre mot de passe';
                        $message = "Bonjour,\n\nVoici votre lien de réinitialisation (valide 10 minutes) :\n$resetLink\n\nSi vous n'êtes pas à l'origine de cette demande, ignorez cet email.";

                        \App\Core\Mailer::send($mail, $subject, $message);
                    }
                }

                header('Location: /forgot-password');
                exit;
            }

            (new \App\View\User\ForgotPasswordView())->show();
    }

    /**
     * Affiche le formulaire de nouveau mot de passe (GET) ou l'enregistre (POST)
     * si le token de l'URL est valide et non expiré.
     *
     * @param array $args Arguments de l'URL (inutilisés).
     * @return void
     */
    public function requestResetPassword(array $args): void{

            $token = trim($_GET['token'] ?? $_POST['token'] ?? '');

            if (empty($token)) {
                header('Location: /login');
                exit;
            }

            $user_repository = new UserModel();
            $token_repository = new TokenModel();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $password = $_POST['password'] ?? '';
                $passwordConfirm = $_POST['password_confirm'] ?? '';

                if (empty($password) || $password !== $passwordConfirm) {
                    $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
                    header('Location: reset-password?token=' . $token);
                    exit;
                }

                $userId = $token_repository->findToken($token);

                if ($userId === null) {
                    $_SESSION['error'] = "Lien invalide ou expiré.";
                    header('Location: /forgot-password');
                    exit;
                }

                $user_repository->changePassword($userId, $password);
                $token_repository->deleteToken($userId);

                $_SESSION['success'] = "Mot de passe modifié avec succès.";
                header('Location: /login');
                exit;
            }

            $userId = $token_repository->findToken($token);
            if ($userId === null) {
                $_SESSION['error'] = "Lien invalide ou expiré.";
                header('Location: /forgot-password');
                exit;
            }

            (new \App\View\User\ResetPasswordView())->show($token);
    }

    /**
     * Valide les champs du formulaire d'inscription (champs remplis, email valide,
     * mot de passe d'au moins 12 caractères avec majuscule, minuscule, chiffre et
     * caractère spécial, email non utilisé) puis crée le compte.
     *
     * @return void
     */
    private function processRegister(): void
    {
        $prenom = trim($_POST['prenom'] ?? '');
        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['mail'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($prenom) || empty($nom) || empty($email) || empty($password)) {
            $_SESSION['error'] = "Veuillez remplir tous les champs.";
            header('Location: /register');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Adresse email invalide.";
            header('Location: /register');
            exit;
        }

        // Validation de la complexité du mot de passe
        // Min 12 caractères, 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial
        $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{12,}$/'; //utilisation de l'ia pour cette ligne et celle en dessous
        if (!preg_match($password_pattern, $password)) {
            $_SESSION['error'] = "Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
            header('Location: /register');
            exit;
        }

        $userModel = new UserModel();

        // Vérification si l'email existe déjà (attention à l'orthographe : findEmail)
        if ($userModel->findEmail($email) !== null) {
            $_SESSION['error'] = "Inscription impossible. Connecte-toi si tu as déjà un compte.";
            header('Location: /register');
            exit;
        }

        // Appel de la méthode create() avec les paramètres adaptés au UserModel
        $success = $userModel->create($nom, $prenom, $email, $password);

        if ($success) {
            $_SESSION['success'] = "Compte créé, tu peux te connecter.";
            header('Location: /login');
            exit;
        } else {
            $_SESSION['error'] = "Erreur lors de l'inscription.";
            header('Location: /register');
            exit;
        }
    }
}

