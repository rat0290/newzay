<?php
$dsn = 'mysql:host=localhost;dbname=u409631760_c;charset=utf8';
$username = 'u409631760_c';
$password = 'J90GW:2gH';

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>