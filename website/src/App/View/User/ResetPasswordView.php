<?php

namespace App\View\User;
class ResetPasswordView {

    public function show(string $token): void {
        template_view::html_begin(
            title: 'Réinitialisation du mot de passe',
            description: 'Choisissez un nouveau mot de passe',
            css_names: ['reset.css', 'header.css', 'footer.css']
        );
        template_view::page_header();

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

        template_view::page_footer();
        template_view::html_end();
    }
}