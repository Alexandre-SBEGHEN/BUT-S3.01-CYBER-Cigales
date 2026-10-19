<?php

namespace App\Core;

use PHPUnit\Framework\TestCase;

/**
 * RouterTest.php
 *
 * Classe de tests de la classe <code>Router</code>.
 *
 * @see Router
 *
 * @author Alexandre SBEGHEN
 */
class RouterTest extends TestCase {

    /**
     * Vérifie que les chemins vers les contrôleurs
     * sont bien formatés.
     *
     * @return void
     */
    public function testGetControllerFromArg() {
        $expectedPaths = array(
            '' => 'App\\Controller\\HomeController',
            'hello' => 'App\\Controller\\HelloController',
            'hello_world' => 'App\\Controller\\HelloWorldController',
            '__a__b_c' => 'App\\Controller\\ABCController',
        );
        foreach ($expectedPaths as $path => $class)
            self::assertSame($class, Router::getControllerFromArg($path));
    }
}
