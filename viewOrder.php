<?php
session_start();
$err="";
if(!isset($_SESSION['user'])){
    header("location:/login.php");
}elseif($_SESSION['user']['admin'] == false){
        $err .= "Admin login needed";
}elseif(isset($_GET['ord'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Master.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
</head>
<body>
<style>
    P{
        color: white;
    }
    h3{
      color: white;
    }
    .orderinfo{
        width: 30%;
        float: right;
    }
    .prod{
        width: 70%;
        display: flex;
        flex-direction: column;
    }
    .ordcard{
        max-height: 33%;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
    .ordcard img{
        max-width: 15%;
        padding: 10px;
        border: 2px solid;
        margin: 20px;

    }
</style>



<?php
require("header.php");
echo "<main>
  <div class='back-vieworders'>";
try{
    require("connection.php");
    $stmt = $db->prepare("SELECT * FROM orders JOIN users ON users.user_ID = orders.user_ID WHERE order_ID = ?");
    $stmt->execute(array($_GET['ord']));
    if($row = $stmt->fetch()){
        echo '
        <div class="orderinfo">
        <p><b>Order Number: </b>'.$row['order_ID'].'</p>
        <p><b>Customer Name: </b>'.$row['name'].'</p>
        <p><b>Customer Contact : </b>'.$row['phone'].'</p>
        <p><b>Order Date: </b>'.$row['date'].'</p>
        <p><b>Total price: </b>'.$row['total_price'].'</p>
        <fieldset>
          <p> <legend><b>Customer Address</b></legend>
            Block: '.$row['block'].' <br>
            Street: '.$row['street'].' <br>
            Home: '.$row['home'].' <br></p>
        </fieldset>
        </div>
        ';

        $prod = $db->prepare("SELECT * FROM orderDets WHERE order_ID = ?");
        $prod->execute(array($_GET['ord']));
        $det = $db->prepare("SELECT * FROM products WHERE PID = :pid");
        $det->bindParam(":pid",$pid);
        echo '<div class="prod">';
        while($data = $prod->fetch()){
            $pid = $data['PID'];
            $det->execute();
            if($pd = $det->fetch()){
                echo '
                <div class="ordcard">
                <img src="'. $pd['image'] .'">
                <div class="text">
                <h3 class="card-title">'. $pd['name'] .'</h3>
                <p>'. $pd['price'] .' BD</p>
                </div>
                </div>';

            }

        }
        echo '</div>';

    }

}catch(PDOException $e){
    $err .= $e;
}



?>



</div>
</main>
</body>
</html>





<?php
}
echo $err;
?>
