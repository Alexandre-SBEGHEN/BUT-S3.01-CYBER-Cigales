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
     * @param string $description Meta description de la page.
     * @param array $cssNames Facultatif, lien vers les styles CSS.
     * @return void
     */
    public static function htmlBegin(string $title, string $description, array $cssNames=[]): void { ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
<?php foreach ($cssNames as $name): ?>
    <link rel="stylesheet" href="/assets/styles/<?= $name ?>">
<?php endforeach; ?>
</head>
<body>
<?php
    }

    /**
     * Fermeture d'une page HTML.
     *
     * Insère les balises de fermeture de <code>body</code> et <code>html</code>.
     *
     * @return void
     * @see htmlBegin()
     */
    public static function htmlEnd(): void { ?>
</body>
</html>
<?php
    }

    /**
     * Insère un header dans la page.
     *
     * Contient l'en-tête de la page avec notamment
     * le menu de navigation, le logo, etc.
     *
     * @return void
     */
    public static function pageHeader(): void { ?>
    <header>
        <p>Ateliers CYBER & Crypto</p>
        <nav>
            <ul>
<?php
$links = array('Accueil' => '/', 'Connexion' => '/login', 'A propos' => '/about');
foreach ($links as $name => $href): ?>
                <li><a href="<?= $href ?>"><?= $name ?></a></li>
<?php endforeach; ?>
            </ul>
        </nav>
    </header>
<?php
    }

    /**
     * Insère un footer dans la page.
     *
     * Contient le bas de page avec notamment
     * les mentions légales.
     *
     * @return void
     */
    public static function pageFooter(): void { ?>
    <footer>

    </footer>
<?php
    }
}