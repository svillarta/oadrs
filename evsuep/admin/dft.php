<?php

$ftid = $_GET['ftid'];
include 'check_login.php';

include '../db_config/connection.php';

mysql_query("DELETE FROM fee_type WHERE ftid='$ftid'");
header("location:./vft.php");

?>
