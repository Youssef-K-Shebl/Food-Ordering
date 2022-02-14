<?php ob_start(); ?>

<?php
include ('includes/header.inc.php');

$sql = "SELECT id, title FROM category WHERE active = 'Yes';";
$res = mysqli_query($conn, $sql);

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
    <div class="main-content">

        <div class="wrapper">

            <h2>Add Food</h2>
            <?php
            if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
            }

            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['no-category'])) {
                echo $_SESSION['no-category'];
                unset($_SESSION['no-category']);
            }
            ?>
            <br><br>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Food Title"></td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" placeholder="Food Description"></textarea></td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price" placeholder="Food Price"></td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>

                    </tr>

                    <tr>
                        <td>Select Category:</td>
                        <td>
                            <select name="category">
                                <?php
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                            <option value="<?php echo $id ?>"><?php echo $title ?></option>
                                            <?php
                                        }
                                    } else {
                                        echo "<option value='0'>No Category Found</option>";
                                    }

                                ?>

                            </select>
                        </td>

                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>

    </div>
    </body>
</html>


<?php
include ('includes/footer.inc.php');

//check if the button clicked
if (isset($_POST['submit'])) {
    //get the data from the form
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];
    $category = $_POST['category'];
    if ($category == "0") {
        $_SESSION['no-category'] = "<div class='error'>No category found</div>";
        header("location:".SITEURL."admin/addFood.php");
        die();
    }
    if (isset($_POST["featured"])) {
        $featured = $_POST["featured"];
    } else {
        $featured = "No";
    }

    if (isset($_POST["active"])) {
        $active = $_POST["active"];
    } else {
        $active = "No";
    }

    $imageName = $_FILES['image']['name'];
    //upload the image
    if ($imageName != "") {
        //split the extention of the image
        $ext = explode('.',$imageName);
        $ext = end($ext);
        //set the name of the image
        $imageName = "Food_".rand(000,999). '.' .$ext;
        //move the image from source to destimation
        $sourcePath = $_FILES['image']['tmp_name'];
        $destinationPath = "../images/food/".$imageName;

        $upload = move_uploaded_file($sourcePath, $destinationPath);
        if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
            header("location:".SITEURL."admin/addFood.php");
            die();
        }
    }
    //add data to the database
    $sql2 = "INSERT INTO food SET
            title = '$title',
            descripion = '$description',            
            price = '$price',
            image_name = '$imageName',
            category_id = '$category',
            featured = '$featured',
            active = '$active';
            ";

    $res2 = mysqli_query($conn,$sql2);
    if ($res2 == true) {
        $_SESSION['add'] = "<div class='success'>Food added successfully</div>";
        header("location:".SITEURL."admin/manageFood.php");
    } else {
        $_SESSION['add'] = "Failed to add food";
        header("location:".SITEURL."admin/addFood.php");
    }

}

?>

<?php ob_end_flush(); ?>