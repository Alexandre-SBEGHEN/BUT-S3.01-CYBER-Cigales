<?php

namespace modules\views;

class LoginView {
    public function show(): void {
        template_view::html_begin(
            "Connexion - Cyber Cigales",
            "Page de connexion à Cyber Cigales",
            ["reset.css", "fonts.css", "header.css", "footer.css", "login.css"]
        );
        template_view::page_header('login');
        ?>

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
                        <a href="/forgotpassword">Mot de passe oublié ?</a>
                    </div>

                    <button type="submit" class="submit-btn">Se connecter</button>
                </form>

                <p class="bottom-link">
                    Pas encore de compte ? <a href="/register">S'inscrire</a>
                </p>
            </section>
        </main>

        <?php
        template_view::page_footer();
        template_view::html_end();
    }
}