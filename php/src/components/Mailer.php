<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

class Mailer {

    public static function envoyer($data) {
        $to = $data['to'];
        $subject = $data['subject'];
        $body = $data['body'];
        $mail = new PHPMailer(true);

        try {
            // SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'henri@henrimorel.com';
            $mail->Password   = 'fgufapesjsxreeol';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Encodage
            $mail->CharSet = 'UTF-8';

            // Expéditeur
            $mail->setFrom('henri@henrimorel.com', 'Inscripciones Demo');

            // Destinataire
            $mail->addAddress($to);

            // Contenu
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            
            $mail->send();


            return true;

        } catch (Exception $e) {
            error_log("Erreur mail : " . $mail->ErrorInfo);
            return false;
        }
    }
}