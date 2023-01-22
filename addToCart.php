<?php

session_start();

//require("checkLogin.php");
if(!isset($_SESSION['user'])||empty($_SESSION['user'])){
    header("location:/ITCS330 PROJECT/login.php");
}else{


if(isset($_SESSION['cart'][$_POST['id']]))
{
    $_SESSION['cart'][$_POST['id']] += (int)$_POST['qty'];

}else{
    $_SESSION['cart'][$_POST['id']] = (int)$_POST['qty'];
}

if(isset($_POST['id']))
{
    $alladdedproduct = [];
    $cookie_value = $_POST['id'];
    $cookie_name = 'id_' . $cookie_value;

    setcookie($cookie_name, $cookie_value);
}


header('location:allProducts.php');}

?>
