<?php

namespace App\View;

/**
 * LegalView.php
 *
 * Affichage de la page des mentions légales
 *
 * @author Kawthar CHAIB EDDOUR
 */
class LegalView {
    /**
     * Afficher la page des mentions légales en HTML
     *
     * @return void
     */
    public function show(): void {
        TemplateView::htmlBegin(
            'Mentions Légales',
            'Consultez les mentions légales du site pour en savoir plus sur l\'éditeur du site, l\'hébergement, la propriété intellectuelle et vos droits.'
        );
        TemplateView::pageHeader(); ?>
    <main>

    </main>
<?php
        TemplateView::htmlEnd();
    }
}