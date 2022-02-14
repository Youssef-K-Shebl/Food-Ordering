<?php include ('includes-front/header.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

<?php
    if (isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3;";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $title = $row["title"];
                        $imageName = $row["image_name"];
                        $id =$row["id"];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?id=<?php echo $id; ?>&category=<?php echo $title; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if ($imageName == "") {
                                        echo "<div class='error'>Image not available</div>";
                                    } else {
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $imageName; ?>" alt="<?php echo $title ?>" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>

                                <h3 class="float-text text-white"><?php echo $title ?></h3>
                            </div>
                        </a>

                        <?php
                    }

                } else {
                    echo "<div class='error'>Category not added</div>";
                }

            ?>



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql2 = "SELECT * FROM food WHERE featured='Yes' AND active='Yes' LIMIT 6;";
                $res2 = mysqli_query($conn,$sql2);
                $count2 = mysqli_num_rows($res2);
                if ($count2 > 0) {
                    //image, title, price, description
                    while ($row = mysqli_fetch_assoc($res2)) {
                        $id = $row["id"];
                        $imageName = $row["image_name"];
                        $title = $row["title"];
                        $price = $row["price"];
                        $description = $row["descripion"];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php

                                if ($imageName == "") {
                                    echo "<div class='error'>Image not found</div>";
                                } else {
                                    ?>

                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $imageName; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">

                                    <?php
                                }

                                ?>

                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                } else {
                    echo "<div class='error'>Food not found</div>";
                }
            ?>





            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include ('includes-front/footer.php'); ?>