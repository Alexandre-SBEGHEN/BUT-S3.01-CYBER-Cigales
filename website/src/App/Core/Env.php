<?php

namespace App\Core;

/**
 * Env.ini
 *
 * Permet d'accéder aux variables d'environnement
 * du site web, si jamais il y a connexion à une BD
 * qui est nécessaire.
 *
 * @author Alexandre SBEGHEN
 */
class Env {
    private int $phpErrorReporting;
    private array $iniData = [];

    /**
     * Constructeur de Env.
     *
     * Récupère les informations du .env sous forme
     * de tableau associatif et donne les bonnes
     * valeurs aux propriétés.
     *
     * @param string $envPath Chemin vers le <code>.env</code>.
     */
    public function __construct(string $envPath) {
        // Parsing du .env
        $this->iniData = parse_ini_file($envPath, true) ?: [];

        // Section PHP
        $this->phpErrorReporting = isset($this->iniData['php']['error_reporting'])
            ? (int)$this->iniData['php']['error_reporting']
            : 32767;
    }

    /**
     * Permet d'obtenir le niveau de report
     * des erreurs et warning.
     *
     * @return int Niveau de report d'erreurs.
     */
    public function getPhpErrorReporting(): int {
        return $this->phpErrorReporting;
    }

    public function getConfig(string $section, string $key) {
        return $this->iniData[$section][$key] ?? null;
    }

}