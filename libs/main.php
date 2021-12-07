<?php
include dirname(__FILE__)."/../libs/connection.php";
class main {
    public function getIP() {
        if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if(isset($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
    public function generate($how_long) {
        $length = $how_long;
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
    public function isAdmin($userID) {
        $link = $GLOBALS["link"];
        $sql = "SELECT * FROM accounts WHERE id = $userID"; 
        $result = mysqli_query($link, $sql);
        $row = $result->fetch_assoc();
        if($row["isAdmin"] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
?>