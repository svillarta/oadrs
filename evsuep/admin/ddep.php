<?php

$depid = $_GET['depid'];
include 'check_login.php';
include '../db_config/connection.php';
mysql_query("DELETE FROM department WHERE depid='$depid'");
echo "<script>
alert('Successfully Deleted!');
window.location = 'vdep.php';
</script>";
?>
