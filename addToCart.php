<?php
session_start();
include 'dbconfig.php';

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $userId = $_SESSION['user_id'];

    // Проверяем, есть ли товар уже в корзине пользователя
    $checkQuery = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $connect->prepare($checkQuery);
    $stmt->bind_param("ii", $userId, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Если товар уже в корзине, обновляем количество
        $updateQuery = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
        $stmt = $connect->prepare($updateQuery);
        $stmt->bind_param("ii", $userId, $product_id);
        if ($stmt->execute()) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    } else {
        // Если товар не найден в корзине, добавляем его
        $insertQuery = "INSERT INTO cart (user_id, product_id, product_price, quantity) 
                        SELECT ?, p.id, p.product_price, 1
                        FROM products p 
                        WHERE p.id = ?";
        $stmt = $connect->prepare($insertQuery);
        $stmt->bind_param("ii", $userId, $product_id);
        if ($stmt->execute()) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    }
} else {
    // Если идентификатор товара не был получен, выдаем ошибку
    echo json_encode(array('success' => false, 'message' => 'Product ID is required.'));
}
?>
