<?php
include ('../db_config/connection.php');

$output ='';
$fName = $_POST['fName'];
$mi = $_POST['mi'];
$lName = $_POST['lName'];
$studentId = $_POST['studentId'];
$department = $_POST['department'];
$course = $_POST['course'];
$no = $_POST['no'];
$email = $_POST['email'];



$query = mysqli_query($conn,"SELECT * FROM online_account WHERE sid = '$studentId'");
if (mysqli_num_rows($query)>0) {
	$output ='studIdExist';
}else{
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
	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	// $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['req-name']) . "</td></tr>";
	$message .= "<tr><td><strong>Your Username:</strong> </td><td>" . $fName . "</td></tr>";
	$message .= "<tr><td><strong>Your Password:</strong> </td><td>" . $randstr . "</td></tr>";
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

		mysqli_query($conn,"INSERT INTO users(uid,username,password,utype) VALUES(null,'$fName','$randstr','Student')");
		$query2 = mysqli_query($conn,"SELECT * FROM users WHERE username = '$fName'");
		if (mysqli_num_rows($query2)>0) {
			while ($row2 = mysqli_fetch_assoc($query2)) {
				$uid = $row2['uid'];
			}
			mysqli_query($conn,"INSERT INTO online_account(id,uid,sid,lname,fname,mi,email,contactno,department,course) VALUES(null,'$uid','$studentId','$lName','$fName','$mi','$email','$no','$department','$course')");
			

			//send SMS
			$name = $fName.' '.$mi.'. '.$lName;
			$msg = "\nStudent No. :".$studentId."\n Username :".$fName."\n Password :".$randstr;

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
			    $output = 'send';
			} else {
			    $output = "Error Num " . $result . " was encountered!";
			}
			
			
		}else{
			$output = 'error';
		}

		
		
	}else{
		$output = 'error';
	}
}



echo $output;
?>