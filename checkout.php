<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/checkout.css">
</head>
<body>
    <div class="container">
        <form action="submitOrder.php" method="post">
        <i class='bx bx-moon change-theme' id="theme-button"></i>
            <div class="row">
                <div class="column">
                    <h3 class="title">Billing Adress</h3>
                    <div class="input-box">
                        <span>Full Name: </span>
                        <input type="text" name="full_name" placeholder="Jacob Aiden">
                    </div>
                    <div class="input-box">
                        <span>Email: </span>
                        <input type="email" name="email" placeholder="example@gmail.com">
                    </div>
                    <div class="input-box">
                        <span>Address: </span>
                        <input type="text" name="address" placeholder="Room - Street - Locality">
                    </div>
                    <div class="input-box">
                        <span>City: </span>
                        <input type="text" name="city" placeholder="Kyiv">
                    </div>

                    <div class="flex">
                        <div class="input-box">
                            <span>State: </span>
                            <input type="text" name="state" placeholder="Ukraine">
                        </div>
                        <div class="input-box">
                            <span>Zip Code: </span>
                            <input type="number" name="zip_code" placeholder="123 456">
                        </div>
                    </div>
                </div>

                <div class="column">
                    <h3 class="title">Payment</h3>
                    <div class="input-box">
                        <span>Cards Accepted: </span>
                        <img src="assets/img/imgcards.png" alt="">
                    </div>
                    <div class="input-box">
                        <span>Name On Card: </span>
                        <input type="text" name="card_holder_name" placeholder="Mr. Jacob Aiden">
                    </div>
                    <div class="input-box">
                        <span>Credit Card Number: </span>
                        <input type="number" name="card_number" placeholder="1111 2222 3333 4444">
                    </div>
                    <div class="input-box">
                        <span>Exp. Month: </span>
                        <input type="text" name="expiration_month" placeholder="August">
                    </div>

                    <div class="flex">
                        <div class="input-box">
                            <span>Exp. Year: </span>
                            <input type="text" name="expiration_year" placeholder="2025">
                        </div>
                        <div class="input-box">
                            <span>CVV: </span>
                            <input type="number" name="cvv" placeholder="123">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn">Submit</button>
        </form>
    </div>

    <!--=============== THEME JS ===============-->
    <script src="assets/js/theme.js"></script>
    
</body>
</html>