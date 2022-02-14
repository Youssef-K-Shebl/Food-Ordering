<?php

if (!isset($_SESSION['user'])) {
    $_SESSION['noLoginMessage'] = "<div class='error text-center'>Please login to access admin panel</div>";
    header("location:".SITEURL."admin/login.php");
    die();
}