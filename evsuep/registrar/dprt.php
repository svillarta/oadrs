<?php

$spid = $_GET['spid'];
$srid = $_GET['srid'];
$sr = $_GET['sr'];
$p = $_GET['p'];
include 'check_login.php';

include '../db_config/connection.php';

mysql_query("DELETE FROM s_payment WHERE spid='$spid'");

header("location:cspr.php?srid=$srid&sr=$sr&p=$p");

?>
