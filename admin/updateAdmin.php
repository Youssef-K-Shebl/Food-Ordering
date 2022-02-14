<?php include ('includes/header.inc.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h2>Update Admin</h2>
        <br>

        <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM admin WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);

                    $fullName = $row['full_name'];
                    $username = $row['username'];

                } else {
                    header("location:". SITEURL.'admin/manageAdmin.php');
                }
            }

        ?>


        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $fullName; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $fullName = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        $sql = "UPDATE admin SET
            full_name = '$fullName',
            username = '$username'
            WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
        } else {
            $_SESSION['update'] = "<div class='error'>Failed to update admin</div>";
        }
        header("location:". SITEURL."admin/manageAdmin.php");
    }
?>


<?php include ('includes/footer.inc.php'); ?>


