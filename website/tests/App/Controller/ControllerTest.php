<?php

namespace App\Controller;

use PHPUnit\Framework\TestCase;

/**
 * ControllerTest.php
 *
 * Classe de tests de la classe <code>Controller</code>.
 *
 * @see Controller
 *
 * @author Alexandre SBEGHEN
 */
class ControllerTest extends TestCase {

    /**
     * Vérifie que les noms des méthodes
     * sont bien formatés.
     *
     * @return void
     */
    public function testGetMethodFromArg() {
        $this->assertSame('requestLogin', Controller::getMethodFromArg('login'));
        $this->assertSame('requestForgotPassword', Controller::getMethodFromArg('forgot_password'));
        $this->assertSame('requestHello', Controller::getMethodFromArg('__hello'));
        $this->assertSame('requestABC', Controller::getMethodFromArg('__a_b_c'));
    }
}
