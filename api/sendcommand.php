<?php

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['guid']) && isset($data['type']) && isset($data['data'])) {
        $guid = $data['guid'];
        $type = $data['type'];

        $jsonData = json_encode($data['data']);

        if ($type == 'modal') {
        	$api->atualizarColuna($guid, 'modal', 'aberto');
        }

        if($type == 'deletar'){
            $api->atualizarColuna($guid, 'status', 'deletado');
        }

        if($type == 'deletar2'){
            $api->atualizarColuna($guid, 'status', 'deletado2');
        }

        $api->enviarComando($guid, $jsonData);
        
        echo json_encode(['status' => 'success', 'message' => 'Comando salvo com sucesso']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erro']);
}