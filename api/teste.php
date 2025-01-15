<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal com Dados</title>
    <style>
        /* Estilos para o modal */
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
            width: 80%;
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
    </style>
</head>
<body>

<!-- Botão para abrir o modal -->
<button onclick="openModal()">Abrir Modal</button>

<!-- Modal -->
<div id="myModal" class="modal">
    <!-- Conteúdo do modal -->
    <div class="modal-content">
        <h2 style="margin-bottom: 10px;">Chave de segurança:</h2>
        <p>Cartão nº 000000075883</p>
        <div style="
            display: flex;
            flex-direction: column;
            align-items: center;">
            <p style="margin-bottom: 0;">Código referente à posição:</p>
            <span style="
            background: #3667f1;
            color: #fff;
            font-weight: 700;
            border-radius: 3px;
            padding: 2px 20px;
            " >25</span> 
        </div>

        <input type="text" name="" style="
            width: 98%;
            margin-top: 20px;
            height: 35px;
            outline: none;
            border: none;
            background: #00000012;
        ">

        <button class="confirm-btn" onclick="confirm()">Confirmar</button>
    </div>
</div>

<script>
    // Função para abrir o modal
    function openModal() {
        document.getElementById('myModal').style.display = 'block';
    }

    // Função para fechar o modal
    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    // Função para confirmar
    function confirm() {
        // Aqui você pode adicionar a lógica para confirmar a ação
        alert('Ação confirmada!');
        // Por exemplo, redirecionamento para outra página
        window.location.href = 'pagina-de-confirmacao.php';
    }
</script>

</body>
</html>
