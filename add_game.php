<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO games (name, genre, price, time_to_finish, total_playtime) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['name'], $_POST['genre'], $_POST['price'], $_POST['time_to_finish'], $_POST['total_playtime']
    ]);
    header("Location: index.php");
    exit;
}
?>
<form method="post">
  <input name="name" placeholder="Nome do jogo" required>
  <input name="genre" placeholder="Gênero" required>
  <input name="price" type="number" step="0.01" placeholder="Preço pago" required>
  <input name="time_to_finish" type="number" step="0.1" placeholder="Tempo para terminar (h)" required>
  <input name="total_playtime" type="number" step="0.1" placeholder="Tempo total jogado (h)" required>
  <button type="submit">Salvar</button>
</form>