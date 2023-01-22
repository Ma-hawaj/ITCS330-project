<?php
 session_start();
$err='';
if(isset($_POST['upd'])){

    $pid = $_POST['pid'];
    $qty = $_POST['qty'];

    for( $i=0 ; $i<count($pid) ; $i++){

        $_SESSION['cart'][$pid[$i]] = $qty[$i];

    }

    header("location:/ITCS330 project/viewCart.php");

}
elseif(isset($_POST['plc'])){

    try{
        require("connection.php");
        $db->beginTransaction();

        $stmt = $db->prepare("INSERT INTO `orders`(`user_ID`, `date`, `total_price`)
        VALUES (:id ,NOW(),:price)");
        $res = $stmt->execute(array(':id'=>$_SESSION['user']['id'],':price'=>$_POST['prc']));

        if($res == 1){
            $orderId = $db->lastInsertId();

            $ins = $db->prepare("INSERT INTO `orderDets`(`order_ID`, `PID`, `qty`)
            VALUES ($orderId,:pid,:qty)");

            $upd = $db->prepare("UPDATE `products` SET `qty`= qty - :qty WHERE pid = :pid");

            $check = $db->prepare("SELECT * FROM products WHERE PID = ?");

            $pid = $_POST['pid'];
            $qty = $_POST['qty'];

            $items = 0;

            for( $i=0 ; $i<count($pid) ; $i++){

                $check->execute(array($pid));
                if($data = $check->fetch()){
                    if($data['qty']<$qty){
                        throw new Exception("No enough stock for the item: ".$data['name']);
                    }
                }

                if($ins->execute(array(':pid'=>$pid[$i],':qty'=>$qty[$i]))){
                    $items++;
                }
                $upd->execute(array(':qty'=>$qty[$i],':pid'=>$pid[$i]));
                setcookie("id_".$pid[$i],"",time()-3600);

            }
            $db->commit();
            unset($_SESSION['cart']);
            echo "Order Placed Successfuly ($items items)";
            echo "<a href='home.php'>Return to main page</a>";
            // for ($i=0; $i <length($pid) ; $i++) {
            //   setcookie("id_".$i,"",time()-3600);
            // }



        }



    }catch(PDOException $er){
        $db->rollBack();
        $err .= $er;

    }
    echo $err;

    $db = null;

}



?>
