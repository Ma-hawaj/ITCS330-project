<?php
session_start();


if(isset($_SESSION['user'])){
echo $_SESSION['user']['name'];
echo $_SESSION['user']['admin'];
}
else{
    echo "no user";
}

?>
