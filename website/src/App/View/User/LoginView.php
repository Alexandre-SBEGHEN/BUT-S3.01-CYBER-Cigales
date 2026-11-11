<?php

namespace App\View\User;

use App\View\TemplateView;

class LoginView {
    public function show(): void {
        TemplateView::htmlBegin(
            "Connexion - Cyber Cigales",
            "Page de connexion à Cyber Cigales",
            ["reset.css", "fonts.css", "main.css"]
        );
        TemplateView::pageHeader(); ?>
    <main class="auth-page">
        <section class="auth-box">
            <h1>Connexion</h1>
<?php if (isset($_SESSION['error'])): ?>
            <div class="error-msg">
                <?= htmlspecialchars($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
            </div>
<?php endif; ?>
            <form action="/login" method="POST" class="auth-form">
                <div class="field">
                    <label for="mail">Adresse e-mail</label>
                    <input type="email" id="mail" name="mail" required placeholder="votre.email@exemple.fr">
                </div>

                <div class="field">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>

                <div class="pass-forgot">
                    <a href="/forgot-password">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="submit-btn">Se connecter</button>
            </form>
            <p class="bottom-link">Pas encore de compte ? <a href="/register">S'inscrire</a></p>
        </section>
    </main>
<?php
        TemplateView::pageFooter();
        TemplateView::htmlEnd();
    }
}