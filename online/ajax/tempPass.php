<?php
session_start();
include("../db_config/connection.php");
$output = '';
$uid = $_SESSION['uid'];
$oldPass = $_POST['oldPass'];
$newPass = $_POST['password'];
$email = $_SESSION['email'];
$no = $_SESSION['contact'];
$query = mysqli_query($conn,"SELECT * FROM users WHERE password = '$oldPass' AND uid = '$uid'");
if (mysqli_num_rows($query)>0) {
	function randStrGen($len){
	    $result = "";
	    $chars = "abcdefghijklmnopqrstuvwxyz-0123456789";
	    $charArray = str_split($chars);
	    for($i = 0; $i < $len; $i++){
	      $randItem = array_rand($charArray);
	      $result .= "".$charArray[$randItem];
	    }
	    return $result;
	}
	// Usage example
	$randstr = randStrGen(5);// for password
	$query1 = mysqli_query($conn,"SELECT * FROM temppass WHERE uid = '$uid'");
	if (mysqli_num_rows($query1)>0) {
		$query2 = mysqli_query($conn,"UPDATE temppass SET newPass = '$newPass', oldPass ='$oldPass', verificationCode='$randstr' WHERE uid ='$uid'");
		if ($query2) {
			$output='success';
		}else{
			$output='error';
		}
	}else{
		$query3 = mysqli_query($conn,"INSERT INTO temppass(id,uid,newPass,oldPass,verificationCode) VALUES(null,'$uid','$newPass','$oldPass','$randstr')");
		if ($query3) {
			$output='success';
		}else{
			$output='error';
		}
	}


	
}else{
	$output='passIncorrect';
}
if ($output =='success') {
	$from = 'aodrs2019@gmail.com';
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
	$message = '<html><body> <b>EVSU-OCC(REGISTRAR)</b>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	// $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['req-name']) . "</td></tr>";
	$message .= "<tr><td><strong>Your Verification Code:</strong> </td><td>" . $randstr . "</td></tr>";
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
		$msg = "\nFROM:EVSU-OCC(REGISTRAR)\n Verification Code:".$randstr;

		//this is my free api code to send message .
		$api = "TR-SAMUE324094_3PZHP";
		$text =  $msg;

		
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
echo $output;
?>