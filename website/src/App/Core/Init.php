<?php

namespace App\Core;

/**
 * Init.php
 *
 * Contient toutes les informations qui doivent
 * être globales à TOUS les scripts.
 *
 * Cela peut être relatif à la base de données,
 * aux pages HTML, etc. Tout ce qui doit être
 * récupéré plusieurs fois est stocké ici.
 *
 * @author Alexandre SBEGHEN
 */
class Init {
    private static string $rootDir;
    private static ?Env $env;

    /**
     * Initialisation du site web.
     *
     * Permet d'initialiser les constantes qui
     * seront plus tard utilisées un peu partout
     * dans le site web.
     *
     * @param string $rootDir Le répertoire de la racine
     * @param string $envPath Chemin vers le <code>.env</code>.
     * @return int Code de sortie (0 = succès, échec si autre)
     */
    public static function init(string $rootDir, string $envPath): int {
        // Initialisation des variables globales
        self::$rootDir = $rootDir;
        self::$env = null;

        // Parsing du .env
        if (!is_file($envPath))
            return 1;
        self::$env = new Env($envPath);

        // Niveau d'activation des erreurs et warnings
        error_reporting(self::$env->getPhpErrorReporting());

        return 0;
    }

    /**
     * Permet d'obtenir l'instance Env des variables d'environnement.
     *
     * @return Env Instance de l'environnement.
     */
    public static function getEnv(): Env {
        return self::$env;
    }
}