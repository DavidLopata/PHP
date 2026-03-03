<?php
session_start();

if (!isset($_POST['id'], $_POST['qty'])) {
    http_response_code(400);
    exit;
}

$id = (int) $_POST['id'];
$qty = max(1, (int) $_POST['qty']);

if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] = $qty;
}
