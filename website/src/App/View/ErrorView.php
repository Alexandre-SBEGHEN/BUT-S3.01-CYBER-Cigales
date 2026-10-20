<?php

namespace App\View;

/**
 * ErrorView.php
 *
 * Affichage de la page d'erreur.
 *
 * @author Alexandre SBEGHEN
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
            'Une erreur est survenue. Utilisez notre menu de navigation ou retournez à l\'accueil pour poursuivre votre visite.'
        ); ?>
    <main>
        <h1><?= $this->errorMessage ?></h1>
        <p><?= $this->errorDescription ?></p>
    </main>
<?php
        TemplateView::htmlEnd();
    }
}