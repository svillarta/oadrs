<?php
session_start();
include("../db_config/connection.php");


$uid         = $_POST['uid'];
$lName       = $_POST['lName'];
$fName       = $_POST['fName'];
$mi          = $_POST['mi'];
$email       = $_POST['email'];
$contactno   = $_POST['contactno'];
$department  = $_POST['department'];
$course      = $_POST['course'];

$queryVerification = "SELECT * FROM verification WHERE uid ='$uid'";
$resultVerification = $conn->query($queryVerification);
if ($resultVerification->num_rows >0) {
	while ($rowVer = $resultVerification->fetch_assoc()) {
	    $emailCode  = $rowVer['emailCode'];
	    $cpNoCode   = $rowVer['cpNoCode'];
	}
  	if ($emailCode =='Verified') {
    	$emailRev = mysqli_query($conn,"SELECT * FROM online_account WHERE email ='$email'");
    	if (mysqli_num_rows($emailRev)>0) {
      		# code...
    	}else{
      		mysqli_query($conn,"UPDATE verification SET emailCode='$randstr'");
    	}
  	}else{

  	}
  	if ($cpNoCode =='Verified') {
     	$noRev = mysqli_query($conn,"SELECT * FROM online_account WHERE contactno ='$contactno'");
     	if (mysqli_num_rows($emailRev)>0) {
      		# code...
    	}else{
      		mysqli_query($conn,"UPDATE verification SET cpNoCode ='$randstr1'");
    	}
  	}else{
    
  	}
 
}else{
  	mysqli_query($conn,"INSERT INTO verification(id,uid,emailCode,cpNoCode) VALUES(null,'$uid','$randstr','$randstr1')");
}



$query =mysqli_query($conn,"UPDATE online_account SET lname = '$lName', fname = '$fName', mi ='$mi', email ='$email', contactno ='$contactno', department ='$department', course='$course' WHERE uid = '$uid' ");


?>