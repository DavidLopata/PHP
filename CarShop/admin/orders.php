<?php
require_once('../model/database.php');
require_once('../model/order_db.php');

session_start();



$orders = get_all_orders();

include('../view/header.php');
?>

<main class="orders no-sidebar">
    <h2 class="page-title">Admin – Orders</h2>

    <?php if (empty($orders)): ?>
        <p>No orders yet.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td>#<?= $order['orderID'] ?></td>
                    <td><?= $order['orderDate'] ?></td>
                    <td><?= htmlspecialchars($order['email']) ?></td>
                    <td>
                        <a href="order_details.php?id=<?= $order['orderID'] ?>">
                            View
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>

<?php include('../view/footer.php'); ?>
