<?php
require 'config.php';

if (!isset($_GET['id'])) {
    die("Brak ID postaci");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM characters WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;