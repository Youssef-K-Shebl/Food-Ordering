<?php
session_start();
const SITEURL = 'alexrestaurant.epizy.com';
const LOCALHOST = 'sql207.epizy.com';
const USERNAME = 'epiz_30986374';
const PASSWORD = 'RVvx6rlqoB4q';
const DBNAME = 'epiz_30986374_FoodOrdering	';
$conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD, DBNAME) or die(mysqli_error());