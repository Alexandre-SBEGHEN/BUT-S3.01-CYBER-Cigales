<?php

namespace App\Controller;

use App\View\ErrorView;

/**
 * ErrorController.php
 *
 * S'exécute quand une erreur survient
 * dans le site.
 *
 * Peut renvoyer une réponse HTTP avec
 * le codede l'erreur
 *
 * @author Alexandre SBEGHEN
 */
class ErrorController extends Controller {
    public const ROUTABLE = false;

    /**
     * @param int $errorCode Code d'erreur HTTP à renvoyer
     * @param string $errorMessage Message court.
     * @param string $errorDescription Descriptif plus long de l'erreur.
     */
    public function __construct(private int $errorCode, private string $errorMessage, private string $errorDescription) {}

    public function execute(): void {
        http_response_code($this->errorCode);
        $view = new ErrorView($this->errorCode, $this->errorMessage, $this->errorDescription);
        $view->show();
    }
}