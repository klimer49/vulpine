<?php
include "../libs/main.php";
include "../config/register.php";

$ip = main::getIP();
$udid = htmlspecialchars($_POST["udid"]);
$userName = htmlspecialchars($_POST["userName"]);
$password = htmlspecialchars($_POST["password"]);
$sql = "SELECT * FROM accounts WHERE username = '$userName' AND isActivated = 1"; 
$result = mysqli_query($link, $sql);
$row = $result->fetch_assoc();
if(!$row["id"]) exit("-1");
$id = $row["id"];
if(!password_verify($password, $row["password"])) exit("-1");


$sql = "SELECT * FROM users WHERE accID = $id"; 
$result = mysqli_query($link, $sql);
$row = $result->fetch_assoc();
if($result->num_rows == 0) {
    $sql = "INSERT INTO users (accID, userName, isRegistered) VALUES ($id, '$userName', 1)";
    if(!mysqli_query($link, $sql)) exit("-1");
    $userID = mysqli_insert_id($link);
} else {
    $userID = $row["id"];
}
exit("$id,$userID");


?>