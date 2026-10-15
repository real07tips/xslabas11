<?php
require 'conexion.php';

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare('DELETE FROM prestamos WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: prestamos.php');
exit;
