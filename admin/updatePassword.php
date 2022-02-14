<?php
    include("includes/header.inc.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h2>Change Password</h2>
        <br>

        <?php
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            $id = $_GET['id'];
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current password:</td>
                    <td>
                        <input name="currentPassword" type="password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New password:</td>
                    <td>
                        <input type="password" name="newPassword" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirmPassword" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id ?>" >
                        <input class="btn-secondary" type="submit" value="Change Password" name="submit">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $currentPassword = mysqli_real_escape_string($conn, md5($_POST['currentPassword']));
        $newPassword = mysqli_real_escape_string($conn, md5($_POST['newPassword']));
        $confirmPassword = mysqli_real_escape_string($conn, md5($_POST['confirmPassword']));

        $sql = "SELECT * FROM admin WHERE id=$id AND password='$currentPassword'";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                if ($newPassword == $confirmPassword) {

                    $sql = "Update admin SET password='$newPassword' WHERE id=$id";
                    $res = mysqli_query($conn,$sql);

                    if($res == true) {
                        $_SESSION['updatePassword'] = "<div class='success'>Password updated successfully</div>";
                        header("location:".SITEURL."admin/manageAdmin.php");
                    } else {
                        $_SESSION['updatePassword'] = "<div class='error'>Failed to change password</div>";
                        header("location:".SITEURL."admin/manageAdmin.php");
                    }

                } else {
                    $_SESSION['error'] = "<div class='error'>Passwords don't match</div>";
                    header("location:".SITEURL."admin/updatePassword.php?id=".$id);
                }

            } else {
                $_SESSION['updatePassword'] = "<div class='error'>User not found</div>";
                header("location:".SITEURL."admin/manageAdmin.php");
            }


        }



    }

?>


<?php
    include("includes/footer.inc.php");
?>
