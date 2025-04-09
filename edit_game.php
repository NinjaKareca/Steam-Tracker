<?php
require 'db.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE games SET name=?, genre=?, price=?, time_to_finish=?, total_playtime=? WHERE id=?");
    $stmt->execute([
        $_POST['name'], $_POST['genre'], $_POST['price'], $_POST['time_to_finish'], $_POST['total_playtime'], $id
    ]);
    header("Location: index.php");
    exit;
}
$stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
$stmt->execute([$id]);
$game = $stmt->fetch();
?>
<form method="post">
  <input name="name" value="<?= htmlspecialchars($game['name']) ?>" required>
  <input name="genre" value="<?= htmlspecialchars($game['genre']) ?>" required>
  <input name="price" type="number" step="0.01" value="<?= $game['price'] ?>" required>
  <input name="time_to_finish" type="number" step="0.1" value="<?= $game['time_to_finish'] ?>" required>
  <input name="total_playtime" type="number" step="0.1" value="<?= $game['total_playtime'] ?>" required>
  <button type="submit">Atualizar</button>
</form>