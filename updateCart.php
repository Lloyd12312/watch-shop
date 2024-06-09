<?php
session_start();
include 'dbconfig.php';

if (isset($_POST['product_id']) && isset($_POST['action'])) {
    $product_id = $_POST['product_id'];
    $action = $_POST['action'];
    $userId = $_SESSION['user_id'];

    // Определяем новое количество товара в корзине
    if ($action === 'increase') {
        $updateQuery = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
    } elseif ($action === 'decrease') {
        $updateQuery = "UPDATE cart SET quantity = GREATEST(quantity - 1, 1) WHERE user_id = ? AND product_id = ?";
    }

    $stmt = $connect->prepare($updateQuery);
    $stmt->bind_param("ii", $userId, $product_id);
    if ($stmt->execute()) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
} else {
    // Если идентификатор товара или действие не были получены, выдаем ошибку
    echo json_encode(array('success' => false, 'message' => 'Product ID and action are required.'));
}
?>