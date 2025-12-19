<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "u682092893_user"; // Seu nome de usuário do banco
$password = "uxh3PzG7gN1B"; // Sua senha do banco
$dbname = "u682092893_db"; // Nome do seu banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Atualiza o campo 'notify' para 1 nos acessos mais recentes
$sql = "UPDATE acessos SET notify = 1 WHERE notify = 0 LIMIT 1"; // Atualiza apenas um acesso não notificado
if ($conn->query($sql) === TRUE) {
    echo "Notificação atualizada com sucesso!";
} else {
    echo "Erro ao atualizar notificação: " . $conn->error;
}

// Fechar a conexão
$conn->close();
?>
