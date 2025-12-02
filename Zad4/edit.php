<?php
require 'config.php';

if (!isset($_GET['id'])) {
    die("Brak ID postaci");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM characters WHERE id = ?");
$stmt->execute([$id]);
$character = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$character) {
    die("Taka postać nie istnieje.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = $_POST['nickname'];
    $class = $_POST['class'];
    $strength = $_POST['strength'];
    $intelligence = $_POST['intelligence'];
    $agility = $_POST['agility'];
    $level = $_POST['level'];

    $update = $pdo->prepare("UPDATE characters SET nickname=?, class=?, strength=?, intelligence=?, agility=?, level=? WHERE id=?");
    $update->execute([$nickname, $class, $strength, $intelligence, $agility, $level, $id]);

    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edytuj postać</title></head>
<body>
<h1>Edytuj postać</h1>

<form method="POST">
    Nick: <input type="text" name="nickname" value="<?= htmlspecialchars($character['nickname']) ?>" required><br><br>
    Klasa: <input type="text" name="class" value="<?= htmlspecialchars($character['class']) ?>" required><br><br>
    Siła: <input type="number" name="strength" value="<?= $character['strength'] ?>" required><br><br>
    Inteligencja: <input type="number" name="intelligence" value="<?= $character['intelligence'] ?>" required><br><br>
    Zwinność: <input type="number" name="agility" value="<?= $character['agility'] ?>" required><br><br>
    Poziom: <input type="number" name="level" value="<?= $character['level'] ?>" required><br><br>

    <button type="submit">Zapisz zmiany</button>
</form>

</body>
</html>
