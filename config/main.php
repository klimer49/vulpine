<?php
session_start();
$session_account_id = $_SESSION["accid"];
if (!$session_account_id) $session_account_id = 0;
$server_status = 0;
$mysql_status = 0;
$reg_status = 0;
