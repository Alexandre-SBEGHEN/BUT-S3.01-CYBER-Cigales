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
class AboutController extends Controller {
    public const ROUTABLE = true;

    public function execute(): void {
        $view = new AboutView();
        $view->show();
    }
}