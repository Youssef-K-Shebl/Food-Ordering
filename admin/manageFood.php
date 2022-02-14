<?php

include("includes/header.inc.php");

?>

<div class="main-content">
    <div class="wrapper">
        <h2>Manage Food</h2>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>
        <a href="<?php echo SITEURL.'admin/addFood.php' ?>" class="btn-primary">Add Food</a>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>category</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php

            $sql = "SELECT food.*, category.title AS catTitle FROM food
            INNER JOIN category
            ON food.category_id = category.id;
            ";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    $num = 0;
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $categoryId = $row['category_id'];
                            $id = $row['id'];
                            $title = $row['title'];
                            $description = $row['descripion'];
                            $price = $row['price'];
                            $imageName = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            $category = $row['catTitle'];
                            $num++;
                            ?>

                            <tr>
                                <td><?php echo $num; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $description; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $category; ?></td>
                                <td>
                                    <?php
                                        if ($imageName!="") {
                                    ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $imageName?>">
                                    <?php
                                        } else {
                                            echo "<div class='error'>No image added</div>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL.'admin/update_Food.php?id='.$id ?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php echo SITEURL.'admin/deleteFood.php?id='.$id.'&image_name='.$imageName ?>" class="btn-danger">Delete Food</a>
                                </td>
                            </tr>

                            <?php
            }
                    } else {
                    ?>
                        <tr>
                            <td><div class="error">No food added</div></td>
                        </tr>
                    <?php

                    }
                }

            ?>


        </table>
    </div>
</div>

<?php include("includes/footer.inc.php"); ?>
