<?php
session_start();
include("../db_config/connection.php");
$uid = $_SESSION['uid'];


$fName = $_POST['fName'];
$mName = $_POST['mName'];
$lName = $_POST['lName'];
$username = $_POST['username'];
$contactNo = $_POST['contactNo'];
$email = $_POST['email'];
$department = $_POST['department'];
$course = $_POST['course'];


$query = mysqli_query($conn,"UPDATE online_account SET fname  ='$fName', mi ='$mName', lname ='$lName', email ='$email', contactno ='$contactNo', department ='$department', course ='$course' WHERE uid ='$uid'");
$query1 = mysqli_query($conn,"UPDATE users SET username   ='$username' WHERE uid ='$uid'");

if ($query == true && $query1 == true) {
	$output = 'success';
	$_SESSION['fName'] = $fName;
	$_SESSION['lName'] = $lName;
	$_SESSION['mi'] = $mName;
	$_SESSION['email'] = $email;
	$_SESSION['contact'] = $contactNo;

}else{
	$output = 'error';
}
echo $output;
?>