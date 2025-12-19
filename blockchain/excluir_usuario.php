<?php
// Conex�o com o banco de dados
$servername = "localhost";
$username = "u682092893_user"; // Seu nome de usuário do banco
$password = "uxh3PzG7gN1B"; // Sua senha do banco
$dbname = "u682092893_db"; // Nome do seu banco de dados

// Criar a conex�o
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conex�o foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conex�o: " . $conn->connect_error);
}

// Verifica se o ID do usu�rio foi passado na URL
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Deletar o usu�rio do banco de dados
    $sql = "DELETE FROM acessos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        echo "Usu�rio exclu�do com sucesso!";
    } else {
        echo "Erro ao excluir o usu�rio: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID do usu�rio n�o encontrado.";
}

// Fechar a conex�o
$conn->close();
?>

