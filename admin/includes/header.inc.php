<?php
    include("../config/conn.php");
    include ("includes/loginCheck.php");
?>
<html lang="en">
<head>
    <title>Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css">
    <meta charset="UTF-8">
</head>
<body>
<!-- Menu Section Starts -->
<div class="menu text-center">
    <div class="wrapper">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="manageAdmin.php">Admin</a></li>
            <li><a href="manageCategory.php">Category</a></li>
            <li><a href="manageFood.php">Food</a></li>
            <li><a href="manageOrder.php">Order</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>
<!-- Menu Section Ends -->