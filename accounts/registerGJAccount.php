<?php
include "../libs/main.php";
include "../config/register.php";
// Pelfox patch start - use composer instead of simple files for SMTP.
//require '../php-mailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
// Pelfox patch end
$user = htmlspecialchars($_POST["userName"]);
$pass = htmlspecialchars($_POST["password"]);
$email = htmlspecialchars($_POST["email"]);
if (!$user || !$pass || !filter_var($email, FILTER_VALIDATE_EMAIL)) exit("-1");
$ip = main::getIP();
$time = time();
$sql = "SELECT * FROM accounts WHERE username = '$user'";
$result = mysqli_query($link, $sql);
$row = $result->fetch_assoc();
if ($row["id"]) exit("-2");
$sql = "SELECT * FROM accounts WHERE ip = '$ip' AND registerDate + 3600 > $time";
$result = mysqli_query($link, $sql);
if ($result->num_rows > 2) exit("-1");
if (file_get_contents("https://api.foxodever.com/pass/$password") == "bad") exit("-5");
$pass = password_hash($pass, PASSWORD_DEFAULT);
if ($smtp == true) {
    $sql = "SELECT * FROM accounts WHERE email = '$email'";
    $result = mysqli_query($link, $sql);
    $row = $result->fetch_assoc();
    if ($row["id"]) exit("-3");
    if (file_get_contents("https://api.foxodever.com/tpmail/" . explode("@", $email)[1]) == "bad") exit("-6");
    $mail = new PHPMailer();
    $mail->CharSet = 'utf-8';
    $mail->isSMTP();
    $mail->Host = $smtp_server;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_email;
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = $smtp_type;
    $mail->Port = $smtp_port;
    $mail->setFrom($smtp_email);
    $mail->addAddress($email);
    $mail->isHTML(true);
    $pth = str_replace("/registerGJAccount.php", "", $_SERVER['PHP_SELF']);
    $token = main::generate(32);
    $mail->Subject = 'Your account registration on Vulpine GDPS';
    $mail->Body = "<h1>Greetings, $userName</h1>
    <p>You have successfully registered in the Vulpine GDPS Core.</p>
    <p>To complete your registration, please verify through the link:</p>
    <a href=\"http://" . $_SERVER["HTTP_HOST"] . "$pth/activate.php?token=$token\">http://" . $_SERVER["HTTP_HOST"] . "$pth/activate.php?token=$token</a>";
    if ($mail->send()) {
        $sql = "INSERT INTO accounts (username, password, email, registerDate, ip, registerToken) VALUES ('$user', '$pass', '$email', $time, '$ip', '$token')";
        $result = mysqli_query($link, $sql);
        if (!$result) exit("-1");
        echo "1";
    } else {
        echo "-1";
    }
} else {
    $time = time();
    $sql = "INSERT INTO accounts (username, password, email, isActivated, registerDate, registerToken, ip) VALUES ('$user', '$pass', '$email', 1, $time, '" . main::generate(32) . "', '$ip')";
    $result = mysqli_query($link, $sql);
    if (!$result) exit("-1");
    echo 1;
}
