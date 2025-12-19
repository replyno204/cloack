<?php
// index.php

session_start();

// Carrega config.json com URLs e credenciais
$config = json_decode(file_get_contents(__DIR__ . '/config.json'), true);

// Inclui funções
require __DIR__ . '/functions.php';

// Coleta dados do visitante
$ip = getUserIP();
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$asn = getASN($ip) ?? 'Unknown';
$isGoogleTraffic = isGoogleRelatedTraffic($userAgent, $ip, $asn);
$isForeign = isForeign($ip);

// Delay artificial para bots com cabeçalhos suspeitos
delayIfBotLike();

// Modo debug opcional via config.json
if (!empty($config['debug']) && $config['debug']) {
    echo "<pre>";
    echo "IP: $ip\n";
    echo "User-Agent: $userAgent\n";
    echo "ASN: $asn\n";
    echo "Host: " . gethostbyaddr($ip) . "\n";
    echo "É tráfego do Google? " . ($isGoogleTraffic ? 'SIM' : 'NÃO') . "\n";
    echo "É estrangeiro? " . ($isForeign ? 'SIM' : 'NÃO') . "\n";
    echo "Host suspeito? " . (isSuspiciousHost($ip) ? 'SIM' : 'NÃO') . "\n";
    echo "ASN bloqueado? " . (isBlockedASN($asn) ? 'SIM' : 'NÃO') . "\n";
    echo "</pre>";
    exit;
}

// Verificações de segurança
if ($isGoogleTraffic || $isForeign || isSuspiciousHost($ip) || isBlockedASN($asn)) {
    header("Location: " . $config['whitepage']);
    exit;
}

// Log do acesso
logAccess($ip, $userAgent, $asn, $isGoogleTraffic);

// Gera token único para acesso à oferta real
$token = bin2hex(random_bytes(16));
$_SESSION['auth_token'] = $token;
$_SESSION['auth_expira'] = time() + 60; // Token válido por 60 segundos

// Salva o token em arquivo para que a moneypage valide
$tokensDir = __DIR__ . '/tokens';
if (!is_dir($tokensDir)) {
    mkdir($tokensDir, 0755, true); // Garante que a pasta existe
}
$tokenPath = $tokensDir . '/' . $token . '.txt';
file_put_contents($tokenPath, time() + 60); // Expira em 60s

// Redirecionamento para a oferta com token
$targetURL = rtrim($config['moneypage'], '/') . '?auth_token=' . $token;
header("Location: " . $targetURL);
exit;
