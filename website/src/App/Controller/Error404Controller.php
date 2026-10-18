<?php

namespace App\Controller;

use App\View\Error404View;

/**
 * Error404Controller.php
 *
 * S'exécute quand la ressource
 * désirée n'est pas trouvée.
 *
 * @author Alexandre SBEGHEN
 */
class Error404Controller {
    public function execute(): void {
        $view = new Error404View();
        $view->show();
    }
}