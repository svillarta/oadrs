<?php
session_start();
include("../db_config/connection.php");

$username = $_SESSION['username'];
$password = $_POST['password'];
$output = '';
$query = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password'");
if (mysqli_num_rows($query)>0) {
	$output = 'success';
}else{
	$output = 'error';

}
echo $output;
?>