<?php

namespace App\View\User;
use App\View\TemplateView;

class DeleteAccountView{
    public function show():void{
        TemplateView::htmlBegin(
            'Supprimer mon compte',
            'Confirmation de la suppression de ton compte',
            ['reset.css', 'fonts.css','header.css','footer.css','delete_account.css'],
        );
        TemplateView::pageHeader();

        echo <<< HTML
    <main class="delete-account">
        <h1> Supprimer mon compte </h1>
        <p> Cette action est <strong> définitive </strong> : ton compte et toutes tes données seront supprimés. </p>
        <p> Veux-tu vraiment continuer ? </p>
        <form method="POST" action="/delete_account">
            <input type="hidden" name="confirm" value="yes">
            <button type="submit"> Oui, supprimer définitivement mon compte.</button>
        </form>
        <a href="/profile"> Non, annuler </a>
    </main>
HTML;
        TemplateView::pageFooter();
        TemplateView::htmlEnd();
    }
}