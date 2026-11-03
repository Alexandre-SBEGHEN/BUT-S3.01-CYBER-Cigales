<?php
/**
 * profile.php
 *
 * page qui dérige l'utilisateur lors de la connection
 *
 * affiche un petite message pour affirmer qu'il est connecter
 *
 * &author Kawthar CHAIB EDDOUR
 */
namespace modules\views;

class ProfileView {
    /**
     * affiche la page profil de l'utilisateur
     * @return void
     */
    public function show(\modules\models\user_model $user): void {


        $username = htmlspecialchars($user->getPrenom(), ENT_QUOTES, 'UTF-8');
        $nom = htmlspecialchars($user->getNom(), ENT_QUOTES, 'UTF-8');
        $mail = htmlspecialchars($user->getAdresseMail(), ENT_QUOTES, 'UTF-8');
        $date = htmlspecialchars($user->getDateCreation(), ENT_QUOTES, 'UTF-8');


        template_view::html_begin(
            'Profil - Cyber Cigales',
            'page profile de l utilisateur',
            ['reset.css','fonts.css', 'header.css', 'footer.css', 'profile.css']
        );
        template_view::page_header('profile');
        echo <<< HTML
        <main class="profil">
        <h1 class="title">Mon profil</h1>
        <section class="intro">
            <h2>Bonjour {$username} 👋</h2>
            <p>Vous êtes bien connecté</p>
        </section>
        <section class="infos">
            <h3>Mes informations</h3>
            <ul class="cards">
                <li>
                <h3>Nom</h3>
                <p>{$nom}</p>
                </li>
                
                <li>
                <h3>Prénom</h3>
                <p>{$username}</p>
                </li>
                
                <li>
                <h3>Adresse mail</h3>
                <p>{$mail}</p>
                </li>
                
                <li>
                <h3>Membre depuis</h3>
                <p>{$date}</p>
                </li>
            </ul>
        </section>
        <section class="logout">
                <a class="btn" href="/logout">Se déconnecter</a>
                <a class="btn" href="/delete_account">Supprimer mon compte</a>
              
               
        </section>
         
        </main>
HTML;

        template_view::page_footer();
        template_view::html_end();
    }
}
