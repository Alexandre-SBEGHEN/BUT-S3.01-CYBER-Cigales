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
        );
        TemplateView::pageHeader();
        echo <<< HTML
    <main>
        <h1>CYBER Cigales</h1>
        <p>Un escape game numérique interactif permettant de découvrir les notions fondamentales de la sécurité informatique à travers une série d’énigmes et de mini-jeux.</p>
    </main>
HTML;
        TemplateView::pageFooter();
        TemplateView::htmlEnd();
    }
}