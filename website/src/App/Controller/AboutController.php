<?php

namespace App\Controller;

use App\View\AboutView;

/**
 * AboutController.php
 *
 * Contrôleur de la page à propos.
 *
 * @author Alexandre SBEGHEN
 */
class AboutController {
    public function execute(): void {
        $view = new AboutView();
        $view->show();
    }
}