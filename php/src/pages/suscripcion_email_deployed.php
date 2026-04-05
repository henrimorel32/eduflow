<?php
require_once __DIR__ . '/../components/Mailer.php';

// Arguments: email, school_name, domain
if ($argc < 4) {
    echo "Usage: php suscripcion_email_deployed.php <email> <school_name> <domain>\n";
    exit(1);
}

$email = $argv[1];
$schoolName = $argv[2];
$domain = $argv[3];

try {
    $mailer = new Mailer();
    
    $subject = '🎉 Votre école ' . $schoolName . ' est en ligne !';
    
    $body = '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
        .button { display: inline-block; background: #4CAF50; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .info { background: white; padding: 15px; margin: 15px 0; border-left: 4px solid #4CAF50; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Félicitations !</h1>
            <p>Votre école est maintenant en ligne</p>
        </div>
        <div class="content">
            <h2>Bonjour,</h2>
            <p>Nous avons le plaisir de vous informer que <strong>' . htmlspecialchars($schoolName) . '</strong> a été déployée avec succès !</p>
            
            <div class="info">
                <h3>📋 Informations</h3>
                <p><strong>URL d\'inscription :</strong> <a href="https://' . $domain . '">https://' . $domain . '</a></p>
                <p><strong>Certificat SSL :</strong> ✅ Actif (Let\'s Encrypt)</p>
            </div>
            
            <center>
                <a href="https://' . $domain . '" class="button">Voir mon école</a>
            </center>
            
            <p>Si vous avez des questions, contactez-nous.</p>
            <p>Cordialement,<br>L\'équipe EduFlow</p>
        </div>
    </div>
</body>
</html>';
    
    $mailer->send($email, $subject, $body);
    echo "Email envoyé avec succès à: $email\n";
    exit(0);
    
} catch (Exception $e) {
    echo "Erreur envoi email: " . $e->getMessage() . "\n";
    exit(1);
}
