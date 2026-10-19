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
    public function testSnakeCase2PascalCase() {
        // Avec un '_'
        $this->assertSame('Hello', Util::snakeCase2PascalCase('hello'));
        $this->assertSame('HelloWorld', Util::snakeCase2PascalCase('hello_world'));
        $this->assertSame('FooBar', Util::snakeCase2PascalCase('foo_bar'));
        $this->assertSame('Foobar', Util::snakeCase2PascalCase('foobar'));

        // Avec un '_'
        $this->assertSame('Hello', Util::snakeCase2PascalCase('hello'));
        $this->assertSame('HelloWorld', Util::snakeCase2PascalCase('hello-world'));
        $this->assertSame('FooBar', Util::snakeCase2PascalCase('foo-bar'));
        $this->assertSame('Foobar', Util::snakeCase2PascalCase('foobar'));

        // Divers
        $this->assertSame('', Util::snakeCase2PascalCase(''));
        $this->assertSame('A', Util::snakeCase2PascalCase('_a'));
        $this->assertSame('A', Util::snakeCase2PascalCase('__a__'));
        $this->assertSame('ABC', Util::snakeCase2PascalCase('__a__b_c'));
    }
}
