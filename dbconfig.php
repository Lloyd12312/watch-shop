<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "watchshop";
$connect = new mysqli($db_server, $db_user, $db_pass, $db_name);
if($connect->connect_error){
    echo "Faild to connect DB".$connect->connect_error;
}