<?php
require_once(__DIR__ . '/../model/database.php');
require_once(__DIR__ . '/../model/category_db.php');
require_once(__DIR__ . '/../model/product_db.php');

$action = $_POST['action'] ?? $_GET['action'] ?? 'list_products';

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}  

if ($action == 'list_products') {

    $categories = get_categories();
    $products = get_all_products();

    include('product_list.php');
}
elseif ($action === 'delete_product') {

    $product_id  = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

    if (!$product_id) {
        die('Invalid delete request: missing product ID');
    }

    delete_product($product_id);

        header("Location: /Proekt/product_manager/index.php");

    exit;
}

 else if ($action == 'show_add_form') {
    $categories = get_categories();
    include('product_add.php');
} else if ($action === 'add_product') {
    
    $category_id = (int) $_POST['category_id'];
    $code        = trim($_POST['code']);
    $name        = trim($_POST['name']);
    $price       = (float) $_POST['price'];
    $image       = trim($_POST['image']);

    if (!$category_id || !$code || !$name || $price <= 0) {
        $error = "Invalid product data.";
        include('../errors/error.php');
        exit;
    }

    add_product($category_id, $code, $name, $price, $image);

    header("Location: /Proekt/product_manager/index.php");
    exit;

}

?>