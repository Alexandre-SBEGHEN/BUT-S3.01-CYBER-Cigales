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





}