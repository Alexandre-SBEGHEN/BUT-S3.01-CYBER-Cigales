<?php

namespace App\Core;

use App\Controller\ErrorController;
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
    private array $args;

    public function __construct(array $args) {
        $this->args = $args;
    }

    /**
     * Formate une string pour obtenir
     * le chemin vers le contrôleur associé.
     * Une string vide renvoie par défaut le
     * chemin contrôleur de la page d'accueil
     * <code>HomeController</code>.
     *
     * Exemples :
     * <pre>
     *     '' => 'App\\Controller\\HomeController'
     *     'home' => 'App\\Controller\\HomeController'
     *     'bonjour' => 'App\\Controller\\BonjourController'
     *     'AbCD' => 'App\\Controller\\AbcdController'
     * </pre>
     *
     * <strong>NOTE :</strong> Il n'y a pas de vérification de l'existence
     * (ou non) de la classe renvoyée, on se charge ici
     * seulement de formatter la string.
     *
     * @param string $arg Argument à formater en classe.
     * @return string Chemin vers le contrôleur supposé de la classe.
     *
     * @see Util::snake2Pascal()
     */
    public static function getControllerFromArg(string $arg): string {
        // Convertir l'argument en PascalCase
        $className = (empty($arg) ? 'Home' : Util::snake2Pascal($arg)) . 'Controller';
        $classPath = 'App\\Controller\\' . $className;

        return $classPath;
    }

    /**
     * Exécution du routeur.
     *
     * Exécute automatiquement le contrôleur
     * associé au premier argument, formaté
     * via <code>getControllerFromArg()</code>.
     *
     * Si la classe du contrôleur n'existe pas ou
     * que la classe n'est pas routable (<code>ROUTABLE = false</code>)
     * alors une erreur 404 est renvoyée et la
     * page d'erreur s'affiche.
     *
     * @return void
     *
     * @see getControllerFromArg()
     */
    public function execute(): void {
        try {
            // Erreur si la classe n'existe pas ou si le contrôleur n'est pas routable
            $class = $this->getControllerFromArg($this->args[0]);
            if (!class_exists($class))
                throw new Exception("Class not found: $class");
            if (!defined("$class::ROUTABLE") || !$class::ROUTABLE)
                throw new Exception("Unauthorized controller: $class");

            // Exécuter le contrôleur de la page
            $controller = new $class;
            $controller->execute();
        } catch (Exception) {
            $controller = new ErrorController(
                404,
                "Oups... Une erreur est survenue",
                "La ressource désirée est introuvable."
            );
            $controller->execute();
        }
    }
}