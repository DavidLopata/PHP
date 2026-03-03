<?php
require_once(__DIR__ . '/database.php');

function get_products_by_category($category_id) {
    global $db;
    $query = '
        SELECT p.productID,
               p.categoryID,
               p.productCode,
               p.productName,
               p.listPrice,
               p.imageName,
               c.categoryName
        FROM products p
        JOIN categories c ON p.categoryID = c.categoryID
        WHERE p.categoryID = :category_id
        ORDER BY p.productName
    ';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

function get_all_products() {
    global $db;

$query = '
    SELECT p.productID, p.productName, p.productCode, p.listPrice,
           p.imageName, c.categoryName
    FROM products p
    JOIN categories c ON p.categoryID = c.categoryID
    ORDER BY p.productID
';

    $statement = $db->prepare($query);
    $statement->execute();

    $products = $statement->fetchAll();
    $statement->closeCursor();

    return $products;
}
function get_product($product_id) {
    global $db;
    $query = 'SELECT * FROM products WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function delete_product($product_id) {
    global $db;

    $query = 'DELETE FROM products WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}
function add_product($category_id, $code, $name, $price, $image) {
    global $db;

    $query = '
        INSERT INTO products (categoryID, productCode, productName, listPrice, imageName)
        VALUES (:category_id, :code, :name, :price, :image)
        ';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':image', $image);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();
}
