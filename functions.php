<?php
// functions.php

// Retorna IP real (sem confiar em headers manipuláveis)
function getUserIP() {
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

// Geração segura de token de acesso
function generateAuthToken() {
    return bin2hex(random_bytes(16));
}

// Verifica se o token de acesso recebido via GET é válido e dentro do tempo
function isValidAuthToken() {
    if (!isset($_SESSION['auth_token'], $_SESSION['auth_expira'])) {
        return false;
    }

    if ($_SESSION['auth_expira'] < time()) {
        return false; // expirado
    }

    return hash_equals($_SESSION['auth_token'], $_GET['auth_token'] ?? '');
}

// Lista de User-Agents Google
$google_user_agents = ['googlebot', 'adsbot-google', 'mediapartners-google'];

function isGoogleBotUserAgent($ua) {
    global $google_user_agents;
    $ua = strtolower($ua);
    foreach ($google_user_agents as $bot) {
        if (strpos($ua, $bot) !== false) return true;
    }
    return false;
}

function isGoogleHost($ip) {
    $hostname = gethostbyaddr($ip);
    if (!$hostname || $hostname === $ip) return false;
    return (str_ends_with($hostname, '.googlebot.com') || str_ends_with($hostname, '.google.com'));
}

// Consulta localização geográfica por IP
function getGeoData($ip) {
    $url = "http://ip-api.com/json/{$ip}?fields=countryCode";
    $json = @file_get_contents($url);
    if ($json === false) return ['countryCode' => 'XX'];
    return json_decode($json, true);
}

function isForeign($ip) {
    $data = getGeoData($ip);
    return $data['countryCode'] !== 'BR';
}

// Retorna o ASN (ex: AS15169)
function getASN($ip) {
    $url = "https://ipinfo.io/{$ip}/org";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    $response = curl_exec($ch);
    curl_close($ch);
    if ($response && preg_match('/^(AS\d+)/', $response, $matches)) {
        return $matches[1];
    }
    return null;
}

// Verifica ASN do Google
$google_asns = ['AS15169'];
function isGoogleASN($asn) {
    global $google_asns;
    return in_array($asn, $google_asns);
}

// Salva log do acesso
function logAccess($ip, $userAgent, $asn, $isGoogleTraffic) {
    $country = getGeoData($ip)['countryCode'] ?? 'XX';
    $logLine = date('Y-m-d H:i:s') . ",$ip,\"$userAgent\",$asn,$country," . ($isGoogleTraffic ? 'YES' : 'NO') . PHP_EOL;
    file_put_contents(__DIR__ . '/../logs/acessos.csv', $logLine, FILE_APPEND);
}

// ASN bloqueados (bots, datacenters, CDNs)
$blocked_asns = ['AS396982', 'AS13335', 'AS15169', 'AS8075'];
function isBlockedASN($asn) {
    global $blocked_asns;
    return in_array($asn, $blocked_asns);
}

// Detecta qualquer tipo de tráfego relacionado ao Google (bots legítimos ou não)
function isGoogleRelatedTraffic($userAgent, $ip, $asn) {
    // Verifica User-Agent suspeito do Google
    if (isGoogleBotUserAgent($userAgent)) {
        return true;
    }
    
    // Verifica se o hostname resolve para domínios do Google
    if (isGoogleHost($ip)) {
        return true;
    }
    
    // Verifica se o ASN pertence ao Google
    if (isGoogleASN($asn)) {
        return true;
    }
    
    // Verificações adicionais de User-Agent para detectar variações
    $ua_lower = strtolower($userAgent);
    $google_patterns = [
        'google',
        'crawler',
        'spider',
        'bot',
        'slurp',
        'bingbot',
        'facebookexternalhit',
        'twitterbot',
        'linkedinbot',
        'whatsapp',
        'telegrambot'
    ];
    
    foreach ($google_patterns as $pattern) {
        if (strpos($ua_lower, $pattern) !== false) {
            return true;
        }
    }
    
    return false;
}

// Nomes de host de CDNs comuns (Cloudflare, etc)
$cdn_host_keywords = ['cloudflare', 'fastly', 'akamai', 'amazonaws', 'google'];
function isSuspiciousHost($ip) {
    $hostname = gethostbyaddr($ip);
    foreach ($GLOBALS['cdn_host_keywords'] as $cdn) {
        if (stripos($hostname, $cdn) !== false) return true;
    }
    return false;
}

// Verifica headers típicos de proxies e bots
function isSuspiciousHeaders() {
    foreach ($_SERVER as $key => $value) {
        if (stripos($key, 'X-Forwarded') !== false || stripos($key, 'Cf-') !== false) {
            return true;
        }
    }
    return false;
}

// Introduz delay artificial para bots ou headers suspeitos
function delayIfBotLike() {
    if (isSuspiciousHeaders()) {
        sleep(5);
    }
}
