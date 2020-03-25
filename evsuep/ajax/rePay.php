<?php
include ('../db_config/connection.php');
$output = '';
$lastSid = '';
$data = array();
$queryStudent = mysqli_query($conn,"SELECT * FROM online_account");
if (mysqli_num_rows($queryStudent)>0) {
	while ($rowStudent = mysqli_fetch_assoc($queryStudent)) {
		$sid = $rowStudent['sid'];
		$lname = $rowStudent['lname'];
		$mi = $rowStudent['mi'];
		$fname = $rowStudent['fname'];
		$email  = $rowStudent['email'];
		$contactno = $rowStudent['contactno'];
		$department = $rowStudent['department'];
		$course = $rowStudent['course'];

		$fullname = $lname.', '.$fname.' '.$mi.'.';

		$query = mysqli_query($conn,"SELECT * FROM s_payment WHERE sid ='$sid' AND remarks ='Ready'");
		if(mysqli_num_rows($query)>0){
			while ($row =mysqli_fetch_assoc($query)) {
				$spid = $row['spid'];
				$srid = $row['srid'];
			}
				$querySReq = mysqli_query($conn,"SELECT * FROM s_request WHERE srid ='$srid'");
				if (mysqli_num_rows($querySReq)>0) {
					while ($rowSReq = mysqli_fetch_assoc($querySReq)) {
						$srid = $rowSReq['srid'];
						$srequest = $rowSReq['srequest'];
						$purpose = $rowSReq['purpose'];
					}
					

					$data[] = array(
						'id' => $sid, 
						'fullname' => $fullname, 
						'email' => $email, 
						'contactno' => $contactno, 
						'departmentCourse' => $department.' | '.$course,
						'sid'  => '<center><a class="pull-center btn btn-success btn-sm pay" href="" sid="'.$sid.'""><span class="fa fa-paper-plane"></span>  Pay</a></center></td>'

					);
				}else{

				}	
			
		}else{

		}
	}
}

echo json_encode($data);
?>