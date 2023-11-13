<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'duacode_test');
define('DB_USER', 'albertomm');
define('DB_PASSWORD', 'Test1234Amm');

$datasourceName = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;

try {
    $pdo = new PDO($datasourceName, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}