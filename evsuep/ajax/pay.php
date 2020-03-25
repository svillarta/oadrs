<?php
include ('../db_config/connection.php');
$sid = $_POST['sid'];
$sdate = date("y/m/d");
$query = mysqli_query($conn,"SELECT * FROM s_payment WHERE sid = '$sid'");
if (mysqli_num_rows($query)>0) {
	while ($row = mysqli_fetch_assoc($query)) {
		$spid = $row['spid'];
		$srid = $row['srid'];
		$paid = mysqli_query($conn,"UPDATE s_payment SET remarks ='Paid', sdate ='$sdate' WHERE spid = '$spid'");
		mysqli_query($conn,"UPDATE s_request SET remarks1='Paid',pdate='$sdate' WHERE srid ='$srid'");
		
	}
	
}
if ($paid == true) {
	$output ='success';
}else{
	$output = 'error';
}
echo $output;
?>