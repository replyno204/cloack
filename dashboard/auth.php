<?php
session_start();
$config = json_decode(file_get_contents('../config.json'), true);

if ($_POST['user'] === $config['admin_user'] && $_POST['pass'] === $config['admin_pass']) {
    $_SESSION['logged'] = true;
    header('Location: painel.php');
} else {
    echo "Login inválido.";
}
?>
