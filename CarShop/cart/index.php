<?php
require_once('../model/database.php');
require_once('../model/product_db.php');

session_start();

$action = $_POST['action'] ?? $_GET['action'] ?? 'view';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

switch ($action) {

    case 'add':
        $product_id = (int)$_POST['product_id'];

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]++;
        } else {
            $_SESSION['cart'][$product_id] = 1;
        }

        header("Location: index.php");
        exit;

    case 'remove':
        $product_id = (int)$_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);

        header("Location: index.php");
        exit;

    case 'checkout':
        require_once('../model/order_db.php');
        require_once('../model/email.php');

        if (!isset($_SESSION['user_id'])) {
            header("Location: /Proekt/account/login.php");
            exit;
        }

        $order_id = create_order($_SESSION['user_id'], $_SESSION['cart']);

        send_order_email($_SESSION['user_id'], $order_id);

        $_SESSION['cart'] = [];

        header("Location: index.php?action=success");
        exit;

    case 'success':
        include('checkout_success.php');
        exit;

    default:
        $cart_items = [];
        $grand_total = 0;

        foreach ($_SESSION['cart'] as $id => $qty) {
            $product = get_product($id);

            if (!$product) continue;

            $item = [
                'id' => $id,
                'name' => $product['productName'],
                'price' => $product['listPrice'],
                'quantity' => $qty
            ];

            $cart_items[] = $item;
            $grand_total += $item['price'] * $qty;
        }

        include('cart_view.php');
        exit;
}
