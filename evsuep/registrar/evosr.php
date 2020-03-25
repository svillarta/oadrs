<?php
include 'check_login.php';

	$get_id = $_GET['nid'];
	$srid = $_GET['srid'];

	include '../db_config/connection.php';

$sql = "DELETE FROM notification WHERE nid ='$get_id'";
$sql1 = "UPDATE s_request SET remarks ='Confirmed' WHERE srid ='$srid' ";

	if ($conn->query($sql) === TRUE) {

		include 'check_login.php';

			$srid = $_GET['srid'];

			include '../db_config/connection.php';

		$sql1 = "UPDATE s_request SET remarks ='Confirmed' WHERE srid ='$srid' ";

			if ($conn->query($sql1) === TRUE) {
			    header("location:vosr.php");
			} else {
			$error = $conn->error;
			   header("location:./?err2=$error");
			}


	} else {
	$error = $conn->error;
	   header("location:./?err2=$error");
	}


?>
