<?php
session_start();
$my_username = $_POST['username'];
$my_password = $_POST['password'];

include '../db_config/connection.php';

$sql = "SELECT * FROM users where password='$my_password' and utype='Student'";
$result = mysqli_query($conn ,$sql);

if (mysqli_num_rows($result)>0) {

    while($row = mysqli_fetch_assoc($result)) {
		$user_role          = $row['utype'];
		$fullname           = $row['username'];
    $password           = $row['password'];
    $_SESSION['uid']    = $row['uid'];
    $uid                = $row['uid'];
  		if ($user_role === "Student") {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $fullname;            
        $_SESSION['password'] = $password;
  		}
    }
   
   $query = mysqli_query($conn,"SELECT * FROM users WHERE uid='$uid' AND  username='$my_username' AND utype='Student'");
   if (mysqli_num_rows($query)>0) {
       $query1 = mysqli_query($conn,"SELECT * FROM online_account WHERE uid ='$uid'");
         if (mysqli_num_rows($query1)>0) {
             while ($row1 = mysqli_fetch_assoc($query1)) {
               $_SESSION['fName'] =  $row1['fname'];
               $_SESSION['lName'] =  $row1['lname'];
               $_SESSION['mi'] =  $row1['mi'];
               $_SESSION['email'] = $row1['email'];
               $_SESSION['contact'] = $row1['contactno'];
             }
             header("location:../onlinerequest/");
         }else{
            header("location:./../?login_err=Account not found in database");
         }
   }else{
         $query1 = mysqli_query($conn,"SELECT * FROM online_account WHERE uid ='$uid ' AND  sid ='$my_username'");
         if (mysqli_num_rows($query1)>0) {
             while ($row1 = mysqli_fetch_assoc($query1)) {
                $_SESSION['fName'] =  $row1['fname'];
                $_SESSION['lName'] =  $row1['lname'];
                $_SESSION['mi'] =  $row1['mi'];
                $_SESSION['email'] = $row1['email'];
                $_SESSION['contact'] = $row1['contactno'];

             }
             header("location:../onlinerequest/");
         }else{
            header("location:./../?login_err=Account not found in database");
         }
   }
} else {
   header("location:./../?login_err=Account not found in database");
}


$conn->close();
?>
