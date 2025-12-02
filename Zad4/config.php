<?php
$dsn = "mysql:host=localhost;dbname=creator;charset=utf8mb4";
$user = "root";
$pass = "";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    die("Błąd połączenia z bazą: " . $e->getMessage());
}
