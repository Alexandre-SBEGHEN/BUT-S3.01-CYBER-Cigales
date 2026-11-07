<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
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