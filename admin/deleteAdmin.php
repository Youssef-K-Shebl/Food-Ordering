<?php

include("../config/conn.php");
include ("includes/loginCheck.php");
if (isset($_GET['id']) && isset($_GET['username'])) {
    $id = $_GET['id'];
    $username = $_GET['username'];

    $sql = "DELETE FROM admin WHERE id = $id";


    $res = mysqli_query($conn, $sql);

    if ($res == true) {

        $_SESSION['delete'] = "<div class='success'>Admin deleted Successfully</div>";
    } else {

        $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";
    }

    if ($username == $_SESSION['user']) {
        include ('logout.php');
    }
}

header("location:".SITEURL.'admin/manageAdmin.php');



