<?php
$my_username = $_POST['username'];
$my_password = $_POST['password'];

include '../db_config/connection.php';

$sql = "SELECT * FROM users where username='$my_username' and password='$my_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
		$user_role = $row['utype'];
		$fullname = $row['username'];
    $password = $row['password'];
		if ($user_role === "Student") {
			setcookie(loggedin, date("F jS - g:i a"), $seconds);
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $my_username;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['password'] = $password;
			header("location:../onlinerequest/");
		}
    {

    }
}
} else {
   header("location:../?login_err=Account not found in database");
}
$conn->close();
?>
