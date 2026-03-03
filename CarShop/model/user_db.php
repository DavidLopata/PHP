<?php
require_once(__DIR__ . '/database.php');

function get_user($user_id) {
    global $db;

    $stmt = $db->prepare("
        SELECT userID, email, role
        FROM users
        WHERE userID = ?
    ");
    $stmt->execute([$user_id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
