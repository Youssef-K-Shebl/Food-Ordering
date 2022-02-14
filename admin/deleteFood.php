<?php

include("../config/conn.php");
include ("includes/loginCheck.php");

if (isset($_GET["id"]) && isset($_GET["image_name"])) {
    $id = $_GET["id"];
    $imageName = $_GET["image_name"];
    if ($imageName != "") {
        $path = "../images/food/".$imageName;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'>Failed To Delete Food Image</div>";
            header("location:".SITEURL."admin/manageFood.php");
            die();
        }
    }


    $sql = "DELETE FROM food WHERE id=$id;";
    $res = mysqli_query($conn,$sql);
    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Food deleted successfully</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
    }
}

header("location:".SITEURL."admin/manageFood.php");
