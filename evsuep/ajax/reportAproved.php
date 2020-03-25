<?php
include '../db_config/connection.php';
$data = array();

$getUserData = mysqli_query($conn,"SELECT * FROM online_account,users WHERE utype ='Student' AND online_account.uid = users.uid");
while ($userData = mysqli_fetch_array($getUserData)) {
	$sid = $userData['sid'];
	$query = mysqli_query($conn,"SELECT * from s_request WHERE remarks = 'Approved' AND remarks1 ='Released' AND sid = '$sid' ");
	if (mysqli_num_rows($query)>0) {
		while ($row = mysqli_fetch_array($query)) {
			$srid = $row['srid'];
			$query1 = mysqli_query($conn,"SELECT * from s_payment WHERE srid='$srid'");
			while ($row1 = mysqli_fetch_array($query1)) {
				$page = $row1['pages'];
			}
			if ($row['srequest'] == 'TRANSCRIPT OF RECORD') {
				$purpose = '| Purpose '. $row['purpose'].' | Page(s)'.$page;
			}else{
				$purpose = '';
			}
			$data[] = array(
				'sid' => $row['sid'],
				'fullname' => $userData['fname']." ".$userData['mi'].'. '.$userData['lname'],
				'email' => $userData['email'],
				'contactno' => $userData['contactno'],
				'depcourse' => $userData['department'].'| '.$userData['course'],
				'srequest' => $row['srequest'].' '.$purpose,
				'requestDate' => $row['sdate'],
				'paidDate' => $row['pdate'],

			);
		}
	}else{

}
}




echo json_encode($data);
?>