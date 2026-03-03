<?php
require_once(__DIR__ . '/model/database.php');
require_once(__DIR__ . '/model/category_db.php');
require_once(__DIR__ . '/model/product_db.php');

$action = filter_input(INPUT_GET, 'action');
if ($action === NULL) {
    $action = 'list_products';
}

switch ($action) {
    case 'list_products':
        $categories = get_categories();

        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
        if ($category_id === NULL || $category_id === FALSE) {
            $category_id = $categories[0]['categoryID'];
        }

        $products = get_products_by_category($category_id);
        include(__DIR__ . '/product_catalog/product_list.php');
        break;
    case 'manage_products':
        $products = get_all_products();
        include(__DIR__ . '/product_manager/product_list.php');
        break;
    case 'delete_product':
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    if ($product_id !== false && $product_id !== null) {
        delete_product($product_id);
    }
    header('Location: index.php?action=manage_products');
    exit;
    case 'show_add_form':
        $categories = get_categories();
        include(__DIR__ . '/product_manager/product_add.php');
        break;

    case 'add_product':
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $image = filter_input(INPUT_POST, 'image');
            if (!$image) {
                $image = 'placeholder.jpg';
            }

        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

        if ($category_id && $code && $name && $price !== false) {
            add_product($category_id, $code, $name, $price);
            header('Location: index.php?action=manage_products');
            exit;
        } else {
            echo "Invalid product data.";
        }
        break;

}
