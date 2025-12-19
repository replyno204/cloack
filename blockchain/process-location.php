<?php
// Configura��es de conex�o com o banco de dados
$servername = "localhost";
$username = "u682092893_user"; // Seu nome de usuário do banco
$password = "uxh3PzG7gN1B"; // Sua senha do banco
$dbname = "u682092893_db"; // Nome do seu banco de dados

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conex�o falhou: " . $conn->connect_error);
}

// Verificar se os dados foram recebidos via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Obter o IP do usu�rio
    $ip = $_SERVER['REMOTE_ADDR'];

    // Obter a data e hora atual
    $datahora = date('Y-m-d H:i:s');

    // Inserir os dados no banco de dados
    $sql = "INSERT INTO acessos (ip, datahora, geo) VALUES ('$ip', '$datahora', '$latitude, $longitude')";

    if ($conn->query($sql) === TRUE) {
        echo "Localiza��o registrada com sucesso!";
    } else {
        echo "Erro ao registrar localiza��o: " . $conn->error;
    }

    // Fechar a conex�o
    $conn->close();
} else {
    echo "Nenhum dado enviado.";
}
?>

