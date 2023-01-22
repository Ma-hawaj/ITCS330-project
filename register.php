<?php
session_start();

    $err = "";
if (isset($_POST['re'])) {

    $err = "";
    if (preg_match("/^[A-Za-z_.0-9]{1,20}$/", $_POST['username'])) {
        $user = trim($_POST['username']);

        if (preg_match("/^(?=.*[a-z])(?=.*[0-9])[A-za-z0-9_#@%\*\-]{8,24}$/", $_POST['pass'])) {
            $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
            if (preg_match("/^[361][0-9]{7}$/", $_POST['phone'])) {
                $phone = trim($_POST['phone']);

                if (preg_match("/^[a-zA-Z\s]{3,50}$/", $_POST['name'])) {

                    $name = trim($_POST['name']);

                    if (preg_match("/^[0-9]{1,4}$/", $_POST['block'])) {
                        $block = trim($_POST['block']);
                        if (preg_match("/^[0-9]{1,5}$/", $_POST['street'])) {
                            $street = trim($_POST['street']);
                            if (preg_match("/^[0-9]{1,5}([\/\-][0-9]{0,3})?$/", $_POST['home'])) {
                                $home = trim($_POST['home']);

                                try {

                                    require("connection.php");

                                    $rs = $db->prepare("SELECT * FROM users where username = '$user'");

                                    $rs->execute();

                                    if ($row = $rs->fetch()) {
                                        $err .= "username is already used";
                                    } else {
                                        $stmt = $db->prepare("INSERT INTO `users`(`username`, `pass`, `name`, `phone`, `block`, `street`, `home`)
                                VALUES (:user , :pass , :name , :phone , :block , :street , :home)");

                                        $stmt->bindParam(":user", $user);
                                        $stmt->bindParam(":pass", $pass);
                                        $stmt->bindParam(":name", $name);
                                        $stmt->bindParam(":phone", $phone);
                                        $stmt->bindParam(":block", $block);
                                        $stmt->bindParam(":street", $street);
                                        $stmt->bindParam(":home", $home);
                                        $stmt->execute();
                                        $_SESSION['user']['id'] = $db->lastInsertId();
                                        $_SESSION['user']['name'] = $name;
                                        $_SESSION['user']['admin'] = false;

                                        $db = null;
                                    }
                                } catch (PDOException $er) {
                                    $err .= $er;
                                }
                            } else {
                                $err .= "invalid home number";
                            }
                        } else {
                            $err .= "invalid street number";
                        }
                    } else {
                        $err .= "invalid block number";
                    }
                } else {
                    $err .= "invalid name";
                }
            } else {
                $err .= "invalid phone number";
            }
        } else {
            $err .= "invalid password";
        }
    } else {
        $err .= "invalid username";
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
    <title>Register</title>
</head>

<body>

    <?php require("header.php"); ?>

    <main class="login">


        <div class="back">

            <div class="container-register">
                <form action="register.php" method="post">

                    <label for="username"> </label><input class="input" type="text" name="username" placeholder="username"></br>
                    <label for="pass"></label><input class="input" type="password" name="pass" placeholder="password"></br>
                    <label for="phone"> </label><input class="input" type="text" name="phone" placeholder="phone numeber"></br>
                    <label for="name"> </label><input class="input" type="text" name="name" placeholder="name"></br>
                    <label for="block"> </label><input class="input" type="text" name="block" placeholder="block"></br>
                    <label for="street"></label><input class="input" type="text" name="street" placeholder="street"></br>
                    <label for="home"> </label><input class="input" type="text" name="home" placeholder="home"></br>
                    <?php
                    echo $err . "</br>";
                    ?>

                    <input type="submit" name="re" value="Register">

                </form>
            </div>
        </div>
    </main>

</body>

</html>
