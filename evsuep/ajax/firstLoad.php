<?php
$count = 0;
$output = '';
include '../db_config/connection.php';

$data=array();
$studentsort = mysqli_query($conn,"SELECT * FROM studentsort ORDER BY id DESC");
if (mysqli_num_rows($studentsort)>0) {
  while ($studentsortRow = mysqli_fetch_assoc($studentsort)) {
    $sid = $studentsortRow['sid'];

    $queryVery = mysqli_query($conn,"SELECT * FROM s_request WHERE sid = '$sid' AND remarks ='Pending' AND remarks1 ='Pending'");
    if (mysqli_num_rows($queryVery)>0) {
      $output .='<tr style="cursor: pointer;" id="studentReq" sudentId ="'.$sid.'">';
      $query = mysqli_query($conn,"SELECT * FROM online_account WHERE sid = '$sid'");
      if (mysqli_num_rows($query)>0) {
        while ($row = mysqli_fetch_assoc($query)) {
          $uid = $row['uid'];
          $lname = $row['lname'];
          $fname = $row['fname'];
          $mi = $row['mi'];
          $email = $row['email'];
          $contactno = $row['contactno'];
          $department = $row['department'];
          $course = $row['course'];
          $data[] = array(
            'sid' => $sid, 
            'fullname' => $fname.' '.$mi.'. '.$lname, 
            'email' => $email, 
            'contactno' => $contactno, 
            'depCourse' => $department.' | '.$course, 
          );

        }
      }else{

      }
     
    }else{
      
    }
  }
  
}else{
  
}
echo json_encode($data)
?>