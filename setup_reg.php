<?php
use PHPMailer\PHPMailer\PHPMailer;
$captcha = $_POST["reg_captcha"];
$captcha_secret = $_POST["reg_captcha_secret"];
$captcha_public = $_POST["reg_captcha_public"];
if ($captcha == "true") {
    if (!$captcha_public || $captcha_secret) {
        exit("-1");
    }
}
error_reporting(0);
$smtp = $_POST["reg_email"];
$smtp_server = $_POST["reg_email_smtp"];
$smtp_email = $_POST["reg_email_email"];
$smtp_password = $_POST["reg_email_password"];
$smtp_port = $_POST["reg_email_port"];
$smtp_type = $_POST["reg_email_type"];
if ($smtp == "true") {
    if (!$smtp_server || !$smtp_email || !$smtp_password || !$smtp_port || !$smtp_port) exit("-1");
}

if ($smtp == "true") {
    $mail = new PHPMailer(true);
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_email;
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = $smtp_type;
    $mail->Host = $smtp_server;
    $mail->Port = $smtp_port;

    // This function returns TRUE if authentication
    // was successful, or throws an exception otherwise
    try {
        $validCredentials = $mail->SmtpConnect();
    } catch (Exception $error) {
        exit("Cannot connect to SMTP server. ");
    }

}

if (!$smtp_port) $smtp_port = 69;

file_put_contents("config/register.php", '
<?php
$captcha = ' . $captcha . ';
$captcha_secret = "' . $captcha_secret . '";
$captcha_public = "' . $captcha_public . '";

$smtp = ' . $smtp . ';
$smtp_email = "' . $smtp_email . '";
$smtp_password = "' . $smtp_password . '";
$smtp_server = "' . $smtp_server . '";
$smtp_port = ' . $smtp_port . ';
$smtp_type = "' . $smtp_type . '";
?>
');
$main = file_get_contents("config/main.php");
$main = str_replace('$reg_status = 0;', '$reg_status = 1;', $main);
file_put_contents("config/main.php", $main);
include "config/main.php";
if ($reg_status == 1 && $mysql_status == 1) {
    $main = file_get_contents("config/main.php");
    $main = str_replace('$server_status = 0;', '$server_status = 1;', $main);
    file_put_contents("config/main.php", $main);
}
echo 1;
?>
