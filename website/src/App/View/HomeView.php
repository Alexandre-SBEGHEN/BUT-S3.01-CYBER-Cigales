<?php

namespace App\View;

use App\Core\Init;
use App\Core\Env;

/**
 * HomeView.php
 *
 * Affichage de la page d'accueil.
 *
 * @author Alexandre SBEGHEN
 */
class HomeView {

    /**
     * Afficher la page d'accueil en HTML.
     *
     * @return void
     */
    public function show(): void {
        TemplateView::htmlBegin(
            'Ateliers CYBER & Crypto',
            'Participez à un escape game numérique interactif unique. Apprenez les notions clés de la sécurité informatique à travers des énigmes et des mini-jeux.'
        );
        TemplateView::pageHeader(); ?>
    <main>
        <section>
            <h1>Bienvenue !</h1>
            <p>Apprends à protéger tes données personnelles !</p>
        </section>

        <section>
            <h2>Le principe</h2>
            <ol>
<?php
                $steps = [
                    ['name' => 'Connecte-toi', 'desc' => 'Crée ton compte pour sauvegarder ta progression.'],
                    ['name' => 'Résous les énigmes', 'desc' => 'Chaque énigme parle d\'un risque en particulier !'],
                    ['name' => 'Réussis à t\'échapper', 'desc' => 'Termine le jeu et retiens les bonnes méthode !']
                ];
                for ($i = 0; $i < count($steps); ++$i): $step = $steps[$i]; ?>
                <li>
                    <h3><?= sprintf('%d. %s', $i+1, $step['name']) ?></h3>
                    <p><?= $step['desc'] ?></p>
                </li>
<?php endfor; ?>
            </ol>
        </section>
    </main>
<?php
        TemplateView::pageFooter();
        TemplateView::htmlEnd();
    }
}