<?php
include dirname(__FILE__)."/../config/connection.php";
$link = mysqli_connect($hostname, $username, $password, $database) 
    or die("MySQL Connection Error");
?>