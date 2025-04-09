<?php
require 'db.php';
$stmt = $pdo->query("SELECT * FROM games ORDER BY created_at DESC");
$games = $stmt->fetchAll();
$totalValue = array_sum(array_column($games, 'price'));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Steam Tracker</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/js/app.js" defer></script>
</head>
<body>
  <div class="container">
    <h1>🎮 Minha Biblioteca Steam</h1>
    <a class="button" href="add_game.php">➕ Adicionar Jogo</a>
    <h2>Valor total investido: R$ <?= number_format($totalValue, 2, ',', '.') ?></h2>
    <table>
      <tr>
        <th>Nome</th><th>Gênero</th><th>Preço</th><th>Tempo para zerar</th><th>Tempo total</th><th>Custo por hora</th><th>Ações</th>
      </tr>
      <?php foreach ($games as $game): ?>
      <tr>
        <td><?= htmlspecialchars($game['name']) ?></td>
        <td><?= htmlspecialchars($game['genre']) ?></td>
        <td>R$ <?= number_format($game['price'], 2, ',', '.') ?></td>
        <td><?= $game['time_to_finish'] ?>h</td>
        <td><?= $game['total_playtime'] ?>h</td>
        <td>R$ <?= $game['time_to_finish'] > 0 ? number_format($game['price'] / $game['time_to_finish'], 2, ',', '.') : '-' ?></td>
        <td>
          <a class="action" href="edit_game.php?id=<?= $game['id'] ?>">✏️</a>
          <a class="action delete" href="delete_game.php?id=<?= $game['id'] ?>" onclick="return confirm('Deseja remover este jogo?')">❌</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <a class="button export" href="export_excel.php">📤 Exportar para Excel</a>
  </div>
</body>
</html>