<?php
$srid = $_GET['srid'];
include '../db_config/connection.php';

$sql = "SELECT * FROM s_payment where srid='$srid'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
  while($row = $result->fetch_assoc()) {
  $spid = $row['spid'];
  mysql_query("update s_payment set remarks = 'paid' where spid = '$spid' ")or die(mysql_error());
  }
  mysql_query("update s_request set remarks1 = 'Releasing' where srid = '$srid' ")or die(mysql_error());
  echo "<script>
  alert('Fully Paid!');
  window.location = 'request.php';
  </script>";
}
?>
