<?php

namespace App\View\User;
use App\View\TemplateView;
class ResetPasswordView {

    public function show(string $token): void {
        TemplateView::htmlBegin(
            title: 'Réinitialisation du mot de passe',
            description: 'Choisissez un nouveau mot de passe',
            cssNames: ['reset.css', 'header.css', 'footer.css']
        );
        TemplateView::pageHeader();

        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']);
        }

        $safeToken = htmlspecialchars($token);

        echo <<< HTML
<div class="container">
    <h1>Nouveau mot de passe</h1>
    <form action="reset-password" method="POST">
        <input type="hidden" name="token" value="$safeToken">
        <input type="password" name="password" placeholder="Nouveau mot de passe" required>
        <br>
        <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required>
        <br>
        <button type="submit">Réinitialiser</button>
    </form>
</div>
HTML;

        TemplateView::pageFooter();
        TemplateView::htmlEnd();
    }
}