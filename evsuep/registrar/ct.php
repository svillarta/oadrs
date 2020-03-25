
<?php

$srid = $_GET['srid'];
include 'check_login.php';
include '../db_config/connection.php';
  mysql_query("update s_request set remarks1 = 'Cashier' where srid = '$srid' ")or die(mysql_error());

  echo "<script>
  alert('Submitted to Cashier for Payment!');
  window.location = 'vpsr.php';
  </script>";

?>
