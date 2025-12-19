<?php
// Defina o cabeçalho para o áudio (opcional, pode ser útil dependendo do navegador)
header('Content-Type: audio/mpeg');

// Caminho para o arquivo de som
$audioFile = 'login-sound.mp3';

// Verifica se o arquivo de som existe
if (file_exists($audioFile)) {
    // Reproduz o som
    readfile($audioFile);
} else {
    echo 'Erro: O arquivo de som não foi encontrado.';
}
?>

