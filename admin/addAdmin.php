<?php
    include ("includes/header.inc.php");
?>


    <div class="main-content">
        <div class="wrapper">
            <h2>Add Admin</h2>

            <?php
                if (isset($_SESSION['add'])) {

                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>


            <br>
            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter Your name"></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" placeholder="Enter Your username"></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" placeholder="Enter Your password"></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php
    include ("includes/footer.inc.php");
?>

<?php

if (isset($_POST['submit'])) {
    //Get the data from the form
    $fullName = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    //SQL query to save the data into the database
    $sql = "INSERT INTO admin SET
            full_name = '$fullName',
            username = '$username',
            password = '$password'
";

    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    if ($res == true) {
        $_SESSION['add'] = "<div class='success'>Admin added Successfully</div>";
        header("location:" . SITEURL . 'admin/manageAdmin.php');
    } else {
        $_SESSION['add'] = "<div class='success'>Failed to add admin</div>";
        header("location:" . SITEURL . 'admin/addAdmin.php');
    }

}

