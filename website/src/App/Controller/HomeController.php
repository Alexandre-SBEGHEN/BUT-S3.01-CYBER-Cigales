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
class HomeController extends Controller{
    public const ROUTABLE = true;

    public function execute(): void {
        $view = new HomeView();
        $view->show();
    }
}