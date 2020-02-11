<?php
session_start();
sleep(2);
include("../db_config/connection.php");
$output = '';
$uid = $_SESSION['uid'];
$code = $_POST['code'];
$email = $_SESSION['email'];
$no = $_SESSION['contact'];

$query = mysqli_query($conn,"SELECT * FROM temppass WHERE uid = '$uid' AND verificationCode ='$code'");
if (mysqli_num_rows($query)>0) {
	while ($row =mysqli_fetch_assoc($query)) {
		$newPass  = $row['newPass'];
	}
	mysqli_query($conn,"UPDATE temppass SET verificationCode ='Verified'");
	$query2 = mysqli_query($conn,"UPDATE users SET password  ='$newPass' WHERE uid ='$uid'");
	if ($query2) {
		$output = 'success';
	}else{
		$output = 'error';
	}
}else{
	$output ='codeNotMatch';
}

echo $output;
?>