<?php
$srid = $_GET['srid'];
include 'check_login.php';

include '../db_config/connection.php';

mysql_query("DELETE FROM s_request WHERE srid='$srid'");
mysql_query("DELETE FROM notification WHERE srid='$srid'");

header("location:./vreq.php");

?>
