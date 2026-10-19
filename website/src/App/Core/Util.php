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
     * @param string $snake Chaîne en <code>snake_case</code>
     * @return string Chaîne pascalifiée.
     */
    public static function snakeCase2PascalCase(string $snake): string {
        $pascal = '';
        $nextIsUpper = true;
        foreach (str_split($snake) as $c) {
            if ($c === '_' || $c === '-') {
                $nextIsUpper = true;
            } else if ($nextIsUpper) {
                $pascal .= strtoupper($c);
                $nextIsUpper = false;
            } else {
                $pascal .= $c;
            }
        }
        return $pascal;
    }
}