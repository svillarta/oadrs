<?php
$count = 0;
$count1 = 0;
include '../db_config/connection.php';

//sample output of monht 2020-03
$monthlyReport = $_POST['month'];

$data=array();
$getStudent = mysqli_query($conn,"SELECT * FROM online_account");
if (mysqli_num_rows($getStudent)>0) {
  while ($row = mysqli_fetch_array($getStudent)) {
    $sid = $row['sid'];
    $getFileReleases =mysqli_query($conn,"SELECT * FROM  s_request WHERE sid = '$sid' AND remarks ='Approved' AND remarks1 ='Released'");
    if (mysqli_num_rows($getFileReleases)>0) {
      $fileRequested ='';
      while ( $row1 = mysqli_fetch_array($getFileReleases)) {
        $srid     = $row1['srid'];
        $srequest = $row1['srequest'];
        $pdate    = $row1['pdate'];
        $paidDate = explode('/', $pdate);
        $newDate = $paidDate[0].'-'.$paidDate[1];
        if ($monthlyReport == $newDate) {
          $getPaidReq = mysqli_query($conn,"SELECT * FROM  s_payment WHERE srid = '$srid' AND remarks ='Paid'");
          if (mysqli_num_rows($getPaidReq)>0) {
            while ( $row2 = mysqli_fetch_array($getPaidReq)) {
              $amount   = $row2['samount'];
              if ($srequest == 'TRANSCRIPT OF RECORD') {
                $purpose  = $row1['purpose'];
                $pages    = $row2['pages'];
                $amount   = $row2['samount'];
                $fileRequested .= 'File :'. $srequest.' | Page(s) : '.$pages.' | Purpose : '.$purpose.' | Paid Amount :'.$amount."\n <br>";
              }else{
                $fileRequested .= 'File :'. $srequest.' | Paid Amount :'.$amount."\n <br>";
              }
            }
          }
        }else{

        }
      }
    }
    if ($fileRequested != "") {
      $data[]=array(
        'sid' => $row['sid'],
        'fullName' => $row['lname'].', '.$row['fname'].' '.$row['mi'],
        'email' => $row['email'],
        'contactno' => $row['contactno'],
        'depCourse' => $row['department'].' | '.$row['course'],
        'reqFiles' =>$fileRequested
      );
    }
    
  }
  echo json_encode($data);
}else{
}

?>