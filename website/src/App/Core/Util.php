<?php

namespace App\Core;

/**
 * Util.php
 *
 * Méthodes utilitaires.
 *
 * @author Alexandre SBEGHEN
 */
class Util {

    /**
     * Conversion générique de <code>snake_case</code>.
     *
     * @param string $snake Chaîne en <code>snake_case</code>.
     * @param bool $firstIsUpper Doit-on mettre en MAJ le premier caractère ?
     * @return string Chaîne convertie.
     */
    private static function snakeConversion(string $snake, bool $firstIsUpper): string {
        $converted = '';
        $nextIsUpper = $firstIsUpper;
        foreach (str_split($snake) as $c) {
            if ($c === '_' || $c === '-') {
                $nextIsUpper = true;
            } else if ($nextIsUpper) {
                $converted .= strtoupper($c);
                $nextIsUpper = false;
            } else {
                $converted .= $c;
            }
        }
        return $converted;
    }

    /**
     * Permet de convertir une string en <code>snake_case</code>
     * vers du <code>PascalCase</code>.
     *
     * Exemples :
     * <pre>
     *     'salut' -> 'Salut'
     *     'mot_de_passe' -> 'MotDePasse'
     *     'forgot_password' -> 'ForgotPassword'
     * </pre>
     *
     * <strong>NOTE :</strong> La conversion avec tiret du 6 (<code>-</code>)
     * fonctionne également.
     *
     * @param string $snake Chaîne en <code>snake_case</code>.
     * @return string Chaîne pascalifiée.
     */
    public static function snake2Pascal(string $snake): string {
        return self::snakeConversion($snake, true);
    }

    /**
     * Permet de convertir une string en <code>snake_case</code>
     * vers du <code>camelCase</code>.
     *
     * Exemples :
     * <pre>
     *     'salut' -> 'salut'
     *     'mot_de_passe' -> 'motDePasse'
     *     'forgot_password' -> 'forgotPassword'
     * </pre>
     *
     * <strong>NOTE :</strong> La conversion avec tiret du 6 (<code>-</code>)
     * fonctionne également.
     *
     * @param string $snake Chaîne en <code>snake_case</code>.
     * @return string Chaîne camélisée.
     */
    public static function snake2Camel(string $snake): string {
        return self::snakeConversion($snake, false);
    }
}