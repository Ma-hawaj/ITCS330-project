<?php
try {
    require('connection.php');
  $rs= $db->prepare("SELECT state FROM status ORDER BY ID DESC LIMIT 1");
  $rs->execute();
    $db=null;
} catch (PDOException $ex) {
  echo "error";
  die($ex->getMessage());

}
if ($row = $rs->fetch()) {
  if ($row['state'] == 0) {
    //require("maintanance.php");
    header("location:/ITCS330 project/maintanance.php");
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
  <title>Home</title>
</head>
<body>

<?php require("header.php"); ?>


<main>


<div class="back-items">
<table>
  <tr>
<td ><div class="welcome">
  <p class="text">Welcome to smart thing, where you can find all the smart items you seek.</p><br/>

</div></td>
  </tr>
  <!-- <tr>
<td><div class="category">category 1</div></td>
  <td><div class="category">category 2</div></td>
  <td><div class="category">category 3</div></td>

  </tr>
  <tr>
    <td><div class="category">category 4</div></td>
    <td><div class="category">category 5</div></td>
    <td><div class="category">category 6</div></td>
  </tr> -->

</table>

<div class="container">

  <div class="row">
      <a href="allProducts.php?cat=0" class="cardhome1">

        <div class="card-body">
            voice assistants
        </div>

      </a>
      <a href="allProducts.php?cat=1" class="cardhome2">

        <div class="card-body">
            smart switches
        </div>

      </a>
      <a href="allProducts.php?cat=2" class="cardhome3">

        <div class="card-body">
            smart lights
        </div>

      </a>
      <a href="allProducts.php?cat=4" class="cardhome4">
        <div class="card-body">
            smart plugs
        </div>

      </a>
      <a href="allProducts.php?cat=5" class="cardhome5">
        <div class="card-body">
            smart controllers
        </div>

      </a>
      <a href="allProducts.php?cat=3" class="cardhome6">
        <div class="card-body">
            smart sensors
        </div>

      </a>

  </div>

  <!-- <div class="category">
  </div> -->

</div>




</div>
</main>

</body>
</html>
