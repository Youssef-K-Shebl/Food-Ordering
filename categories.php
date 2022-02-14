<?php include ('includes-front/header.php'); ?>



    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                $sql = "SELECT * FROM category WHERE active='Yes';";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $title = $row["title"];
                        $imageName = $row["image_name"];
                        $id = $row["id"];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?id=<?php echo $id; ?>&category=<?php echo $title; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if ($imageName == "") {
                                        echo "<div class='error'>Image not found</div>";
                                    } else {
                                        ?>

                                        <img src="<?php echo SITEURL ?>images/category/<?php echo $imageName?>" alt="<?php echo $title?>" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>


                                <h3 class="float-text text-white"><?php echo $title?></h3>
                            </div>
                        </a>

                        <?php
                    }

                } else {
                    echo "<div class='error'>Category not found</div>";
                }
            ?>



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<?php include ('includes-front/footer.php') ?>