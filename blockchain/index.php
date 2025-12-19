<?php
// index.php da MONEYPAGE

include_once 'verify_token.php'; // Verifica validade

// Aqui, sim, apaga o token (apenas uma vez)
$token = $_GET['auth_token'];
$tokenPath = __DIR__ . '/../tokens/' . basename($token) . '.txt';
unlink($tokenPath);

// Página principal protegida
include 'login.php';
