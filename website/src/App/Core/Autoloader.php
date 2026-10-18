<?php

/**
 * Autoloader.php
 *
 * Permet de charger automatiquement
 * les classes du projet, à condition
 * qu'elles soient dans le namespace App.
 *
 * @author Alexandre SBEGHEN
 */
class Autoloader {
    /**
     * Exécution de l'autoloader.
     *
     * @return void
     */
    public static function load(): void {
        spl_autoload_register(function (string $class) {
            // Charger la classe
            $path = dirname(__DIR__, 2) . '/' . str_replace('\\', '/', $class) . '.php';
            if (is_file($path))
                require $path;
        });
    }
}

// Exécution automatique lors du require
Autoloader::load();