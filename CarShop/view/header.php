<!DOCTYPE html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Pero's Car Shop</title>
    <link rel="stylesheet" href="/Proekt/main.css">
</head>
<body>
<header>
    <h1>Pero's Car Shop</h1>
<nav>
    <?php if (isset($_SESSION['user_id'])): ?>

        <?php if ($_SESSION['user_role'] === 'admin'): ?>
            <a href="/Proekt/index.php?action=manage_products">Vehicle Manager</a>
            <a href="/Proekt/admin/orders.php">Admin Orders</a>
        <?php endif; ?>
    <a href="/Proekt/account/orders.php">My Orders</a>
    
    <?php endif; ?>
    <a href="/Proekt/cart/index.php">Cart</a>
    <a href="/Proekt/index.php?action=list_products">Catalog</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/Proekt/account/logout.php">Logout</a>
    <?php else: ?>
        <a href="/Proekt/account/login.php">Account</a>
    <?php endif; ?>
</nav>


</header>



