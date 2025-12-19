<?php
session_start();
if (!$_SESSION['logged']) { header("Location: login.php"); exit; }

$logFile = '../log.csv';
$dataFiltrada = [];

if (($handle = fopen($logFile, "r")) !== FALSE) {
    $header = fgetcsv($handle); // skip header
    while (($row = fgetcsv($handle)) !== FALSE) {
        if (!isset($_GET['data']) || strpos($row[0], $_GET['data']) !== false) {
            $dataFiltrada[] = $row;
        }
    }
    fclose($handle);
}
?>

<h2>Painel de Acessos</h2>
<form method="get">
    Filtrar por data (YYYY-MM-DD): <input type="text" name="data">
    <button type="submit">Filtrar</button>
</form>

<table border="1">
    <tr><th>Data</th><th>IP</th><th>User Agent</th><th>Destino</th></tr>
    <?php foreach($dataFiltrada as $linha): ?>
    <tr>
        <?php foreach($linha as $coluna): ?>
        <td><?= htmlspecialchars($coluna) ?></td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
</table>

<a href="exportar.php">Baixar CSV</a>
