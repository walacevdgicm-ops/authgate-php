<?php
require_once __DIR__ . '/config.php';

$dsn = 'mysql:host=' . HOST . ';port=3306;dbname=' . DBNAME . ';charset=utf8mb4';

try {
    $pdo = new PDO($dsn, USER, PASSWORD, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    error_log($e->getMessage());
    die('Erro ao conectar ao banco de dados.');
}