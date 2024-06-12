<?php
session_start();
include("dbconfig.php");

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

try {
    $pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_server, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

if(isset($_GET['id'])) {
    $productId = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$product) {
        echo "Product not found!";
        exit();
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productImage = $_POST['product_image'];

    $stmt = $pdo->prepare("UPDATE products SET product_name = ?, product_price = ?, product_image = ? WHERE id = ?");
    $stmt->execute([$productName, $productPrice, $productImage, $productId]);
    
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form action="editProduct.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required><br><br>
        <label for="product_price">Product Price:</label>
        <input type="number" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product['product_price']); ?>" required><br><br>
        <label for="product_image">Product Image URL:</label>
        <input type="text" id="product_image" name="product_image" value="<?php echo htmlspecialchars($product['product_image']); ?>" required><br><br>
        <input type="submit" value="Save">
    </form>
</body>
</html>
