<?php

namespace App\View\User;
use App\View\TemplateView;
class ForgotPasswordView {
    public function show(): void {
        TemplateView::htmlBegin(
            title: 'Mot de passe oublié',
            description: 'Page du mdp oublié',
            cssNames: ['reset.css','fonts.css', 'header.css', 'footer.css']
        );
        TemplateView::pageHeader('forgotpassword');

        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo "<p class='success'>" . htmlspecialchars($_SESSION['success']) . "</p>";
            unset($_SESSION['success']);
        }

        echo <<< HTML
<div class="container">
    <h1>Mot de passe oublié</h1>
    <form action="forgotpassword" method="POST">
        <input type="email" name="mail" placeholder="email" required>
        <br>
        <button type="submit" name="submit">Envoyer le lien</button>
    </form>
</div>
HTML;

        TemplateView::pageFooter();
        TemplateView::htmlEnd();
    }
}