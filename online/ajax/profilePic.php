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


$output = '';
$query = mysqli_query($conn,"SELECT * FROM profilepic WHERE uid ='$uid'");
if (mysqli_num_rows($query)>0) {
	$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
	$update = mysqli_query($conn,"UPDATE profilepic SET image='$file' WHERE uid ='$uid'");
	if ($update) {
		$query = mysqli_query($conn,"UPDATE online_account SET fname  ='$fName', mi ='$mName', lname ='$lName', email ='$email', contactno ='$contactNo', department ='$department', course ='$course' WHERE uid ='$uid'");
		$query1 = mysqli_query($conn,"UPDATE users SET username   ='$username' WHERE uid ='$uid'");
		$output = 'inserted';
		$_SESSION['fName'] = $fName;
		$_SESSION['lName'] = $lName;
		$_SESSION['mi'] = $mName;
		$_SESSION['email'] = $email;
		$_SESSION['contact'] = $contactNo;
	}else{
		$output = 'error';
	}

}else{
	$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  	$query = "INSERT INTO profilepic(id,uid,image) VALUES (null,'$uid','$file')";
  	if(mysqli_query($conn, $query)){
  		$query = mysqli_query($conn,"UPDATE online_account SET fname  ='$fName', mi ='$mName', lname ='$lName', email ='$email', contactno ='$contactNo', department ='$department', course ='$course' WHERE uid ='$uid'");
		$query1 = mysqli_query($conn,"UPDATE users SET username   ='$username' WHERE uid ='$uid'");
   		$output = 'inserted';
   		$_SESSION['fName'] = $fName;
		$_SESSION['lName'] = $lName;
		$_SESSION['mi'] = $mName;
		$_SESSION['email'] = $email;
		$_SESSION['contact'] = $contactNo;
  	}else{
  		$output = 'error';
  	}
}

echo $output;
?>