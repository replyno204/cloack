<?php
// verify_token.php

$token = $_GET['auth_token'] ?? '';
$tokenPath = __DIR__ . '/../tokens/' . basename($token) . '.txt';

// Verifica se token tem formato válido
if (!preg_match('/^[a-f0-9]{32}$/', $token)) {
    http_response_code(403);
    exit('Acesso negado (token inválido)');
}

// Verifica se o arquivo do token existe
if (!file_exists($tokenPath)) {
    http_response_code(403);
    exit('Acesso negado (token não encontrado)');
}

// Lê a expiração
$expiresAt = (int) file_get_contents($tokenPath);
if (time() > $expiresAt) {
    unlink($tokenPath); // Token expirado, limpa
    http_response_code(403);
    exit('Token expirado');
}

// Se chegou aqui, o token é válido — mas não apaga aqui!
