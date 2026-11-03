<?php

namespace App\Controller;

use App\View\LegalView;

/**
 * LegalController.php
 *
 * Contrôleur de la page mentions légales.
 *
 * @author Kawthar CHAIB EDDOUR
 */
class LegalController {
    public const ROUTABLE = true;

    public function execute(): void {
        $view = new LegalView();
        $view->show();
    }
}