<?php
session_start();
const SITEURL = 'https://localhost/foodOrderingProject/';
const LOCALHOST = 'localhost';
const USERNAME = 'root';
const PASSWORD = '';
const DBNAME = 'foodorderingproject';
$conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD, DBNAME) or die(mysqli_error());