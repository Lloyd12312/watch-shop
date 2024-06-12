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

$userIsProductUser = false;
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $stmt = $pdo->prepare("SELECT pu FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user && $user['pu'] == 1) {
        $userIsProductUser = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--=============== SWIPER CSS ===============--> 
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Rolex</title>
</head>
<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
    <nav class="nav container">
        <a href="#" class="nav__logo">
            <i class='bx bxs-watch nav__logo-icon'></i> Rolex
        </a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="#home" class="nav__link active-link">Home</a>
                </li>
                <li class="nav__item">
                    <a href="#products" class="nav__link">Products</a>
                </li>
                <li class="nav__item">
                    <a href="#testimonial" class="nav__link">Testimonials</a>
                </li>
            </ul>

            <div class="nav__close" id="nav-close">
                <i class='bx bx-x' ></i>
            </div>
        </div>

        <div class="nav__btns">
            <!-- Theme change button -->
            <i class='bx bx-moon change-theme' id="theme-button"></i>

            <?php if(isset($_SESSION['email'])): ?>
                <!-- User is logged in -->
                <div class="nav__shop" id="cart-shop">
                    <i class='bx bx-shopping-bag' ></i>
                </div>
                <div class="nav__logOut" id="nav-logOut">
                    <a href="logout.php" class="nav__logOut">
                        <i class='bx bx-log-out' ></i>
                    </a>
                </div>
            <?php else: ?>
                <!-- User is not logged in -->
                <div class="nav__logIn" id="nav-logIn">
                    <a href="login.php" class="nav__logIn">
                        <i class='bx bx-log-in' ></i>
                    </a>
                </div>
            <?php endif; ?>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-grid-alt' ></i>  
            </div>
        </div>
    </nav>
</header>

<!--==================== CART ====================-->
<div class="cart" id="cart">
    <i class='bx bx-x cart__close' id="cart-close"></i>
    <h2 class="cart__title-center">My Cart</h2>
    <div class="cart__container">
        <?php
        $hasItemsInCart = false;
        if(isset($_SESSION['email'])) {
            // Получаем email текущего пользователя из сессии
            $email = $_SESSION['email'];
            // Запрос к базе данных для получения содержимого корзины пользователя
            $stmt = $pdo->prepare("SELECT p.id, p.product_name, p.product_price, p.product_image, c.quantity 
                                    FROM products p 
                                    JOIN cart c ON p.id = c.product_id 
                                    JOIN users u ON u.id = c.user_id 
                                    WHERE u.email = ?");
            $stmt->execute([$email]);
            $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Инициализируем переменную для хранения общей суммы
            $totalPrice = 0;
            // Если товары найдены, выводим их на страницу
            if ($cartItems) {
                $hasItemsInCart = true;
                foreach ($cartItems as $item) {
                    // Считаем общую сумму товаров в корзине
                    $totalPrice += $item['product_price'] * $item['quantity'];
                    echo '<article class="cart__card">';
                    echo '<div class="cart__box">';
                    // Подставляем изображение товара
                    echo '<img src="' . htmlspecialchars($item['product_image']) . '" alt="" class="cart__img">';
                    echo '</div>';
                    echo '<div class="cart__details">';
                    echo '<h3 class="cart__title">' . htmlspecialchars($item['product_name']) . '</h3>';
                    echo '<span class="cart__price">$' . htmlspecialchars($item['product_price']) . '</span>';
                    echo '<div class="cart__amount">';
                    echo '<div class="cart__amount-content">';
                    echo '<button class="cart__amount-box" data-product-id="' . htmlspecialchars($item['id']) . '" data-action="decrease">';
                    echo '<i class="bx bx-minus"></i>';
                    echo '</button>';
                    echo '<span class="cart__amount-number">' . htmlspecialchars($item['quantity']) . '</span>';
                    echo '<button class="cart__amount-box" data-product-id="' . htmlspecialchars($item['id']) . '" data-action="increase">';
                    echo '<i class="bx bx-plus"></i>';
                    echo '</button>';
                    echo '</div>';
                    echo '<button class="cart__amount-trash" data-product-id="' . htmlspecialchars($item['id']) . '">';
                    echo '<i class="bx bx-trash-alt"></i>'; 
                    echo '</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</article>';
                }
            }
        }
        ?>
    </div>

    <div class="cart__prices">
        <span class="cart__total">Total Price:</span>
        <span class="cart__total-price">$<?php echo number_format($totalPrice, 2); ?></span>
    </div>
    <?php if ($hasItemsInCart): ?>
        <a href="checkout.php"> 
            <button class="cart__checkout-button">Checkout</button>
        </a>
    <?php endif; ?>
</div>

<!--==================== MAIN ====================-->
<main class="main">
    <!--==================== HOME ====================-->
    <section class="home" id="home">
        <div class="home__container container grid">
            <div class="home__img-bg">
                <img src="assets/img/home.png" alt="" class="home__img">
            </div>

            <div class="home__social">
                <a href="https://www.facebook.com/" target="_blank" class="home__social-link">
                    Facebook
                </a>
                <a href="https://youtube.com/" target="_blank" class="home__social-link">
                    Youtube
                </a>
                <a href="https://www.instagram.com/" target="_blank" class="home__social-link">
                    Instagram
                </a>
            </div>

            <div class="home__data">
                <h1 class="home__title">NEW WATCH <br> ROLEX DAYTONA COSMOGRAP</h1>
                <p class="home__description">
                    Latest arrival of the new imported watches of the 116503 series, 
                    with a modern and resistant design.
                </p>
                <span class="home__price">$38,999.00</span>
            </div>
        </div>
    </section>

    <!--==================== STORY ====================-->
    <section class="story section container">
        <div class="story__container grid">
            <div class="story__data">
                <h2 class="section__title story__section-title">
                    Our Story
                </h2>

                <h1 class="story__title">
                    Inspirational Watch of <br> this year
                </h1>

                <p class="story__description">
                    The latest and modern watches of this year, is available in various 
                    presentations in this store, discover them now.
                </p>

                <a href="#" class="button button--small">Discover</a>
            </div>

            <div class="story__images">
                <img src="assets/img/story.png" alt="" class="story__img">
                <div class="story__square"></div>
            </div>
        </div>
    </section>

    <!--==================== PRODUCTS ====================-->
    <section class="products section container" id="products">
        <h2 class="section__title">Products</h2>

        <?php
        $stmt = $pdo->query("SELECT * FROM `products`");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($products) {
            echo '<div class="products__container grid">';
            foreach ($products as $product) {
                echo '<article class="products__card">';
                echo '<img src="' . htmlspecialchars($product['product_image']) . '" alt="" class="products__img">';
                echo '<h3 class="products__title">' . htmlspecialchars($product['product_name']) . '</h3>';
                echo '<span class="products__price">$' . htmlspecialchars($product['product_price']) . '</span>';
                echo '<button class="products__button" data-product-id="' . htmlspecialchars($product['id']) . '">';
                echo '<i class="bx bx-shopping-bag"></i>';
                echo '</button>';
                if ($userIsProductUser) {
                    echo '<button class="products__edit-button" data-product-id="' . htmlspecialchars($product['id']) . '">Edit</button>';
                    echo '<button class="products__delete-button" data-product-id="' . htmlspecialchars($product['id']) . '">Delete</button>';
                }
                echo '</article>';
            }
            echo '</div>';
        } else {
            echo "No products found.";
        }

        $pdo = null;
        ?>
    </section>

        <!--==================== TESTIMONIAL ====================-->
        <section class="testimonial section container" id = "testimonial">
            <h2 class="section__title story__section-title">Testimonials</h2>
            <div class="testimonial__container grid">
                <div class="swiper testimonial-swiper">
                    <div class="swiper-wrapper">
                        <div class="testimonial__card swiper-slide">
                            <div class="testimonial__quote">
                                <i class='bx bxs-quote-alt-left' ></i>
                            </div>
                            <p class="testimonial__description">
                                They are the best watches that one acquires, also they are always with the latest 
                                news and trends, with a very comfortable price and especially with the attention 
                                you receive, they are always attentive to your questions.
                            </p>
                            <h3 class="testimonial__date">March 27. 2021</h3>
        
                            <div class="testimonial__perfil">
                                <img src="assets/img/testimonial1.jpg" alt="" class="testimonial__perfil-img">
        
                                <div class="testimonial__perfil-data">
                                    <span class="testimonial__perfil-name">Lee Doe</span>
                                    <span class="testimonial__perfil-detail">Director of a company</span>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial__card swiper-slide">
                            <div class="testimonial__quote">
                                <i class='bx bxs-quote-alt-left' ></i>
                            </div>
                            <p class="testimonial__description">
                                I've been wearing this watch for the past few months, 
                                and it has exceeded all my expectations. 
                                I highly recommend this watch to anyone looking for a reliable and stylish timepiece.
                            </p>
                            <h3 class="testimonial__date">May 20. 2021</h3>
        
                            <div class="testimonial__perfil">
                                <img src="assets/img/testimonial2.jpg" alt="" class="testimonial__perfil-img">
        
                                <div class="testimonial__perfil-data">
                                    <span class="testimonial__perfil-name">Samantha Mey</span>
                                    <span class="testimonial__perfil-detail">Marketing Manager</span>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial__card swiper-slide">
                            <div class="testimonial__quote">
                                <i class='bx bxs-quote-alt-left' ></i>
                            </div>
                            <p class="testimonial__description">
                                I’ve been using this watch for about a month now, 
                                and it has quickly become an essential part of my daily routine. 
                                As a software engineer, 
                                I appreciate the technical precision and the range of smart features it offers.
                            </p>
                            <h3 class="testimonial__date">May 25. 2021</h3>
        
                            <div class="testimonial__perfil">
                                <img src="assets/img/testimonial3.jpg" alt="" class="testimonial__perfil-img">
        
                                <div class="testimonial__perfil-data">
                                    <span class="testimonial__perfil-name">Raul Zaman</span>
                                    <span class="testimonial__perfil-detail">Software Engineer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="swiper-button-next">
                        <i class='bx bx-right-arrow-alt' ></i>
                    </div>
                    <div class="swiper-button-prev">
                        <i class='bx bx-left-arrow-alt' ></i>
                    </div>
                </div>

                <div class="testimonial__images">
                    <div class="testimonial__square"></div>
                    <img src="assets/img/testimonial.png" alt="" class="testimonial__img">
                </div>
            </div>
        </section>

    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <div class="footer__container container grid">
            <div class="footer__content">
                <h3 class="footer__title">Our information</h3>

                <ul class="footer__list">
                    <li>Ukraine</li>
                    <li>Kyiv</li>
                    <li>+380 (066) 666-66-66</li>
                </ul>
            </div>
            <div class="footer__content">
                <h3 class="footer__title">About Us</h3>

                <ul class="footer__links">
                    <li>
                        <a href="#" class="footer__link">Support Center</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Customer Support</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">About Us</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Copy Right</a>
                    </li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Product</h3>

                <ul class="footer__links">
                    <li>
                        <a href="#" class="footer__link">Clothes</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Watches</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Electric</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Accesories</a>
                    </li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Social</h3>

                <ul class="footer__social">
                    <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-facebook'></i>
                    </a>

                    <a href="https://youtube.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-youtube'></i>
                    </a>

                    <a href="https://www.instagram.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-instagram' ></i>
                    </a>
                </ul>
            </div>
        </div>

        <span class="footer__copy">&#169; All rigths reserved</span>
    </footer>

    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up"> 
        <i class='bx bx-up-arrow-alt scrollup__icon' ></i>
    </a>

    <!--=============== SWIPER JS ===============-->
    <script src="assets/js/swiper-bundle.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>

    <!--=============== THEME JS ===============-->
    <script src="assets/js/theme.js"></script>
</body>
</html>