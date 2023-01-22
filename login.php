<?php
session_start();
    $err = "";
if (isset($_POST['login'])) {

  $username=$_POST['username'];
  $password=$_POST['password'];

  try {
      require('connection.php');
    $rs= $db->prepare("SELECT * FROM users where username = '$username'");
    $rs->execute();
      $db=null;
  } catch (PDOException $ex) {
    echo "error";
    die($ex->getMessage());

  }
  if ($row = $rs->fetch()) {
    if (password_verify($password, $row['pass'])) {

      $_SESSION['user']['id'] = $row['user_ID'];
      $_SESSION['user']['name'] = $row['name'];
      $_SESSION['user']['admin'] = $row['admin'];

    }
    else {
      $err = "wrong password or username";
    }
   }
    else {
      $err = "wrong password or username";
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
  <title>Log in</title>
</head>
<body>

<?php require("header.php"); ?>

<main class="login">


  <div class="back">

    <div class="container-login">

      <?php   if(isset($_POST['login'])) {
        if (password_verify($password, $row['pass'])) {

        echo "successful login";
        }

        }
          else{
            echo "login";
          } ?><br>
      <form action="login.php" method="post">


        <input class="input" type="text" name="username" placeholder="username"> <br>
        <input class="input" type="password" name="password" placeholder="password"><br>
        <?php echo $err; ?>
        <input class="input" type="submit" name="login" value="login">
      </form>
    </div>
  </div>
</main>

</body>
</html>
