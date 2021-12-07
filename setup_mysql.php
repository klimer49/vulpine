<?php
$hostname = $_POST["mysql_hostname"];
$username = $_POST["mysql_username"];
$password = $_POST["mysql_password"];
$database = $_POST["mysql_database"];
error_reporting(0);
$conn = new mysqli($hostname, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Can't connect to MySQL server.");
}
$main = file_get_contents("config/main.php");
$main = str_replace('$mysql_status = 0;', '$mysql_status = 1;', $main);
file_put_contents("config/main.php", $main);

include "config/main.php";
if ($reg_status == 1 && $mysql_status == 1) {
    $main = file_get_contents("config/main.php");
    $main = str_replace('$server_status = 0;', '$server_status = 1;', $main);
    file_put_contents("config/main.php", $main);
}

file_put_contents("config/connection.php", '
<?php
$hostname = "' . $hostname . '";
$username = "' . $username . '";
$password = "' . $password . '";
$database = "' . $database . '";
?>
');

echo 1;
