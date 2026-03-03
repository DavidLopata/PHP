<?php
require_once('../model/database.php');
require_once('../model/order_db.php');

session_start();


$orders = get_orders_by_user($_SESSION['user_id']);
include('../view/header.php');
?>

<main class="orders no-sidebar" >
    <h2 class="page-title">My Orders</h2>


    <?php if (empty($orders)): ?>
        <p>You have no orders yet.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="order-box">
                <h3>Order #<?= $order['orderID'] ?></h3>
                <p class="order-date">Date: <?= $order['orderDate'] ?></p>

                <ul>
                    <?php foreach ($order['items'] as $item): ?>
                        <li>
                            <?= htmlspecialchars($item['productName']) ?> × <?= $item['quantity'] ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include('../view/footer.php'); ?>
