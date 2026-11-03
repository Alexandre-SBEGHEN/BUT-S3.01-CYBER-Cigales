<?php

namespace App\View;

use App\Core\Init;
use App\Core\Env;

/**
 * HomeView.php
 *
 * Affichage de la page d'accueil.
 *
 * @author Alexandre SBEGHEN
 */
class HomeView {

    /**
     * Afficher la page d'accueil en HTML.
     *
     * @return void
     */
    public function show(): void {
        TemplateView::htmlBegin(
            'Ateliers CYBER & Crypto',
            'Participez à un escape game numérique interactif unique. Apprenez les notions clés de la sécurité informatique à travers des énigmes et des mini-jeux.',
                ['reset.css', 'fonts.css', 'main.css']
        );
        TemplateView::pageHeader(); ?>
    <main>
        <section class="hero">
            <h1 class="hero__title">Bienvenue !</h1>
            <h2 class="hero__text">Apprends à protéger tes données personnelles !</h2>
            <a class="hero__button button" href="/login">Commencer</a>
        </section>

        <section class="steps">
            <h2 class="steps__title">Le principe</h2>
            <ol class="steps__list">
<?php
                $steps = [
                    ['name' => 'Connecte-toi', 'desc' => 'Crée ton compte pour sauvegarder ta progression.'],
                    ['name' => 'Résous les énigmes', 'desc' => 'Chaque énigme parle d\'un risque en particulier !'],
                    ['name' => 'Réussis à t\'échapper', 'desc' => 'Termine le jeu et retiens les bonnes méthode !']
                ];
                for ($i = 0; $i < count($steps); ++$i): $step = $steps[$i]; ?>
                <li class="steps__item">
                    <h3 class="steps__item-title"><?= $step['name'] ?></h3>
                    <p class="steps__item-text"><?= $step['desc'] ?></p>
                </li>
<?php endfor; ?>
            </ol>
        </section>
    </main>
<?php
        TemplateView::pageFooter();
        TemplateView::htmlEnd();
    }
}