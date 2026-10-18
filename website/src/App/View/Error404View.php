<?php

namespace App\View;

/**
 * Error404View.php
 *
 * Affichage de la page d'erreur 404.
 *
 * @author Alexandre SBEGHEN
 */
class Error404View {
    public function show(): void {
        TemplateView::htmlBegin(
            'Erreur 404',
            'Oups ! La page que vous recherchez est introuvable ou a été déplacée. Utilisez notre menu de navigation ou retournez à l\'accueil pour poursuivre votre visite.'
        );
        echo <<< HTML
    <main>
        <h1>Oups...</h1>
        <p>L'URL demandée est introuvable sur ce serveur.</p>
    </main>
HTML;
        TemplateView::htmlEnd();
    }
}