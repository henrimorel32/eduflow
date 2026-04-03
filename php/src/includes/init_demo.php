<?php
// init_demo.php - À inclure tout en haut, avant header.php

// Démarrer session si pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Reset demo
if (isset($_GET['reset_demo'])) {
    unset($_SESSION['demo_email']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Détection mode demo
$demo_mode = false;

// Email soumis via POST (première visite)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['demo_email']) && !isset($_POST['acudiente1'])) {
    $email = filter_var($_POST['demo_email'], FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['demo_email'] = $email;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Email en session OU déjà dans formulaire
if (isset($_SESSION['demo_email']) || (isset($_POST['demo_email']) && isset($_POST['acudiente1']))) {
    $demo_mode = true;
}

// Traitement final
$mensaje_exito = false;
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finalizar'])) {
    // ... envoi email ...
    $mensaje_exito = true;
}
?>