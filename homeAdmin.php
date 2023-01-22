<?php

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


<div class="container">

  <div class="row">
      <a href="addproduct.php" class="cardhome">

        <div class="card-body">
            add products
        </div>

      </a>
      <a href="editproducts.php" class="cardhome">

        <div class="card-body">
            edit products
        </div>

      </a>
      <a href="orders.php" class="cardhome">

        <div class="card-body">
            orders
        </div>

      </a>
      <a href="adminperm.php" class="cardhome">
        <div class="card-body">
            admin perm
        </div>

      </a>


  </div>

  <!-- <div class="category">
  </div> -->

</div>




</div>
</main>

</body>
<?php require("footer.php"); ?>
</html>
