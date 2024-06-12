<?php
session_start();
include("dbconfig.php");

try {
    $pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_server, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipCode = $_POST['zip_code'];
    $cardHolderName = $_POST['card_holder_name'];
    $cardNumber = $_POST['card_number'];
    $cardNumber=md5($cardNumber);
    $expirationMonth = $_POST['expiration_month'];
    $expirationYear = $_POST['expiration_year'];
    $cvv = $_POST['cvv'];
    $cvv=md5($cvv);

    // Получаем user_id из таблицы users
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Проверяем, что пользователь существует
    if ($user) {
        $userId = $user['id'];

        // Получаем данные из корзины пользователя
        $stmt = $pdo->prepare("SELECT product_id, product_price, quantity FROM cart WHERE user_id = ?");
        $stmt->execute([$userId]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Формируем строки для product_id и quantity
        $productIds = [];
        $quantities = [];
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $productIds[] = $item['product_id'];
            $quantities[] = $item['quantity'];
            $totalPrice += $item['product_price'] * $item['quantity'];
        }
        $productIdsString = implode(",", $productIds);
        $quantitiesString = implode(",", $quantities);

        // Вносим заказ в таблицу orders
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, product_id, product_price, quantity, full_name, email, address, city, state, zip_code, card_holder_name, card_number, expiration_month, expiration_year, cvv) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $productIdsString, $totalPrice, $quantitiesString, $fullName, $email, $address, $city, $state, $zipCode, $cardHolderName, $cardNumber, $expirationMonth, $expirationYear, $cvv]);

        // Очищаем корзину
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->execute([$userId]);

        // Перенаправляем пользователя на страницу подтверждения или другую страницу
        header("Location: index.php");
        exit();
    } else {
        // Если пользователь не найден, можно добавить соответствующее сообщение или перенаправить на страницу с ошибкой
        echo "The user's email address was not found";
        exit();
    }
}
?>