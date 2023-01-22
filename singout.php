<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['cart']);
    for ($i=0; $i <50 ; $i++) {
      setcookie("id_".$i,"",time()-3600);
    }
    session_destroy();
    header("location:/ITCS330 PROJECT/home.php");
?>
