<?php

require_once __DIR__ . '/helpers/auth.php';
requireAdmin();

require_once __DIR__ . '/classes/Db.php';

$pdo = Db::connect();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: admin.php");
    exit;
}

// elimina prodotto
$stmt = $pdo->prepare("DELETE FROM prodotti WHERE id = ?");
$stmt->execute([$id]);

header("Location: admin.php");
exit;