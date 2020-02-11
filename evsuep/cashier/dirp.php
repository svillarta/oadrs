<?php

$spid = $_GET['spid'];
$srid = $_GET['srid'];
include 'check_login.php';

include '../db_config/connection.php';

mysql_query("DELETE FROM s_payment WHERE spid='$spid'");

header("location:./vspt.php?srid=$srid");

?>
