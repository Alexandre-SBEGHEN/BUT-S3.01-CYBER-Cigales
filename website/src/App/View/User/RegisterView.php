<?php

namespace modules\views;

class RegisterView {
    public function show(): void {
        // Charge les styles globaux ainsi que le CSS de connexion/inscription
        template_view::html_begin(
            "Inscription - Cyber Cigales",
            "Page d'inscription à Cyber Cigales",
            ["reset.css", "fonts.css", "header.css", "footer.css", "login.css"]
        );
        template_view::page_header('register');
        ?>

        <main class="auth-page">
            <section class="auth-box">
                <h1>Inscription</h1>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="error-msg">
                        <?= htmlspecialchars($_SESSION['error']); ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <form action="/register" method="POST" class="auth-form">
                    <div class="field">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" required placeholder="Votre nom">
                    </div>

                    <div class="field">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" required placeholder="Votre prénom">
                    </div>

                    <div class="field">
                        <label for="mail">Adresse e-mail</label>
                        <input type="email" id="mail" name="mail" required placeholder="votre.email@exemple.fr">
                    </div>

                    <div class="field">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required placeholder="••••••••">
                    </div>

                    <button type="submit" class="submit-btn">S'inscrire</button>
                </form>

                <p class="bottom-link">
                    Déjà un compte ? <a href="/login">Se connecter</a>
                </p>
            </section>
        </main>

        <?php
        template_view::page_footer();
        template_view::html_end();
    }
}