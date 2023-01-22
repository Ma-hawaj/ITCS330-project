<?php
try{

    require("connection.php");

    $rs= $db->prepare("SELECT * FROM products");
    $rs->execute();



    }


    catch(PDOException $er){
        $err .= $er;

    }
session_start();
if(!isset($_SESSION['user'])){
header("location:/login.php");
}elseif($_SESSION['user']['admin'] == false){
  echo "you do not have access to this page ";
  die();
}
if(isset($_POST['update'])){

  $id=$_POST['id'];
  $qty1=$_POST['qty'];
  $result = $db->exec("UPDATE products SET Qty=$qty1 WHERE PID = $id");
  header('location: editproducts.php');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Master.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>

<?php require("header.php"); ?>

<main class="cards">
<div class="back-cards">
<?php




    while($row = $rs->fetch()){
        echo '
        <article class="card">
        <img src="'. $row['image'] .'">
        <div class="text">
        <h3 class="card-title">'. $row['name'] .'</h3>
        <p.>'. $row['price'] .' BD</p>';
            echo'
            <form action="editproducts.php" method="post">
            <input type="hidden" name="id" value="'. $row['PID'] .'"></br>
              <p> <input type="number" name="qty" min="0" value="'.$row['qty'].'"></p>
               <input type="submit" name="update" value="update">
            </form>
            ';

        echo" </div></article>";


    }


$db = null;
?>

</div>
</main>
</body>
</html>
