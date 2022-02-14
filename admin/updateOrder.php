<?php include('includes/header.inc.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Order</h2>
        <br><br>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM orders WHERE id = $id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);

                $id = $row['id'];
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customerName = $row['customer_name'];
                $customerContact = $row['customer_contact'];
                $customerEmail = $row['customer_email'];
                $customerAddress = $row['customer_address'];

            } else {
                header('location:'.SITEURL.'admin/manageOrder.php');
            }
        } else {
            header('location:'.SITEURL.'admin/manageOrder.php');
        }

        ?>


        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Food Name </td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price </td>
                    <td><b><?php echo $price; ?></b></td>
                </tr>
                
                <tr>
                    <td>Qty: </td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>

                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Ordered") {echo "selected";}; ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == "On Delivery") {echo "selected";}; ?> value="On Delivery">On Delivery</option>
                            <option <?php if ($status == "Delivered") {echo "selected";}; ?> value="Delivered">Delivered</option>
                            <option <?php if ($status == "Cancelled") {echo "selected";}; ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td><input type="text" name="customer_name" value="<?php echo $customerName; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customerContact; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td><input type="text" name="customer_email" value="<?php echo $customerEmail; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td><textarea type="text" name="customer_address"><?php echo $customerAddress; ?></textarea></td>
                </tr>

                
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php

        if (isset($_POST['submit'])) {

            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status'];
            $customerName = mysqli_real_escape_string($conn, $_POST['customer_name']);
            $customerContact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
            $customerEmail = mysqli_real_escape_string($conn, $_POST['customer_email']);
            $customerAddress = mysqli_real_escape_string($conn, $_POST['customer_address']);

            $sql2 = "UPDATE orders SET
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customerName',
                    customer_contact = '$customerContact',
                    customer_email = '$customerEmail',
                    customer_address = '$customerAddress'
                    WHERE id = $id;
                   ";

            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
                $_SESSION['update'] = "<div class='success'>Order updated successfully</div>";
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to update order</div>";
            }

            header("location:".SITEURL."admin/manageOrder.php");


        }

        ?>

    </div>
</div>


<?php include('includes/footer.inc.php'); ?>
