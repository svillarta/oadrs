<?php

session_start();
$current_user = $_SESSION['username'];

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
 $myusername = $_SESSION['username'];
 $username = $_SESSION['username'];
 $password = $_SESSION['password'];

 include ('../db_config/connection.php');

	$sql = "SELECT * FROM users where username='$myusername' and password='$password'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

	    while($row = $result->fetch_assoc()) {
	        $current_user_id = $row['username'];
	        $user_id = $row['uid'];
	        $dep = $row['utype'];
	    }

	} else {
	       header("../?login_err=You must be Student");
	}


} else {
    header("location:../?login_err=You must login first");
}
?>
