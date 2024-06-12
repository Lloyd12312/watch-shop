<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--=============== SWIPER CSS ===============--> 
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

  <div>
    <i class='bx bx-moon change-theme' id="theme-button"></i>
    <!--==================== SIGNUP ====================-->
    <div class="container" id="signup" style="display:none;">
      <h1 class="form-title">Register</h1>
      <form method="post" action="register.php">
        <div class="input-group">
            <i class='bx bx-user icon'></i>
           <input class="input-date" type="text" name="fName" id="fName" placeholder="First Name" required>
           <label for="fName">First Name</label>
        </div>
        <div class="input-group">
            <i class='bx bx-user icon'></i>
            <input class="input-date" type="text" name="lName" id="lName" placeholder="Last Name" required>
            <label for="lName">Last Name</label>
        </div>
        <div class="input-group">
            <i class='bx bx-envelope icon'></i>
            <input class="input-date" type="email" name="email" id="signUp-email" placeholder="Email" required>
            <label for="signUp-email">Email</label>
        </div>
        <div class="input-group">
            <i class='bx bx-lock icon'></i>
            <input class="input-date" type="password" name="password" id="signUp-password" placeholder="Password" required>
            <label for="signUp-password">Password</label>
        </div>
       <input type="submit" class="btn" value="Sign Up" name="signUp">
      </form>
      <p class="or">
        or
      </p>
      <div class="icons">
        <i class='bx bxl-facebook icon'></i>
        <i class='bx bxl-google icon'></i>
      </div>
      <div class="links">
        <p>Already Have an Account?</p>
        <button id="signInButton">Sign In</button>
      </div>
    </div>

    <!--==================== SIGNIN ====================-->
    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="register.php">
          <div class="input-group">
            <i class='bx bx-envelope icon'></i>
            <input class="input-date" type="email" name="email" id="signIn-email" placeholder="Email" required>
            <label for="signIn-email">Email</label>
          </div>
          <div class="input-group">
            <i class='bx bx-lock icon'></i>
            <input class="input-date" type="password" name="password" id="signIn-password" placeholder="Password" required>
            <label for="signIn-password">Password</label>
          </div>
          <p class="recover">
            <a href="#">Recover Password</a>
          </p>
         <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <p class="or">
          or
        </p>
        <div class="icons">
            <i class='bx bxl-facebook icon'></i>
            <i class='bx bxl-google icon'></i>
        </div>
        <div class="links">
          <p>Don't have an account yet?</p>
          <button id="signUpButton">Sign Up</button>
        </div>
      </div>
  </div>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/login.js"></script>

    <!--=============== THEME JS ===============-->
    <script src="assets/js/theme.js"></script>

</body>
</html>