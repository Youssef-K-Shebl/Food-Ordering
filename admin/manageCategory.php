<?php include("includes/header.inc.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Manage Categories</h2>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br><br>
        <a href="<?php echo SITEURL."admin/addCategory.php";?>" class="btn-primary">Add Category</a>
        <br>

        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM category";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    $num = 0;
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $imageName = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            $num++;
                            ?>
                            <tr>
                                <td> <?php echo $num ?> </td>
                                <td> <?php echo $title ?> </td>

                                <td>
                                    <?php
                                        if ($imageName!="") {
                                            ?>
                                            <img src="<?php echo SITEURL ?>images/category/<?php echo $imageName?>">
                                            <?php
                                        } else {
                                            echo "<div class='error'>Image not added</div>";
                                        }
                                    ?>
                                </td>

                                <td> <?php echo $featured ?> </td>
                                <td> <?php echo $active ?> </td>
                                <td>
                                    <a href="<?php echo SITEURL ?>admin/updateCategory.php?id=<?php echo $id?>" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL ?>admin/deleteCategory.php?id=<?php echo $id?>&image_name=<?php echo $imageName?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>

                        <tr>
                            <td><div class="error">No category added</div></td>
                        </tr>

                        <?php
                    }

                }
            ?>



        </table>
    </div>
</div>

<?php include("includes/footer.inc.php"); ?>
