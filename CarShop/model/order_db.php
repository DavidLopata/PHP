<?php
function create_order($customer_id, $cart) {
    global $db;

    $stmt = $db->prepare(
        "INSERT INTO orders (customerID, orderDate)
         VALUES (?, NOW())"
    );
    $stmt->execute([$customer_id]);
    $order_id = $db->lastInsertId();

    foreach ($cart as $product_id => $qty) {
        $product = get_product($product_id);

        $stmt = $db->prepare(
            "INSERT INTO order_items (orderID, productID, quantity, price)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([
            $order_id,
            $product_id,
            $qty,
            $product['listPrice']
        ]);
    }

    return $order_id;
}
function get_order($order_id) {
    global $db;

    $stmt = $db->prepare("
        SELECT o.orderID, o.orderDate, u.email
        FROM orders o
        JOIN users u ON o.customerID = u.userID
        WHERE o.orderID = ?
    ");

    $stmt->execute([$order_id]);
    return $stmt->fetch();
}

function get_all_orders() {
    global $db;

    $stmt = $db->query("
        SELECT o.orderID, o.orderDate, u.email
        FROM orders o
        JOIN users u ON o.customerID = u.userID
        ORDER BY o.orderDate DESC
    ");

    return $stmt->fetchAll();
}

function get_orders_by_user($user_id) {
    global $db;

    $stmt = $db->prepare(
        "SELECT * FROM orders
         WHERE customerID = ?
         ORDER BY orderDate DESC"
    );
    $stmt->execute([$user_id]);
    $orders = $stmt->fetchAll();

    foreach ($orders as &$order) {
        $stmt = $db->prepare(
            "SELECT p.productName, oi.quantity
             FROM order_items oi
             JOIN products p ON oi.productID = p.productID
             WHERE oi.orderID = ?"
        );
        $stmt->execute([$order['orderID']]);
        $order['items'] = $stmt->fetchAll();
    }

    return $orders;
}
function get_last_order_by_user($user_id) {
    global $db;
    $stmt = $db->prepare("
        SELECT * FROM orders
        WHERE customerID = ?
        ORDER BY orderDate DESC
        LIMIT 1
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetch();
}

function get_order_items($order_id) {
    global $db;

    $stmt = $db->prepare("
        SELECT 
            p.productName,
            oi.quantity,
            oi.price
        FROM order_items oi
        JOIN products p ON oi.productID = p.productID
        WHERE oi.orderID = ?
    ");

    $stmt->execute([$order_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




