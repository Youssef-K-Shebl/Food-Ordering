<?php include ('includes-front/header.php'); ?>

<?php

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "SELECT * FROM food WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $imageName = $row['image_name'];

        } else {
            header("location:".SITEURL);
        }
    } else {
        header("location:".SITEURL."index.php");
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        if ($imageName == "") {
                            echo "<div class='error'>Image not available</div>";
                        } else {
                        ?>

                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $imageName?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">

                        <?php
                        }
                        ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
<!--                        <input type="hidden" name="food" value="--><?php //echo $title; ?><!--">-->
                        <p class="food-price">$<?php echo $price; ?></p>
<!--                        <input type="hidden" name="price" value="--><?php //echo $price; ?><!--">-->
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

            if (isset($_POST['submit'])) {
                $food = $title;
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $orderDate = date("Y-m-d h:i:s");
                $status = "Ordered";
                $customerName = $_POST['full-name'];
                $customerContact = $_POST['contact'];
                $customerEmail = $_POST['email'];
                $customerAddress = $_POST['address'];
                //save the data to the database
                $sql2 = "INSERT INTO orders SET 
                            food = '$food',
                            price = $price,
                            qty = $qty,
                            total = $total,
                            order_date = '$orderDate',
                            status = '$status',
                            customer_name = '$customerName',
                            customer_contact = '$customerContact',
                            customer_email = '$customerEmail',
                            customer_address = '$customerAddress';
                    ";


                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    //query executed and order saved
                    $_SESSION['order'] = "<div class='success text-center'>Food ordered successfully</div>";
                } else {
                    //failed to save order
                    $_SESSION['order'] = "<div class='error text-center'>failed to order food</div>";
                }
                header("location:".SITEURL);

            }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include ('includes-front/footer.php'); ?>