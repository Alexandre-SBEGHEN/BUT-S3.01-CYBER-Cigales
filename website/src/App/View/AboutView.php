<?php

namespace App\View;

use App\Core\Init;
use App\Core\Env;

/**
 * HomeView.php
 *
 * Affichage de la page à propos.
 *
 * @author Alexandre SBEGHEN
 */
class AboutView {

    /**
     * Afficher la page à propos en HTML.
     *
     * @return void
     */
    public function show(): void {
        TemplateView::htmlBegin(
            'A propos',
            'Qui sommes-nous ? Découvrez notre équipe.',
        );
        TemplateView::pageHeader();
        echo <<< HTML
    <main>
        <h1>A propos de nous</h1>
        <ul>
            <li>BARTAL Manal</li>
            <li>CHAIB EDDOUR ITIM Kawthar</li>
            <li>GOUIN Gabriel</li>
            <li>SBEGHEN Alexandre</li>
        </ul>
    </main>
HTML;
        TemplateView::pageFooter();
        TemplateView::htmlEnd();
    }
}