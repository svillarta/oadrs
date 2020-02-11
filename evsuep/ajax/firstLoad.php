<?php
$count = 0;
$output = '';
include '../db_config/connection.php';


$studentsort = mysqli_query($conn,"SELECT * FROM studentsort ORDER BY id DESC");
if (mysqli_num_rows($studentsort)>0) {
  $output .='
   <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Student ID</th>
                          <th>Full Name</th>
                          <th>E-mail</th>
                          <th>Contact No.</th>
                          <th>Department</th>
                          <th>Course</th>
                        </tr>
                      </thead>
                       <tfoot>
                        <tr>
                         <th>Student ID</th>
                          <th>Full Name</th>
                          <th>E-mail</th>
                          <th>Contact No.</th>
                          <th>Department</th>
                          <th>Course</th>
                        </tr>
                      </tfoot>
                      <tbody  role="tablist" >';
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

          $output .='
            <td>'.$sid.'</td>
            <td>'.$fname.' '.$mi.'. '.$lname.'</td>
            <td>'.$email.'</td>
            <td>'.$contactno.'</td>
            <td>'.$department.'</td>
            <td>'.$course.'</td>
            ';

        }
      }else{

      }
      $output .='</tr>';
    }else{
      
    }

    
  }
  $output .='
  </tbody>
                    </table>
                  </div>';
}else{
  
}
echo $output;
?>