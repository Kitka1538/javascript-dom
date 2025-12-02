<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = $_POST['nickname'];
    $class = $_POST['class'];
    $strength = $_POST['strength'];
    $intelligence = $_POST['intelligence'];
    $agility = $_POST['agility'];
    $level = $_POST['level'];

    $stmt = $pdo->prepare("INSERT INTO characters (nickname, class, strength, intelligence, agility, level)
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nickname, $class, $strength, $intelligence, $agility, $level]);

    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html>
<head><meta charset="utf-8"><title>Dodaj postać</title></head>
<body>
<h1>Dodaj nową postać</h1>

<form method="POST">
    Nick: <input type="text" name="nickname" required><br><br>
    Klasa: <input type="text" name="class" required><br><br>
    Siła: <input type="number" name="strength" required><br><br>
    Inteligencja: <input type="number" name="intelligence" required><br><br>
    Zwinność: <input type="number" name="agility" required><br><br>
    Poziom: <input type="number" name="level" required><br><br>

    <button type="submit">Dodaj</button>
</form>

</body>
</html>
