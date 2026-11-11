<?php

namespace App\Core;

use PDO;

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
    // private static string $rootDir;
    private static ?Env $env;

    private static ?PDO $PDO = null;

    private static bool $databaseConnected;

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
        // self::$rootDir = $rootDir;
        self::$env = null;

        // Parsing du .env
        if (!is_file($envPath))
            return 1;
        self::$env = new Env($envPath);

        // Niveau d'activation des erreurs et warnings
        error_reporting(self::$env->getPhpErrorReporting());

        $servername = self::$env->getConfig('database', 'host');
        $dbname     = self::$env->getConfig('database', 'dbname');
        $username   = self::$env->getConfig('database', 'username');
        $password   = self::$env->getConfig('database', 'password');

        try {
            self::$PDO = new \PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            self::$databaseConnected = true;
        } catch (\PDOException $e) {
            self::$PDO = null;
            self::$databaseConnected = false;
            throw new \Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }

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

    /**
     * Permet d'obtenir la connexion PDO partagée par tout le site.
     *
     * @return PDO|null Connexion à la base de données, ou null si elle n'est pas établie.
     */
    public static function getPDO(): ?\PDO {
        return self::$PDO;
    }

    /**
     * Indique si la connexion à la base de données a réussi.
     *
     * @return bool true si la base est connectée, false sinon.
     */
    public static function isDatabaseConnected(): bool {
        return self::$databaseConnected;
    }
}