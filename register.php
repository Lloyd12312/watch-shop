<?php
include 'dbconfig.php';

if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);
    
    $checkEmail="SELECT * FROM users WHERE email='$email'";
    $result=$connect->query($checkEmail);
    if($result->num_rows > 0){
        echo "Email Address Already Exist!";
    }
    else {
        $insertQuery="INSERT INTO users(firstName, lastName, email, password) 
                        VALUES ('$firstName','$lastName','$email','$password')";
        if($connect->query($insertQuery)==TRUE){
            $user_id = $connect->insert_id;
            $cartInsertQuery = "INSERT INTO cart (user_id) VALUES ($user_id)";
            if($connect->query($cartInsertQuery) === TRUE) {
                header("location: login.php");
            } else {
                echo "Error creating cart: " . $connect->error;
            }
        }
        else{
            echo "ERROR:".$connect->error;
        }
    }
}

if(isset($_POST['signIn'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $sql="SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result=$connect->query($sql);
    if($result->num_rows > 0){
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['email']=$row['email'];
        $_SESSION['user_id'] = $row['id'];
        header("Location: index.php");
        exit();
    }
    else{
        echo "Not Found, Incorrect Email or Password";
    }
}
?>