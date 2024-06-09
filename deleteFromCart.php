<?php
session_start();
include("dbconfig.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    try {
        $pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_server, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Получаем email текущего пользователя из сессии
        $email = $_SESSION['email'];
        $product_id = $_POST['product_id'];

        // Запрос к базе данных для удаления товара из корзины пользователя
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = (SELECT id FROM users WHERE email = ?) AND product_id = ?");
        $stmt->execute([$email, $product_id]);

        echo "Product deleted successfully from the cart";
    } catch (PDOException $e) {
        echo 'Failed to delete product from the cart: ' . $e->getMessage();
    }
} else {
    echo "Invalid request";
}
?>
