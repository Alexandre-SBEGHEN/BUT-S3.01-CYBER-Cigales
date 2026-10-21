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

    /**
     * @param string $method Méthode de l'URL à exécuter
     * @param array $args Arguments de la méthode
     */
    public function __construct(string $method, array $args) {
        parent::__construct($method, $args);
    }

    public function execute(): void {
        parent::execute();
        $view = new HomeView();
        $view->show();
    }
}