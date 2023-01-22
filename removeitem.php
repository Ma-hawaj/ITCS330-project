<?php
session_start();

$id = $_GET['pid'];

unset($_SESSION['cart'][$id]);
setcookie('id_' . $id, "");

header("location:viewCart.php");

?>
