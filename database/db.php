<?php
require_once __DIR__ . '/../includes/env.php';

if (!isset($env['DB_HOST'])) {
   die(".env variables not loaded");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($env['DB_HOST'], $env['DB_USER'], $env['DB_PASS'], $env['DB_NAME']);
    $conn -> set_charset("utf8mb4");
} catch(mysqli_sql_exception $e) {
    die("DATABASE CONNECTIONFAILED: " . $e->getMessage());
}


?>
