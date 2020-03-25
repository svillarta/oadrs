<?php
include '../db_config/connection.php';
$sid = $_POST['sid'];
$now = date("Y/m/d");
$query = mysqli_query($conn,"SELECT * FROM s_request WHERE sid = '$sid' AND remarks1='Paid'");
if (mysqli_num_rows($query)>0) {
	while ($row = mysqli_fetch_assoc($query)) {
		$srid = $row['srid'];
		$queryR = mysqli_query($conn,"UPDATE s_request SET remarks1 ='Released', pdate ='$now' WHERE srid = '$srid'");
	}
	$output = 'success';
}else{
		$output = 'error';
}
echo $output;
?>

