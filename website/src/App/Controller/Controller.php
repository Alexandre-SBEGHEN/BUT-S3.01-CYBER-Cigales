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
}