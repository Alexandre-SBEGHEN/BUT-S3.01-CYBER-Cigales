<?php

namespace App\Controller;

use App\Core\Util;

/**
 * Controller.php
 *
 * Classe abstraite d'un contrôleur.
 * Implémente des méthodes communes à
 * tous les contrôleurs.
 *
 * @author Alexandre SBEGHEN
 */
abstract class Controller {
    private string $method;
    private array $args;

    /**
     * @param string $method Méthode de l'URL à exécuter
     * @param array $args Arguments de la méthode
     */
    public function __construct(string $method, array $args) {
        $this->method = (!empty($method)) ? self::getMethodFromArg($method) : '';
        $this->args = $args;
    }

    /**
     * Formate une string pour obtenir
     * le nom de la méthode de contrôleur
     * désirée dans l'URL.
     *
     * Exemples :
     * <pre>
     *     'login' => 'requestLogin'
     *     'forgot-password' => 'requestForgotPassword'
     * </pre>
     *
     * <strong>NOTE :</strong> Il n'y a pas de vérification de l'existence
     * (ou non) de la méthode renvoyée, on se charge ici
     * seulement de formatter la string.
     *
     * @param string $arg Argument à formater en classe.
     * @return string Méthode supposée du contrôleur.
     *
     * @see Util::snake2Pascal()
     */
    public static function getMethodFromArg(string $arg): string {
        return 'request' . Util::snake2Pascal($arg);
    }
    public function execute(): void {
        // Pas de méthode à exécuter
        if (empty($this->method))
            return;

        // Erreur 404 si elle n'existe pas
        if (!method_exists($this, $this->method)) {
            $controller = new ErrorController('', [],
                404,
                "Oups... Une erreur est survenue",
                "La ressource désirée est introuvable."
            );
            $controller->execute();
            exit;
        }

        // Elle existe -> on l'exécute
        $this->{$this->method}($this->args);
    }
}