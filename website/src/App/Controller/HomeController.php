<?php

namespace App\Controller;

use App\View\HomeView;

/**
 * HomeController.php
 *
 * Contrôleur de la page d'accueil.
 *
 * @author Alexandre SBEGHEN
 */
class HomeController {
    public function execute(): void {
        $view = new HomeView();
        $view->show();
    }
}