<?php

namespace App\View;

/**
 * TemplateView.php
 *
 * Template pour les pages du site web.
 *
 * Inclue notamment le header avec le menu de navigation,
 * ainsi que le footer avec les mentions légales et les autres
 * informations obligatoires.
 *
 * @author Alexandre SBEGHEN
 */
class TemplateView {

    /**
     * Ouverture d'une page HTML
     *
     * L'insertion s'arrête après la balise <code>body</code>.
     *
     * @param string $title Titre de la page.
     * @param string $description Meta-description de la page.
     * @param array $cssNames Facultatif, lien vers les styles CSS.
     * @return void
     */
    public static function htmlBegin(string $title, string $description, array $cssNames=[]): void {
        //Récupération des CSS
        $cssElements = '';
        if (!empty($cssNames)) {
            foreach ($cssNames as $name) {
                $cssElements .= "\n\t";
                $cssElements .= sprintf('<link rel="stylesheet" href="%s">', $name);
            }
        }

        // Insertion du HTML
        echo <<< HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title</title>
    <meta name="description" content="$description">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">$cssElements
</head>
<body>

HTML;
    }

    /**
     * Fermeture d'une page HTML.
     *
     * Insère les balises de fermeture de <code>body</code> et <code>html</code>.
     *
     * @return void
     * @see htmlBegin()
     */
    public static function htmlEnd(): void {
        // Insertion du HTML
        echo <<< HTML

</body>
</html>
HTML;
    }

}