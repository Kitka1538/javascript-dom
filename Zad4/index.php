<?php
require 'config.php';

$stmt = $pdo->query("SELECT * FROM characters");
$characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Lista postaci</title></head>
<body>
    <h1>Lista postaci</h1>

    <a href="create.php">+ Dodaj nową postać</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nick</th>
            <th>Klasa</th>
            <th>Siła</th>
            <th>Inteligencja</th>
            <th>Zwinność</th>
            <th>Poziom</th>
            <th>Akcje</th>
        </tr>
        <?php foreach ($characters as $character): ?>
            <tr>
                <td><?= $character['id'] ?></td>
                <td><?= htmlspecialchars($character['nickname']) ?></td>
                <td><?= htmlspecialchars($character['class']) ?></td>
                <td><?= $character['strength'] ?></td>
                <td><?= $character['intelligence'] ?></td>
                <td><?= $character['agility'] ?></td>
                <td><?= $character['level'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $character['id'] ?>">Edytuj</a>
                    |
                    <a href="delete.php?id=<?= $character['id'] ?>">Usuń</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
