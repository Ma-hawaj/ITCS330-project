<?php
session_start();
$err="";
if(!isset($_SESSION['user'])){
    header("location:/login.php");
}elseif($_SESSION['user']['admin'] == false){
        $err .= "Admin login needed";
}else{

    if(isset($_POST['chg'])){
        try{
            $id = $_POST['id'];
            require("connection.php");
            $upd = $db->prepare("UPDATE `users` SET `admin`= NOT admin WHERE user_ID = :id");
            $upd->bindParam(":id",$id);
            $upd->execute();
            $db = null;
        }catch(PDOException $e){
            $err .= $e;
        }
    }

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
                <h6>Username</h6>
            </div>
            <div>
                <h6>Status</h6>
            </div>
            <div>
                <h6>Change</h6>
            </div>
        </div>
        <?php
        require("connection.php");
        try{
        $stmt = $db->prepare("SELECT * FROM users");
        $stmt->execute();
        $db = null;
        }catch(PDOException $e){
            $err .= $e;
        }
        while($row = $stmt->fetch()){

            if($row['admin']){
                $adm = "Admin";
            }else{
                $adm = "Not Admin";
            }

            echo'
            <div class="record">
            <div>
                <h6>'.$row['username'].'</h6>
            </div>
            <div>
                <h6>'.$adm.'</h6>
            </div>
            <div>
                <form method="post">
                <input type="submit" name="chg" value="Change Admin">
                <input type="hidden" name="id" value="'.$row['user_ID'].'">
                </form>
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
