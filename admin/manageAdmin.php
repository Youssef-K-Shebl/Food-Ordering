<?php
include ("includes/header.inc.php")
?>

<!-- Main Content Section Starts -->

<div class="main-content">
    <div class="wrapper">
        <h2>Manage Admins</h2>
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

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if (isset($_SESSION['updatePassword'])) {
                echo $_SESSION['updatePassword'];
                unset($_SESSION['updatePassword']);
            }
        ?>
        <br><br>
        <a href="addAdmin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM admin";
                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    $num = 0;
                    if ($count > 0) {
                        while($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                            $num++;
            ?>

                <tr>
                    <td><?php echo $num?> </td>
                    <td><?php echo $full_name?></td>
                    <td><?php echo $username?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>admin/updatePassword.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                        <a href="<?php echo SITEURL; ?>admin/updateAdmin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                        <a href="<?php echo SITEURL; ?>admin/deleteAdmin.php?id=<?php echo $id; ?>&username=<?php echo $username?>" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>

            <?php

                        }


                    }
                }
            ?>

        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php
    include ("includes/footer.inc.php")
?>

