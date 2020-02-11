<?php
session_start();
include("../db_config/connection.php");

$dep = $_POST['dep'];
$output = '';
if (isset($dep)) {
	$query = "SELECT * FROM course WHERE dep ='$dep'";
	$result = $conn->query($query);
	if ($result->num_rows >0) {
		while ($row = $result->fetch_assoc()) {
			$course = $row['course'];
			$output .='
			<option value="'.$course.'">'.$course.'</option>
			';
		}
	}else{
		$output .='<option value="" disabled selected>Select Department</option>';
	}
}else{
	$output .='<option value="" disabled selected>Select Department</option>';
}
echo $output;
?>