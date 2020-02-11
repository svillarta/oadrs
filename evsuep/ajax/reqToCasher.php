<?php
include '../db_config/connection.php';
$sid = $_POST['sid'];
$srid = $_POST['srid'];
$pageCount = $_POST['pageCount'];
$output = '';
if ($pageCount == null) {
	$pageCount = 1;
}
$query = mysqli_query($conn,"SELECT * FROM s_request WHERE srid = '$srid'");
if (mysqli_num_rows($query)>0) {
	while ($row = mysqli_fetch_assoc($query)) {
		$srequest = $row['srequest'];
	}

	if ($srequest == 'TRANSCRIPT OF RECORD') {
		if ($pageCount == 1) {
			# code...
		}else{
			$pageCount = $pageCount - 1;
			$amount = $pageCount * 40;
			$amount = $amount + 100;
		}
	}else if ($srequest == 'CERTIFICATE OF GRADES') {
		$amount = 90;
	}else if ($srequest == 'GOODMORAL') {
		$amount = 90;
	}else if ($srequest == 'HONORABLE DISMISSAL') {
		$amount = 90;
	}
	$insert = mysqli_query($conn,"INSERT INTO s_payment(spid,srid,sid,pages,sdate,samount,remarks) VALUES(null,'$srid','$sid','$pageCount','','$amount','Ready')");
	$update = mysqli_query($conn,"UPDATE s_request SET remarks ='Approved' WHERE srid='$srid'");
	if ($insert == true && $update == true) {
		
		$studentInfo = mysqli_query($conn,"SELECT * FROM online_account WHERE sid = '$sid'");
		if (mysqli_num_rows($studentInfo)>0) {
			while($rowinfo = mysqli_fetch_assoc($studentInfo)){
				$lName = $rowinfo['lname'];
				$fName = $rowinfo['fname'];
				$mi = $rowinfo['mi'];
				$email = $rowinfo['email'];
				$no = $rowinfo['contactno'];
			}
			//send a email and sms notification
			$from = 'oadrs2019@gmail.com';
			$to      = $email;
			$subject = 'Verification code';
			$headers = 'Content-type: text/html; charser =UTF-8;' . '\r \n';
			$headers .= "From: " . $from . "\r\n";
			$headers .= "Reply-To: ". $to . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$message = '<html><body>';
			$message .= '<h1>Hi, Student</h1>';
			$message .= '</body></html>';
			$message = '<html><body>';
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			// $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['req-name']) . "</td></tr>";
			$message .= "<tr><td><strong>Your Request:</strong> </td><td>" . $srequest . "</td></tr>";
			$message .= "<tr><td><strong>Your Page(s):</strong> </td><td>" . $pageCount . "</td></tr>";
			$message .= "<tr><td><strong>Your Amount to pay:</strong> </td><td>" . $amount . "pesos </td></tr>";
			$message .= "<tr><td><strong>Request status:</strong> </td><td>Approved</td></tr>";
			$message .= "<tr><td><strong>REMINDER</strong> </td><td>You can now pay to the EVSU-OCC Casher</td></tr>";

			// $message .= "<tr><td><strong>Your Username:</strong> </td><td>" . $fName . "</td></tr>";
			// $message .= "<tr><td><strong>Your Password:</strong> </td><td>" . $randstr . "</td></tr>";
			// $message .= "<tr><td><strong>Urgency:</strong> </td><td>" . strip_tags($_POST['urgency']) . "</td></tr>";
			// $message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . $_POST['URL-main'] . "</td></tr>";
			// $addURLS = $_POST['addURLS'];
			// $message .= "<tr><td><strong>URL To Change (additional):</strong> </td><td>" . strip_tags($addURLS) . "</td></tr>";
			// $message .= '<tr><td><strong>Your Verification Code:</strong> </td><td>' . $randstr1 . '</td></tr><br>';
			// $message .= '<tr><td><h2><a href="https://gamescontrol.000webhostapp.com/player/index.php?username='.$username.'&password='.$randstr.'">Click me to verify your E-mail</a></h2></td></tr>';
			$message .= '</table>';
			$message .= '</body></html>';
			

		    
			$testSend = mail($to, $subject, $message, $headers);
			if ($testSend) {

				//send SMS
				$name = $fName.' '.$mi.'. '.$lName;
				$msg = 'Your '.$srequest.' has been approved for more details check your email';

				//this is my free api code to send message .
				$queryApi = mysqli_query($conn,"SELECT * FROM itextmo WHERE id = 1");
				while ($rowApi = mysqli_fetch_assoc($queryApi)) {
					$dApi = $rowApi['api'];
				}
				$api = $dApi;
				
				$text = $name . ":" . $msg;

				
				$message='';
				function itexmo($number,$message,$apicode){
				$url = 'https://www.itexmo.com/php_api/api.php';
				$itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
				$param = array(
				    'http' => array(
				        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				        'method'  => 'POST',
				        'content' => http_build_query($itexmo),
				    ),
				);
				$context  = stream_context_create($param);
				return file_get_contents($url, false, $context);}

				
				$result = itexmo($no,$text,$api);
				if ($result == "") {
				    $output =  "iTexMo: No response from server!!!
				    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL 
				   then try CURL-LESS and vice versa.   
				    Please CONTACT US for help. ";
				} else if ($result == 0) {
				    $output = 'success';
				} else {
				    $output = "Error Num " . $result . " was encountered!";
				}
				
			}else{
				$output = 'error';
			}
		}else{

		}
		
		
	}else{
		$output = 'error';
	}
}else{
	$output = 'error';
}
echo $output;
?>