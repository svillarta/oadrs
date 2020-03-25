<?php

$uid = $_GET['uid'];
include 'check_login.php';

include '../db_config/connection.php';

mysql_query("DELETE FROM users WHERE uid='$uid'");

mysql_query("DELETE FROM user_info WHERE uid='$uid'");echo "<script>
alert('Successfully Deleted!');
window.location = 'view_account.php';
</script>";

?>
