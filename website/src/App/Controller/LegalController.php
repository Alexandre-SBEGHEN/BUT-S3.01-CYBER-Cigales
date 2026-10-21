<?php

namespace App\Controller;

/**
 * LegalController.php
 *
 * Contrôleur de la page mentions légales.
 *
 * @author Kawthar CHAIB EDDOUR
 */
class LegalController {
    public const ROUTABLE = true;

    public function execute(): void {
        echo 'page de mention légale';
    }
}