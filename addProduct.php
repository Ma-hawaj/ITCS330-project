<?php
session_start();

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$err="";

if(isset($_POST['add'])){

if(!isset($_SESSION['user'])){
  header("location:/ITCS330 project/login.php");
}elseif($_SESSION['user']['admin'] == false){
    $err .= "Admin login needed";
}elseif(empty(test_input($_POST['name']))){
    $err .= "name is required!";
}elseif(empty(test_input($_POST['price']))){
    $err .= "price is required!";
}elseif(empty(test_input($_POST['qty']))){
    $err .= "quantity is required!";
}elseif(empty(test_input($_POST['cat']))){
    $err .= "cat is required!";
}else{

    $target_file = "images/" . basename($_FILES['image']['name']);
    $uploadOK =1;
    $imgfiletype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($_FILES['image']['size'] > 10000000){
        $err .= "image is too large";
        $uploadOK = 0;
    }elseif($imgfiletype != "jpg" && $imgfiletype != "jpeg" && $imgfiletype != "png" && $imgfiletype != "gif"){
        $err .= "wrong image format";
        $uploadOK = 0;
    }

    if($uploadOK == 1 && move_uploaded_file($_FILES['image']['tmp_name'],$target_file))
    {

    $name = test_input($_POST['name']);
    $price = test_input($_POST['price']);
    $qty = test_input($_POST['qty']);
    $cat = test_input($_POST['cat']);
    $image = $target_file;
    $desc = test_input($_POST['desc']);

    try{

        require("connection.php");
        $stmt = $db->prepare("INSERT INTO `products`(`name`, `price`, `qty`, `category`, `image`, `description`)
         VALUES ( :name , :price , :qty , :cat , :image , :desc )");

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":qty", $qty);
        $stmt->bindParam(":cat", $cat);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":desc", $desc);
        $stmt->execute();
        $db = null;

        }
        catch(PDOException $er){
            $err .= $er;

        }
    }
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
    <title>Add Product</title>
</head>
<body>

<?php require("header.php"); ?>

<main class="login ">
    <div class="back">

        <div style="display: flex; justify-content: center; align-items: center; text-align: left; background-color: white; width: 500px; padding: 10px;">

            <form action="addProduct.php" method="post" enctype="multipart/form-data">

                <label for="name">Product name: </label>
                <input class="input" type="text" name="name">
                </br>
                <label for="price">price: </label>
                <input class="input" type="text" name="price">
                </br>
                <label for="qty">quantity: </label>
                <input class="input" type="number" name="qty">
                </br>
                <label for="cat">cat: </label><select name="cat">
                    <option value="voice assistants">voice assistants</option>
                    <option value="Smart switches">Smart switches</option>
                    <option value="Smart lights">Smart lights</option>
                    <option value="smart sensors">smart sensors</option>
                    <option value="smart plugs">smart plugs</option>
                    <option value="smart controllers">smart controllers</option>
                </select>
                </br>
                <label for="image">image: </label>
                <input class="input" type="file" name="image">
                </br>
                <label for="desc">product description: </label>
                <textarea name="desc"></textarea>
                </br>
                <?php
                    echo $err . "</br>";
                ?>

                <input type="submit" name="add" value="Add Product">



            </form>
        </div>
    </div>
</main>

</body>
</html>
