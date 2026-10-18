<?php

namespace App\Core;

use App\Controller\Error404Controller;
use Exception;

/**
 * Router.php
 *
 * Routeur du site web.
 *
 * Permet d'accéder aux différentes pages
 * du site web via l'URL. Si la page /
 * le fichier / le dossier cherché ne sont
 * pas trouvés, une réponse 404 est renvoyée
 * et une page personnalisée peut être affichée.
 *
 * @author SBEGHEN Alexandre
 */
class Router {
    private array $routes;

    public function __construct(array $routes) {
        $this->routes = $routes;
    }

    /**
     * Exécution du routeur.
     *
     * Cherche à partir du chemin et de la table
     * de routage la page désirée. Renvoie une
     * erreur 404 si la page / fichier / dossier
     * sont introuvables.
     *
     * @param string $uri Chemin vers la ressource (URI)
     * @return void
     */
    public function execute(string $uri): void {
        try {
            // Erreur 404 si la page n'existe pas
            if (!array_key_exists($uri, $this->routes))
                throw new Exception("Route not found: $uri");

            // Exécuter le contrôleur de la page
            $controller = new $this->routes[$uri]();
            $controller->execute();
        } catch (Exception $e) {
            http_response_code(404);
            $controller = new Error404Controller();
            $controller->execute();
        }
    }
}