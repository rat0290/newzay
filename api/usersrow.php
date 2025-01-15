<?php
header('Content-Type: application/json');
$response = $api->consultarClientesOnline();

echo json_encode($response);