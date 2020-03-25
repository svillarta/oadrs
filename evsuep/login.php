<?php
session_start();
$my_username = $_POST['username'];
$my_password = $_POST['password'];

include '../db_config/connection.php';

$sql = "SELECT * FROM users where username='$my_username' and password='$my_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
		$user_role = $row['utype'];
    $fullname = $row['username'];
		$uid = $row['uid'];
    $query1 = mysqli_query($conn,"SELECT * FROM user_info WHERE uid = '$uid'");
    while ($row1 = mysqli_fetch_assoc($query1)) {
      $_SESSION['fName'] = $row1['fname'];
      $_SESSION['mi'] = $row1['mi'];
      $_SESSION['lName'] = $row1['lname'];
    }

		if ($user_role == "Administrator") {
			setcookie(loggedin, date("F jS - g:i a"), $seconds);
            
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $my_username;
            $_SESSION['fullname'] = $fullname;
			header("location:../admin/");
		}else {
      // code...
      if($user_role == "Registrar"){
        setcookie(loggedin, date("F jS - g:i a"), $seconds);
              
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = $my_username;
              $_SESSION['fullname'] = $fullname;

        header("location:../registrar/");
    }else {
      // code...
      if($user_role == "Cashier"){
        setcookie(loggedin, date("F jS - g:i a"), $seconds);
              
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = $my_username;
              $_SESSION['fullname'] = $fullname;
        header("location:../cashier/");
      }else{
        if($user_role == "Accounting"){
          setcookie(loggedin, date("F jS - g:i a"), $seconds);
                
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $my_username;
                $_SESSION['fullname'] = $fullname;
          header("location:../accounting/");
        }
      }
    }
  }
}
} else {
   header("location:../?login_err=Account not found in database");
}
$conn->close();
?>
