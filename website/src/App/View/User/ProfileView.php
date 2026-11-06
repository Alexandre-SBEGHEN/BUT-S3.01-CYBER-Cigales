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

namespace App\View\User;
use App\View\TemplateView;

class ProfileView {
    /**
     * affiche la page profil de l'utilisateur
     * @return void
     */
    public function show(array $user): void {

        $username = htmlspecialchars($user['first_name'] ?? '', ENT_QUOTES, 'UTF-8');
        $nom      = htmlspecialchars($user['last_name'] ?? '', ENT_QUOTES, 'UTF-8');
        $mail     = htmlspecialchars($user['mail'] ?? '', ENT_QUOTES, 'UTF-8');
        $date     = htmlspecialchars($user['created_date'] ?? '', ENT_QUOTES, 'UTF-8');


        TemplateView::htmlBegin(
            'Profil - Cyber Cigales',
            'page profile de l utilisateur',
            ['reset.css','fonts.css', 'header.css', 'footer.css', 'profile.css']
        );
        TemplateView::pageHeader();
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

        TemplateView::pageFooter();
        TemplateView::htmlEnd();
    }
}
