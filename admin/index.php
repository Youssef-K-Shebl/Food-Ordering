<?php include ("includes/header.inc.php") ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h2>Dashboard</h2>
            <br>
            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            echo "<div class='success text-center'>Hello ".$_SESSION["user"]."</div>";
            ?>
            <br>

            <div class="categories">
                <div class="col-4 text-center">

                    <?php
                        $sql = "SELECT COUNT(id) AS num FROM category;";
                        $res = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_assoc($res);
                        $num = $data['num'];
                    ?>

                    <h1><?php echo $num; ?></h1>
                    <br>
                    Categories
                </div>

                <div class="col-4 text-center">

                    <?php
                        $sql = "SELECT COUNT(id) AS num FROM food;";
                        $res = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_assoc($res);
                        $num = $data['num'];
                    ?>

                    <h1><?php echo $num; ?></h1>
                    <br>
                    Foods
                </div>

                <div class="col-4 text-center">

                    <?php
                        $sql = "SELECT COUNT(id) AS num FROM orders;";
                        $res = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_assoc($res);
                        $num = $data['num'];
                    ?>

                    <h1><?php echo $num; ?></h1>
                    <br>
                   Total orders
                </div>

                <div class="col-4 text-center">

                    <?php
                        $sql = "SELECT SUM(total) AS total FROM orders WHERE status = 'Delivered';";
                        $res = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_assoc($res);
                        $total = $data['total'];
                        $total = round($total);
                    ?>

                    <h1>$<?php echo $total; ?></h1>
                    <br>
                    Revenue generated
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content Section Ends -->
<?php include ("includes/footer.inc.php") ?>

