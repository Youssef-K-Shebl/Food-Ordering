<?php
include("../config/conn.php");
session_unset();
session_destroy();

header("location:".SITEURL."admin/login.php");