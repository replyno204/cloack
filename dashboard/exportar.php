<?php
session_start();
if (!$_SESSION['logged']) { header("Location: login.php"); exit; }

$arquivo = '../log.csv';
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="log.csv"');
readfile($arquivo);
exit;
?>
