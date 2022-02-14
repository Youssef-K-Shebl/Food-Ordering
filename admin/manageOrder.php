<?php include("includes/header.inc.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Manage Orders</h2>

        <br>
        <br>

        <?php

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order date</th>
                <th>Status</th>
                <th>Customer name</th>
                <th>Customer contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>

            <?php

            $sql = "SELECT * FROM orders ORDER BY id DESC";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);
            $num = 0;
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $date = $row['order_date'];
                    $status = $row['status'];
                    $customerName = $row['customer_name'];
                    $customerContact = $row['customer_contact'];
                    $email = $row['customer_email'];
                    $address = $row['customer_address'];
                    $num++;
                    ?>

                    <tr>
                        <td><?php echo $num; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $date; ?></td>


                        <td>
                            <?php
                                if ($status == "Ordered") {
                                    echo "<label>$status</label>";
                                } elseif ($status == "On Delivery") {
                                    echo "<label style='color: orange'>$status</label>";
                                } elseif ($status == "Delivered") {
                                    echo "<label style='color: green'>$status</label>";
                                } elseif ($status == "Cancelled") {
                                    echo "<label style='color: red'>$status</label>";
                                }
                            ?>
                        </td>


                        <td><?php echo $customerName; ?></td>
                        <td><?php echo $customerContact; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/updateOrder.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                        </td>
                    </tr>

                    <?php

                }


            } else {
                echo "<div class='error'>No orders placed</div>";
            }

            ?>



        </table>
    </div>
</div>

<?php include("includes/footer.inc.php"); ?>
