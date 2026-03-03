<?php
require_once(__DIR__ . '/database.php');
require_once(__DIR__ . '/order_db.php');
require_once(__DIR__ . '/user_db.php');
require_once(__DIR__ . '/order_confirmation.php');

function send_order_email($user_id, $order_id) {
    global $db;

    $user = get_user($user_id);

    $stmt = $db->prepare("SELECT * FROM orders WHERE orderID = ?");
    $stmt->execute([$order_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    $items = get_order_items($order_id);

    $email_html = render_order_email(
        $order,
        $items,
        $user['email']
    );

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: My Online Store <no-reply@site.com>\r\n";

    echo $email_html;
    exit;


    mail(
        $user['email'],
        "Order Confirmation #{$order_id}",
        $email_html,
        $headers
    );
}
