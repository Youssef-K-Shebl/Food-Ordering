<?php
include ('includes-front/header.php');

if (isset($_GET["id"]) && isset($_GET["category"])) {
    $id = $_GET["id"];
    $category = $_GET["category"];

} else {
    header("location:".SITEURL."categories.php");
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <span href="#" class="text-white">"<?php echo $category?>"</span></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql = "SELECT *FROM food WHERE category_id = $id;";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row["id"];
                    $title = $row["title"];
                    $price = $row["price"];
                    $description = $row["descripion"];
                    $imageName = $row["image_name"];

                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php

                            if ($imageName == "") {
                                echo "<div class='error'>Image not available</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $imageName?>" alt="<?php echo $title?>" class="img-responsive img-curve">
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
                echo "<div class='error'>Food not found for this category</div>";
            }
            ?>










            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include ('includes-front/footer.php'); ?>