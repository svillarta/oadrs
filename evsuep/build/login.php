<?php
session_start();
$my_username = $_POST['username'];
$my_password = $_POST['password'];

include ('../db_config/connection.php');

$sql = "SELECT * FROM users where username='$my_username' and password='$my_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
    $user_role = $row['utype'];
    $fullname = $row['username'];
    $uid = $row['uid'];
    $_SESSION['uid'] = $uid;
    $query1 = mysqli_query($conn,"SELECT * FROM user_info WHERE uid = '$uid'");
    while ($row1 = mysqli_fetch_assoc($query1)) {
      $_SESSION['fName'] = $row1['fname'];
      $_SESSION['mi'] = $row1['mi'];
      $_SESSION['lName'] = $row1['lname'];

    }
    if (mysqli_num_rows($query1)>0) {
      if ($user_role == "Administrator") {
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = $my_username;
              $_SESSION['fullname'] = $fullname;
              ?>
              <script type="text/javascript">window.location.href = "../admin/";</script>
              <?php
        }else {
        // code...
          if($user_role == "Registrar"){
           
                  
                  $_SESSION['loggedin'] = true;
                  $_SESSION['username'] = $my_username;
                  $_SESSION['fullname'] = $fullname;
                  ?>
                  <script type="text/javascript">window.location.href = "../registrar/";</script>
                  <?php
            
          }else {
        // code...
          if($user_role == "Cashier"){
            
                  
                  $_SESSION['loggedin'] = true;
                  $_SESSION['username'] = $my_username;
                  $_SESSION['fullname'] = $fullname;
                  ?>
                  <script type="text/javascript">window.location.href = "../cashier/";</script>
                  <?php
            
          }else{
            if($user_role == "Accounting"){
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $my_username;
                    $_SESSION['fullname'] = $fullname;
                  ?>
                  <script type="text/javascript">window.location.href = "../accounting/";</script>
                  <?php
            }
          }
        }
      }
    }else{
      ?>
      <script type="text/javascript">window.location.href = "../?login_err=Account not found in database";</script>
      <?php
    }
  }
} else {
  ?>
  <script type="text/javascript">window.location.href = "../?login_err=Account not found in database";</script>
  <?php
   
}
$conn->close();
?>
