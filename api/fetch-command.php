<?php
header('Content-Type: application/json');
$ip = $api->getUserIp();
$cliente_id = $api->registrarOuAtualizarCliente($ip);
$response = $api->fetchCommand($ip);

echo json_encode($response);