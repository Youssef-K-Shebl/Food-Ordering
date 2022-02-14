<?php
    include ("includes/header.inc.php");
?>


<div class="main-content">
    <div class="wrapper">
        <h2>Add Category</h2>
        <br>
        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
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

        <?php
            if (isset($_POST["submit"])) {
                $title = mysqli_real_escape_string($conn, $_POST["title"]);

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

                if (isset($_FILES['image']['name'])) {
                    $imageName = $_FILES['image']['name'];

                    if ($imageName != "") {

                        $ext = end(explode('.',$imageName));

                        $imageName = "Food_Category_".rand(000,999).'.'.$ext;

                        $sourcePath = $_FILES['image']['tmp_name'];
                        $destinationPath = "../images/category/".$imageName;

                        $upload = move_uploaded_file($sourcePath,$destinationPath);

                        if ($upload == false) {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header("location:".SITEURL."admin/addCategory.php");
                            die();
                        }
                    }

                } else {
                    $imageName = "";
                }

                $sql = "INSERT INTO category SET
                    title = '$title',
                    image_name = '$imageName',
                    featured = '$featured',
                    active = '$active'
                ";
                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $_SESSION["add"] = "<div class='success'>Category added successfully</div>";
                    header("location:".SITEURL."admin/manageCategory.php");
                } else {
                    $_SESSION["add"] = "<div class='error'>Failed to add category</div>";
                    header("location:".SITEURL."admin/addCategory.php");
                }
            }
        ?>

    </div>
</div>





<?php
    include ("includes/footer.inc.php");
?>
