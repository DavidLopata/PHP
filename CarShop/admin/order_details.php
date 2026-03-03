<?php
require_once('../model/database.php');
require_once('../model/order_db.php');

session_start();



$order_id = (int)($_GET['id'] ?? 0);

$order = get_order($order_id);
$items = get_order_items($order_id);

include('../view/header.php');
?>

<main class="orders no-sidebar">
    <h2 class="page-title">Order #<?= $order['orderID'] ?></h2>

    <p>
        <strong>Date:</strong> <?= $order['orderDate'] ?><br>
        <strong>Customer:</strong> <?= htmlspecialchars($order['email']) ?>
    </p>

    <table>
        <thead>
            <tr>
                <th>Vehicle</th>
                <th>Quantity</th>
                <th>Line Total</th>
            </tr>
        </thead>
        <tbody>
        <?php $total = 0; ?>
        <?php foreach ($items as $item): ?>
            <?php $line = $item['price'] * $item['quantity']; ?>
            <?php $total += $line; ?>
            <tr>
                <td><?= htmlspecialchars($item['productName']) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td>$<?= number_format($line, 2) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3 style="text-align:right; margin-top:1rem;">
        Total: $<?= number_format($total, 2) ?>
    </h3>
</main>

<?php include('../view/footer.php'); ?>
