<?php

namespace App\Core;

use PHPUnit\Framework\TestCase;

/**
 * UtilTest.php
 *
 * Classe de tests de la classe <code>Util</code>.
 *
 * @see Util
 *
 * @author Alexandre SBEGHEN
 */
class UtilTest extends TestCase {

    /**
     * Vérifier que la conversion <code>snake_case</code> -> <code>PascalCase</code>
     * fonctionne pour les tirets <code>-</code> et les tirets du bas <code>_</code>.
     *
     * @return void
     */
    public function testSnake2Pascal() {
        // Avec un '_'
        $this->assertSame('Hello', Util::snake2Pascal('hello'));
        $this->assertSame('HelloWorld', Util::snake2Pascal('hello_world'));
        $this->assertSame('FooBar', Util::snake2Pascal('foo_bar'));
        $this->assertSame('Foobar', Util::snake2Pascal('foobar'));

        // Avec un '_'
        $this->assertSame('Hello', Util::snake2Pascal('hello'));
        $this->assertSame('HelloWorld', Util::snake2Pascal('hello-world'));
        $this->assertSame('FooBar', Util::snake2Pascal('foo-bar'));
        $this->assertSame('Foobar', Util::snake2Pascal('foobar'));

        // Divers
        $this->assertSame('', Util::snake2Pascal(''));
        $this->assertSame('A', Util::snake2Pascal('_a'));
        $this->assertSame('A', Util::snake2Pascal('__a__'));
        $this->assertSame('ABC', Util::snake2Pascal('__a__b_c'));
    }

    /**
     * Vérifier que la conversion <code>snake_case</code> -> <code>PascalCase</code>
     * fonctionne pour les tirets <code>-</code> et les tirets du bas <code>_</code>.
     *
     * @return void
     */
    public function testSnake2Camel() {
        // Avec un '_'
        $this->assertSame('hello', Util::snake2Camel('hello'));
        $this->assertSame('helloWorld', Util::snake2Camel('hello_world'));
        $this->assertSame('fooBar', Util::snake2Camel('foo_bar'));
        $this->assertSame('foobar', Util::snake2Camel('foobar'));

        // Avec un '_'
        $this->assertSame('hello', Util::snake2Camel('hello'));
        $this->assertSame('helloWorld', Util::snake2Camel('hello-world'));
        $this->assertSame('fooBar', Util::snake2Camel('foo-bar'));
        $this->assertSame('foobar', Util::snake2Camel('foobar'));

        // Divers
        $this->assertSame('', Util::snake2Camel(''));
        $this->assertSame('A', Util::snake2Camel('_a'));
        $this->assertSame('A', Util::snake2Camel('__a__'));
        $this->assertSame('ABC', Util::snake2Camel('__a__b_c'));
    }
}
