
<?php
$srid = $_GET['srid'];
include 'check_login.php';
include '../db_config/connection.php';
  mysql_query("update s_request set remarks1 = 'done' where srid = '$srid' ")or die(mysql_error());
header("location:releasing.php");
?>
