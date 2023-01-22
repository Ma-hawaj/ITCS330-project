<?php
if(isset($_GET['cat'])){
    switch($_GET['cat']){
        case 0:
            $con = 'category = "voice assistants"';
            break;
        case 1:
            $con = "category = 'Smart switches'";
            break;
        case 2:
            $con = "category = 'Smart lights'";
            break;
        case 3:
            $con = "category = 'Smart sensors'";
            break;
        case 4:
            $con = "category = 'Smart plugs'";
            break;
        case 5:
            $con = "category = 'Smart controllers'";
            break;
        default:
            $con ="1";

    }}else{
        $con = "1";
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
<style>
body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<body>

<?php require("header.php"); ?>
<form class="example" method="get">
  <input type="text" placeholder="Search By Name.." name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
  <button type="submit">Search</button>
</form>
<main class="cards">
<div class="back-cards">
<?php
$err = "";
try
{
    require("connection.php");

    if(isset($_GET['search']) && !empty($_GET['search']))
    {
        $search = $_GET['search'];

        $cookie_name = "search";
        $cookie_value = $search;

        setcookie($cookie_name, $cookie_value);
    }
    else
    {
        $cookie_name = "search";
        unset($_COOKIE[$cookie_name]);
    }

    if(isset($_GET['search']) && !empty($_GET['search']))
    {
        $search = $_GET['search'];

        $rs= $db->prepare("SELECT * FROM products WHERE name like '%$search%'");
        $rs->execute();
    }
    else
    {
        $rs= $db->prepare("SELECT * FROM products WHERE ".$con);
        $rs->execute();
    }
    $db = null;
}
catch(PDOException $er)
{
    $err .= $er;
}

    while($row = $rs->fetch())
    {
        $already_added = (isset($_COOKIE['id_' . $row['PID']])) ? '(Already Added)' : '';
        echo '
        <article class="card">
        <img src="'. $row['image'] .'">
        <div class="text">
        <h3 class="card-title">'. $row['name'] . ' ' . $already_added . '</h3>
        <p>'. $row['price'] .' BD</p>';
        if($row['qty'] == 0)
        {
            echo"out of stock";
        }
        else
        {
            echo'
            <form action="addToCart.php" method="post">
                <input type="hidden" name="id" value="'. $row['PID'] .'"></br>
                <input type="number" value="1" name="qty" min="1" max="'. $row['qty'] .'">
                <input type="submit" name="addToCart" value="Add to Cart">
            </form>
            ';
        }
        echo" </div></article>";


    }



?>

</div>
</main>
</body>
</html>
