<?php
session_start();

require("connection.php");
$stmt = $db->prepare("SELECT * FROM products WHERE PID = ?");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Master.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My cart</title>
</head>
<body>


    <?php require("header.php"); ?>

    <main class="cards">
    <div class="back-cards">

    <?php
    $ttlprice=0;
    $err="";
    if(isset($_SESSION['cart'])&&!empty($_SESSION['cart'])){

        echo '<form class="form" action="processcart.php" method="post">';
        foreach($_SESSION['cart'] as $pid => $qty){

          try{
                $stmt->execute(array($pid));

            }
            catch(PDOException $e){
                $err .= $e;
            }

            if($data = $stmt->fetch()){
                if($qty > 0){

                    $ttlprice += $data['price']*$qty;

                    echo '
                    <article class="card">
                    <img src="'. $data['image'] .'">

                    <div class="text">
                     <h3 class="card-title">'. $data['name'] .'</h3>
                    <p>'. $data['price'] .' BD</p>

                    <div class="form">

                    <p> <input type="number" name="qty[]" min="0" max="'.$data['qty'].'" value="'.$qty.'"></p>
                    <p> <a href="removeitem.php?pid='.$pid.'">Remove</a> </p>
                    <input type="hidden" name="pid[]" value="'.$pid.'">
                    </div>';
 echo" </div></article>";


                }
            }

        }
        echo "<div class='input-thing'>";
        echo '<input type="submit" name="upd" value="Update All">';
        echo '<input type="submit" name="plc" value="Place Order">';
        echo '<input type="hidden" name="prc" value="'.$ttlprice.'">';
        echo '</form>';
        echo "total price: $ttlprice BD";
        echo "</div>";
    }
    else{
        echo "<h2> Cart is Empty </h2>";
    }

    $db = null;








    ?>

    </div>
    </main>
    <?php echo $err; ?>
</body>
</html>
