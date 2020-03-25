<?php

$cid = $_GET['cid'];
include 'check_login.php';
include '../db_config/connection.php';
mysql_query("DELETE FROM course WHERE cid='$cid'");
echo "<script>
alert('Successfully Deleted!');
window.location = 'vc.php';
</script>";
?>
