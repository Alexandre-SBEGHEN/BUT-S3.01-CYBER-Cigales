<?php

namespace App\View;

/**
 * LegalView.php
 *
 * Affichage de la page des mentions légales
 *
 * @author Kawthar CHAIB EDDOUR
 */
class LegalView {
    /**
     * Afficher la page des mentions légales en HTML
     *
     * @return void
     */
    public function show(): void {
        TemplateView::htmlBegin(
            'Mentions Légales',
            'Consultez les mentions légales du site pour en savoir plus sur l\'éditeur du site, l\'hébergement, la propriété intellectuelle et vos droits.',
                ['reset.css', 'fonts.css', 'main.css']
        );
        TemplateView::pageHeader(); ?>
    <main>
        <section class="hero">
            <h1 class="hero__title">Mentions Légales</h1>
        </section>

        <section class="infos">
            <ul class="infos__list">
<?php
$cards = array(
    [
        'title' => 'Conception et réalisation du site',
        'content' => [
            'Pilotage et direction de projet : ANNI Samuel - Enseignant / Maître de conférences à <a class="infos__link link" href="https://www.univ-amu.fr/fr" target="_blank" rel="noopener noreferrer">Aix Marseille Université.</a>',
            'Conception graphique et UI/UX Design : BARTAL Manal, CHAIB EDDOUR Kawthar, GOUIN Gabriel, SBEGHEN Alexandre.',
            'Développement technique et intégration : BARTAL Manal, CHAIB EDDOUR Kawthar, GOUIN Gabriel, SBEGHEN Alexandre.'
        ],
        'footer' => null
    ],
    [
        'title' => 'Auteurs',
        'content' => ['Ce site a été conçu et développé par : BARTAL Manal, CHAIB EDDOUR Kawthar, GOUIN Gabriel, SBEGHEN Alexandre dans le cadre d\'un projet pédagogique, en deuxième année de BUT informatique — <a class="infos__link link" href="https://iut.univ-amu.fr/fr" target="_blank" rel="noopener noreferrer">IUT d\'Aix-Marseille.</a>'],
        'footer' => 'Contact : <a class="infos__link link" href="mailto:cybercigales@alwaysdata.net">ateliers-cybersecurite@alwaysdata.net</a>'
    ],
    [
        'title' => 'Hébergeur',
        'footer' => 'Site hébergé par <a class="infos__link link" target="_blank" href="https://www.alwaysdata.com/fr/" rel="noopener noreferrer">AlwaysData</a>.'
    ],
    [
        'title' => 'Contenu éditorial et mise à jour',
        'footer' => '<em>Ateliers Cybersécurité</em> est un projet pédagogique : un escape game numérique destiné aux lycéennes afin de les sensibiliser à la protection de leurs données. Les informations mises à disposition sur le site ont une valeur indicative et pédagogique.'
    ]
);
foreach ($cards as $card): ?>
                <li class="infos__item">
                    <h2 class="infos__item-title"><?= $card['title'] ?></h2>
<?php if (!empty($card['content'])): ?>
                    <div class="infos__item-content">
<?php for ($i = 0; $i < count($card['content']); ++$i): ?>
                        <p class="infos__item-text"><?= $card['content'][$i] ?></p>
<?php if ($i !== count($card['content']) - 1): ?>
                        <hr class="infos__item-hr hr">
<?php endif; ?>
<?php endfor; ?>
                    </div>
<?php endif; ?>
<?php if (!is_null($card['footer'])): ?>
                    <p class="infos__item-text"><?= $card['footer'] ?></p>
<?php endif ?>
                </li>
<?php endforeach; ?>
            </ul>
        </section>
    </main>
<?php
        TemplateView::htmlEnd();
    }
}