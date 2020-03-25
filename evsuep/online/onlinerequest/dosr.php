<?php
$srid = $_GET['srid'];
include 'check_login.php';

include '../db_config/connection.php';

mysql_query("DELETE FROM s_request WHERE srid='$srid'");

header("location:./vreq.php");

?>
