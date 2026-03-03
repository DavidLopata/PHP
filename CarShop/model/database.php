<?php
    $dsn = 'mysql:host=localhost;dbname=car_salon';
    $username = 'david';
    $password = '1234';
    

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "Database Error: " . $error_message;
    exit();
}
?>