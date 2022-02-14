<?php
include("../config/conn.php");
include ("includes/loginCheck.php");

if (isset($_GET['id']) && isset($_GET['image_name'])) {

    $id = $_GET['id'];
    $imageName = $_GET['image_name'];


    if ($imageName != "") {
        $path = "../images/category/" . $imageName;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'>Failed To Delete Category Image</div>";
            header("location:".SITEURL."admin/manageCategory.php");
            die();
        }
    }

    $sql2 = "SELECT image_name FROM food WHERE category_id = '$id';";
    $res2 = mysqli_query($conn, $sql2);
    if ($res2 == true) {
        $count = mysqli_num_rows($res2);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res2)) {
                $path2 = "../images/food/".$row['image_name'];
                $remove2 = unlink($path2);

                if ($remove2 == false) {
                    $_SESSION['remove'] = "<div class='error'>Failed To Delete Food Images</div>";
                    header("location:".SITEURL."admin/manageCategory.php");
                    die();
                }
            }
        }
    }

    $sql = "DELETE FROM category WHERE id=$id";

    $res = mysqli_query($conn,$sql);

    if ($res == true) {
        $_SESSION['remove'] = "<div class='success'>Category Deleted Successfully</div>";
    } else {
        $_SESSION['remove'] = "<div class='error'>Failed To Delete Category</div>";
    }


}

header("location:".SITEURL."admin/manageCategory.php");

