<?php
function render_order_email($order, $items, $customer_email) {

$orderDate = date('F j, Y', strtotime($order['orderDate']));

ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="margin:0; padding:0; background:#f5f7fa; font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">

<table width="600" cellpadding="20" cellspacing="0" style="background:#ffffff; margin-top:30px; border-radius:6px;">
    
    <tr>
        <td style="text-align:center; background:#1f2937; color:#ffffff; border-radius:6px 6px 0 0;">
            <h2 style="margin:0;">Pero's Car Shop</h2>
        </td>
    </tr>

    <tr>
        <td>
            <h3 style="margin-top:0;">Order Confirmation</h3>

            <p>Thank you for your order!</p>

            <p>
                <strong>Order #:</strong> <?= $order['orderID'] ?><br>
                <strong>Date:</strong> <?= $orderDate ?><br>
                <strong>Email:</strong> <?= htmlspecialchars($customer_email) ?>
            </p>

            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th align="left" style="border-bottom:2px solid #e5e7eb;">Product</th>
                        <th align="center" style="border-bottom:2px solid #e5e7eb;">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td style="border-bottom:1px solid #e5e7eb;">
                            <?= htmlspecialchars($item['productName']) ?>
                        </td>
                        <td align="center" style="border-bottom:1px solid #e5e7eb;">
                            <?= $item['quantity'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <p style="margin-top:20px;">
                If you have any questions, feel free to contact us.
            </p>

            <p>
                — <br>
                <strong>Pero's Car Shop</strong>
            </p>
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>
<?php
return ob_get_clean();
}
