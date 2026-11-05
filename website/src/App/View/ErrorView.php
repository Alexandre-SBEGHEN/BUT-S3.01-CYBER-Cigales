<?php

namespace App\View;

/**
 * ErrorView.php
 *
 * Affichage de la page d'erreur.
 *
 * @author Alexandre SBEGHEN et Kawthar CHAIB EDDOUR
 */
class ErrorView {

    /**
     * @param int $errorCode Code d'erreur HTTP à renvoyer
     * @param string $errorMessage Message court.
     * @param string $errorDescription Descriptif plus long de l'erreur.
     */
    public function __construct(private int $errorCode, private string $errorMessage, private string $errorDescription) {}

    /**
     * Afficher la page d'erreur en HTML.
     *
     * @return void
     */
    public function show(): void {
        TemplateView::htmlBegin(
            "Erreur $this->errorCode",
            'Une erreur est survenue. Utilisez notre menu de navigation ou retournez à l\'accueil pour poursuivre votre visite.',
                ['reset.css', 'fonts.css', 'main.css']
        );
        TemplateView::pageHeader();?>
    <main>
        <section class="hero">
            <h1 class="hero__title"><?= $this->errorMessage ?> </h1>
            <p class="hero__text"><?= $this->errorDescription ?></p>
            <a class="hero__button button" href="/.">Retour à l'accueil</a>
        </section>
    </main>
<?php
        TemplateView::pageFooter();
        TemplateView::htmlEnd();
    }
}