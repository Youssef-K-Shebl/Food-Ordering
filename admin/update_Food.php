<?php ob_start(); ?>
<?php
include ('includes/header.inc.php');

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    //make the query to get the data
    $sql = "SELECT food.*, category.title AS catTitle FROM food
            INNER JOIN category
            ON food.category_id = category.id
            WHERE food.id = $id;
            ";
    $res = mysqli_query($conn, $sql);
    //check success of query
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {

            //assign data to variables
            $row = mysqli_fetch_assoc($res);
            $title = $row["title"];
            $description = $row["descripion"];
            $price = $row["price"];
            $currentImage = $row["image_name"];
            $featured = $row["featured"];
            $active = $row["active"];
            $category = $row["catTitle"];
            $category_id = $row["category_id"];

            //Get all category titles
            $sql2 = "SELECT id, title FROM category";
            $res2 = mysqli_query($conn,$sql2);
            $count2 = mysqli_num_rows($res2);


        } else {
            $_SESSION["error"] = "<div class='error'>Category not found</div>";
            header("location:".SITEURL."admin/manageFood.php");
            die();
        }
    }


} else {
    header("location:".SITEURL."admin/manageFood.php");
    die();
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

        if (isset($_SESSION['no-category'])) {
            echo $_SESSION['no-category']."<br><br>";
            unset($_SESSION['no-category']);
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
                    <td>Description: </td>
                    <td>
                        <input type="text" name="description" value="<?php echo $description; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($currentImage!="") {
                            ?>
                            <img src="<?php echo SITEURL.'images/food/'. $currentImage ?>" alt="">
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
                    <td>Select Category: </td>
                    <td>
                        <select name="category">
                            <?php

                                if ($count2 > 0) {
                                    while ($row2 = mysqli_fetch_assoc($res2)) {
                                        $categoryId = $row2["id"];
                                        $categoryTitle = $row2["title"]
                            ?>
                                        <option <?php if ($categoryId == $category_id) {echo "selected";} ?> value="<?php echo $categoryId ?>"><?php echo $categoryTitle ?></option>
                            <?php
                                    }
                                } else {
                                ?>

                                    <option value="0">No category found</option>

                                <?php
                                }

                            ?>
                        </select>
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
                        <input type="hidden" name="current_image" value="<?php echo $currentImage; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input class="btn-secondary" type="submit" name="submit" value="Update Food">
                    </td>
                </tr>


            </table>
        </form>
    </div>
</div>




<?php
include ('includes/footer.inc.php');
?>

<?php
if (isset($_POST["submit"])) {
    //get the data sent by the form
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $price = $_POST["price"];
    $featured = $_POST["featured"];
    $active = $_POST["active"];

    $category = $_POST["category"];
    if ($category == 0) {
        $_SESSION['no-category'] = "<div class='error'>No category found</div>";
        header("location:".SITEURL."admin/updateFood.php?id=".$id);
        die();
    }

    $image = $_FILES["image"]["name"];


    //check if he checked to remove image or not

    if (!isset($_POST["remove_image"])) {

        if ($image != "") {
            //check if there's current image
            if ($currentImage != "") {
                //delete the current image
                $path = "../images/food/" . $currentImage;
                $remove = unlink($path);
                if ($remove == false) {
                    $_SESSION["remove"] = "<div class='error'>can't remove current image</div>";
                    header("location:".SITEURL."admin/manageFood.php");
                    die();
                }
            }

            //get extension
            $ext = explode('.', $image);
            $ext = end($ext);

            //rename the image
            $image = "Food_" . rand(000,999). "." .$ext;

            //upload the new Image

            $sourcePath = $_FILES["image"]["tmp_name"];
            $destinationPath = "../images/food/".$image;

            $upload = move_uploaded_file($sourcePath, $destinationPath);
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                header("location:".SITEURL."admin/manageFood.php");
                die();
            }


        } else {
            $image = $currentImage;
        }


    } else {
        if ($image != "") {
            $_SESSION["choose-one-option"] = "<div class='error'>Please select one option either upload new image or remove image</div>";
            header("location:".SITEURL."admin/update_food.php?id=".$id);
            die();
        }
        //delete th current image
        $currentPath = '../images/food/'.$currentImage;
        $removeCurrent = unlink($currentPath);

        if ($removeCurrent == false) {
            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
            header('location:'.SITEURL.'admin/manageFood.php');
            die();
        }

        $image = "";
    }

    $sql3 = "UPDATE food SET
            title = '$title',
            descripion = '$description',
            price = $price,
            image_name = '$image',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            WHERE id = $id;
    ";

    $res3 = mysqli_query($conn,$sql3);

    if ($res3 == true) {
        $_SESSION['update'] = "<div class='success'>Food updated successfully</div>";
    } else {
        $_SESSION['update'] = "<div class='error'>failed to updated Food</div>";
    }
    header('location:'.SITEURL.'admin/manageFood.php');

}
?>
<?php ob_end_flush(); ?>
