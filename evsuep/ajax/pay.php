<?php
include ('../db_config/connection.php');
$sid = $_POST['sid'];
$query = mysqli_query($conn,"SELECT * FROM s_payment WHERE sid = '$sid'");
if (mysqli_num_rows($query)>0) {
	while ($row = mysqli_fetch_assoc($query)) {
		$spid = $row['spid'];
		$paid = mysqli_query($conn,"UPDATE s_payment SET remarks ='Paid' WHERE spid = '$spid'");
	}
	
}
if ($paid == true) {
	$output ='success';
}else{
	$output = 'error';
}
echo $output;
?>