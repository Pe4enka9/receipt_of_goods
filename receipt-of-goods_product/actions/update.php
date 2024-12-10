<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/db.php';

$stmt = $pdo->prepare("UPDATE receipt_of_goods SET product_id = :product_id, amount = :amount WHERE id = :id");
$stmt->execute([
    'product_id' => $_POST['product_id'],
    'amount' => $_POST['amount'],
    'id' => $_POST['id']
]);

header('Location: /products/details.php?article=' . $_POST['article']);