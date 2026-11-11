<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Mailer.php
 *
 * Envoi d'e-mails par SMTP avec PHPMailer.
 * Les paramètres de connexion sont lus dans la section [smtp] du .env.
 */
class Mailer
{
    /**
     * Envoie un e-mail texte brut via le serveur SMTP configuré.
     * Retourne false si la configuration SMTP est incomplète ou si l'envoi échoue
     * (l'erreur est alors écrite dans les logs).
     *
     * @param string $to Adresse e-mail du destinataire.
     * @param string $subject Objet du message.
     * @param string $body Contenu du message.
     * @return bool true si le mail a été envoyé, false sinon.
     */
    public static function send(string $to, string $subject, string $body): bool {
        $env = Init::getEnv();

        $host     = $env->getConfig('smtp', 'host');
        $username = $env->getConfig('smtp', 'username');
        $password = $env->getConfig('smtp', 'password');
        $port     = $env->getConfig('smtp', 'port') ?? 587;

        if (empty($host) || empty($username) || empty($password)) {
            error_log('Erreur mailer : Paramètres SMTP manquants dans le .env (section [smtp]).');
            return false;
        }

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $host;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = (int) $port;

            $mail->setFrom('no-reply@cyber-cigales.alwaysdata.net', 'Cyber Cigales');
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $body;

            return $mail->send();
        } catch (Exception $e) {
            error_log('Erreur envoi mail : ' . $mail->ErrorInfo);
            return false;
        }
    }

}