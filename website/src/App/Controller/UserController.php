<?php

namespace App\Controller;


class UserController extends controller
{
    public const ROUTABLE = true;

    public function requestAuthentification(array $args): void
    {
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

    public function requestLogin(array $args): void{
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->requestAuthentification($args);
            return;
        }
        (new \App\View\User\LoginView())->show();
    }

    public function requestLogout(array $args): void{
        // Vider le tableau de session
        $_SESSION = [];

        // Détruire la session côté serveur
        session_destroy();

        // Rediriger
        header('Location: /');
        exit;
    }

    public function requestDeleteAccount(array $args): void{
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            (new \App\View\User\DeleteAccountView())->show();
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            header('Allow: POST');
            exit();
        }

        if(!isset($_SESSION["user"])){
            header('Location: /login');
            exit;
        }

        if (($_POST['confirm'] ?? '') !== 'yes'){
            (new \App\View\User\DeleteAccountView())->show();
            return;
        }

        $user = $_SESSION["user"];
        $id = $user['user_id'] ?? null;

        if ($id === null) {
            header('Location: /login');
            exit;
        }
        if (!(new UserModel())->deleteUser($id)){
            $_SESSION['error_message'] = "Erreur lors la suppression de l'utilisateur";
            header( 'Location: /profile');
            exit;
        }

        $_SESSION = [];
        session_destroy();
        header('Location: /login');
        exit;
    }

    public function requestRegister(array $args): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processRegister();
            return;
        }

        // Affichage de la vue d'inscription
        (new \App\View\User\RegisterView())->show();
    }

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

    public function requestProfile(array $args): void{
        if(!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        (new \App\View\User\ProfileView())->show($_SESSION['user']);
    }





}