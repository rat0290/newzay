<?php
error_reporting(0); 
require './db.php';
require './server.php';

$api = new CommandAPI($conn);

// Roteamento
$requestUri = $_SERVER['REQUEST_URI'];
$baseUrl = '/'; // Modifique conforme necessário

// Remove a base URL da URI
$url = str_replace($baseUrl, '', $requestUri);

// Remove caracteres inválidos da URL
$url = filter_var($url, FILTER_SANITIZE_URL);

// Quebra a URL em partes
$url = explode('?', $url)[0];
$urlParts = explode('/', $url);

// Obtém o nome da página
$page = empty($urlParts[0]) ? 'home' : $urlParts[0];

// Verifica se o arquivo da página existe
$pagePath = "pages/{$page}.php";
if (file_exists($pagePath)) {
    // Passa os parâmetros para a página
    $params = array_slice($urlParts, 1);
    include_once($pagePath);
} else {
    // Página não encontrada
    http_response_code(404);
    echo 'Página não encontrada';
}
