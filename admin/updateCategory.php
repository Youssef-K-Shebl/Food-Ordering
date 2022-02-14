<?php

include('includes/header.inc.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM category WHERE id=$id";
    $res = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        //redirect to manage category with session message
        $_SESSION['no-category-found'] = "<div class ='error'>Category not found</div>";
        header('location:'.SITEURL.'admin/manageCategory.php');
    }


} else {
    header('location:'.SITEURL.'admin/manageCategory.php');
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
        <?php
        if (isset($_SESSION['choose-one-option'])) {
            echo $_SESSION['choose-one-option']."<br><br>";
            unset($_SESSION['choose-one-option']);
        }

        ?>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if ($current_image!="") {
                        ?>
                                <img src="<?php echo SITEURL.'images/category/'. $current_image ?>" alt="">
                                <br>

                                <label>just remove image?</label>
                                <input type="checkbox" name="remove_image" value="remove">

                                <?php
                            } else {

                                echo "<div class='error'>Image not added</div>";

                            }
                            ?>


                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured == "Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if($featured == "No"){ echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if($active == "Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                        <input <?php if($active == "No"){ echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input class="btn-secondary" type="submit" name="submit" value="Update Category">
                    </td>
                </tr>


            </table>
        </form>
    </div>
</div>

<?php

include('includes/footer.inc.php');

if (isset($_POST["submit"])) {
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    $image_name = $_FILES['image']['name'];

    if (!isset($_POST['remove_image'])) {


        if ($image_name != "") {

            if ($current_image != "") {
                $remove_path = "../images/category/" . $current_image;
                $remove = unlink($remove_path);

                if ($remove == false) {
                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                    header('location:'.SITEURL.'admin/manageCategory.php');
                    die();
                }
            }


            $ext = end(explode('.',$image_name));

            $image_name = "Food_Category_".rand(000,999).'.'.$ext;

            $sourcePath = $_FILES['image']['tmp_name'];
            $destinationPath = "../images/category/".$image_name;

            $upload = move_uploaded_file($sourcePath,$destinationPath);

            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                header("location:".SITEURL."admin/manageCategory.php");
                die();
            }


        } else {
            $image_name = $current_image;
        }
    } else {
        if ($image_name != "") {
            $_SESSION['choose-one-option'] = "<div class='error'>Please select one option either upload new image or remove image</div>";
            header("location:".SITEURL."admin/updateCategory.php?id=". $id);
            die();
        }


        $remove_path = "../images/category/" . $current_image;
        $remove = unlink($remove_path);

        if ($remove == false) {
            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
            header('location:'.SITEURL.'admin/manageCategory.php');
            die();
        }

        $image_name = "";
    }



    $sql2 = "UPDATE category SET
        title = '$title',
        featured = '$featured',
        active = '$active',
        image_name = '$image_name'
        WHERE id = $id;
    ";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $_SESSION['update'] = "<div class='success'>Category updated successfully</div>";
    } else {
        $_SESSION['update'] = "<div class='error'>failed to updated category</div>";
    }
    header('location:'.SITEURL.'admin/manageCategory.php');

}

?>
