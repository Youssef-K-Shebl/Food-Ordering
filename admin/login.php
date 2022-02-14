<?php include("../config/conn.php") ?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../css/admin.css">
        <title>Login - Food Order System</title>
    </head>
    <body>
        <div class="login">
            <h2 class="text-center">Login</h2>
            <br>
            <?php
                if (isset($_SESSION['noLoginMessage'])) {
                    echo $_SESSION['noLoginMessage'];
                    unset($_SESSION['noLoginMessage']);
                }
            ?>

            <br>

            <!-- Login Form Starts Here -->

            <form action="" method="post" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter username"> <br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"> <br><br>
                <input type="submit" value="Login" name="submit" class="btn-primary">
                <br><br>
                <?php
                    if (isset($_SESSION['login'])) {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br>
            </form>

            <!-- Login Form Ends Here -->

            <p class="text-center">Created By Youssef Kamel</p>
        </div>
    </body>
</html>

<?php

    if (isset($_POST['submit'])) {

        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password';";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $_SESSION['login'] = "<div class='success text-center'>Login Successful</div>";
                $_SESSION['user'] = $username;
                header("location:".SITEURL."admin/");
            } else {
                $_SESSION['login'] = "<div class='error text-center'>Username or password doesn't match</div>";
                header("location:".SITEURL."admin/login.php");
            }
        }

    }

?>