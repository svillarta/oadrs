<?php

include ('../db_config/connection.php');
session_start();
$output ='';

$rquest = $_POST['request'];
$purpose = $_POST['purpose'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$date = date("Y/m/d");

$sr2 = mysqli_query($conn,"SELECT * from s_request");
while ($row2 = mysqli_fetch_array($sr2)) {
  $srid1 = $row2['srid'];
}
$srid1 = $srid1 + 1;

$ui = mysqli_query($conn,"SELECT * FROM users where username='$username' and password='$password'");
if(mysqli_num_rows($ui)>0){
  while($ui_row = mysqli_fetch_array($ui)){
    $uid = $ui_row['uid'];
  }
  $ui1 = mysqli_query($conn,"SELECT * from online_account where uid='$uid' ");
  if(mysqli_num_rows($ui1) > 0){
    while ($ui_row1 = mysqli_fetch_array($ui1)) {
     $sid = $ui_row1['sid'];
    }
    $studentsort = mysqli_query($conn,"SELECT * FROM studentsort WHERE sid = '$sid'");
    if (mysqli_num_rows($studentsort)>0) {
      # code...
    }else{
      mysqli_query($conn,"INSERT INTO studentsort(id,sid) VALUES(null,$sid)");
    }
    $savereq = mysqli_query($conn,"INSERT into s_request(srid,sdate,pdate,sid,srequest,purpose,remarks,remarks1) values($srid1,'$date','Pending','$sid','$rquest','$purpose','Pending','Pending')");
    //check s_request
    //save notifcation
    $savenot = mysqli_query($conn,"INSERT into notification (nid,date1,srid,remarks) values (null,'$date','$srid1','unseen')");

    if ($savereq == true && $savenot ==true) {
      $output = 'success';    
    }else{
       $output = 'error'; 
    }
  }else{
    $output = 'error1';
  }
  
}else{
  $output = 'error2';
}

echo $output;
?>