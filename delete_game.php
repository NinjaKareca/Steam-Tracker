<?php
require 'db.php';
$stmt = $pdo->prepare("DELETE FROM games WHERE id = ?");
$stmt->execute([$_GET['id']]);
header("Location: index.php");
exit;