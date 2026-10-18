<?php
/**
 * index.php
 *
 * Point d'entrée du site web.
 *
 * C'est ici qu'est initialisé le routeur
 * pour rediriger vers les bonnes pages.
 *
 * @author Alexandre SBEGHEN
 */

use App\Core\Init;
use App\Core\Router;
use App\Controller\HomeController;

// Charger automatiquement les classes
require_once '../src/App/Core/Autoloader.php';

// Initialisation du site
Init::init(dirname(__DIR__), dirname(__DIR__) . '/.env');

// Routage
$path = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') ?: '/';
$router = new Router(array(
    '/' => HomeController::class
));
$router->execute($path);