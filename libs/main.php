<?php
include dirname(__FILE__) . "/../libs/connection.php";

class main
{
    public function getIP(): null | string
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }
        return null;
    }

    public function generate($how_long): string
    {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $how_long; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

    public function isAdmin($userID): bool
    {
        $link = $GLOBALS["link"];
        $sql = "SELECT * FROM accounts WHERE id = $userID";
        $result = mysqli_query($link, $sql);
        $row = $result->fetch_assoc();
        if ($row["isAdmin"] == 1) {
            return true;
        } else {
            return false;
        }
    }

    // Pelfox patch start
    /**
     * @param String $output_string
     * @return bool
     */
    public static function isComposerInstalled(String $output_string): bool
    {
        return str_starts_with($output_string, "Composer");
    }
    // Pelfox patch end
}
