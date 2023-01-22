<?php
session_start();
$err='';
if(!isset($_SESSION['user'])){
    header("location:/ITCS330 project/login.php");
}elseif($_SESSION['user']['admin'] == false){
        $err .= "Admin login needed";
}else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Master.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        .flexContainer{
            /* display: flex;
            flex-direction: column;
            width: 100%;
            align-items: flex-start; */
            background-color: rgba(36, 120, 45, 0.8);
        }

        .record{
          display: flex;
          flex-direction: row;
          justify-content: space-between;
          align-items: center;
          width: 100%;
          padding-left:60px;
          padding-right: 60px;
        }


    </style>
</head>
<body>

    <?php require("header.php"); ?>
    <main>


    <div class="flexContainer">

        <div class="record">
            <div>
                <h6>Customer name</h6>
            </div>
            <div>
                <h6>Order Date</h6>
            </div>
            <div>
                <h6>Total Price</h6>
            </div>
        </div>
        <?php
        require("connection.php");
        try{
        $stmt = $db->prepare("SELECT orders.order_ID,users.name,orders.date,orders.total_price
         FROM orders JOIN users ON orders.user_ID = users.user_ID");
        $stmt->execute();
        $db = null;
        }catch(PDOException $e){
            $err .= $e;
        }
        while($row = $stmt->fetch()){

            echo'<a href="viewOrder.php?ord='.$row[0].'">
            <div class="record">
            <div>
                <h6>'.$row[1].'</h6>
            </div>
            <div>
                <h6>'.$row[2].'</h6>
            </div>
            <div>
                <h6>'.$row[3].'</h6>
            </div>
            </div></a>';
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
