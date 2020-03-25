
<?php
include ('../db_config/connection.php');
session_start();
if(isset($_POST['osr'])) {
		$rquest = $_POST['rquest'];
		$purpose = $_POST['purpose'];
	  	$username = $_SESSION['username'];
	  	$password = $_SESSION['password'];
		$date = date("Y/m/d");
		
		$ui = mysqli_query($conn,"SELECT * FROM users where username='$username' and password='$password'");
		
		if(mysqli_num_rows($ui)>0){
			$ui_row = mysqli_fetch_array($ui);
			$uid = $ui_row['uid'];

		}
		$ui1 = mysqli_query($conn,"SELECT * from online_account where uid='$uid' ");
		$cui1= mysqli_num_rows($ui1);
		if($cui1 > 0){
			$ui_row1 = mysqli_fetch_array($ui1);
			$sid = $ui_row1['sid'];
		}
		$savereq = mysqli_query($conn,"INSERT into s_request (sdate,sid,srequest,purpose,remarks)
		values ('$date','$sid','$rquest','$purpose','Pending')");
		//check s_request
		$sr1 = mysqli_query($conn,"SELECT * from s_request where sdate = '$date' and sid = '$sid' and srequest='$rquest' and purpose='$purpose'");
		$csr1 = mysqli_num_rows($sr1);
		if ($csr1>0) {
			// code...
			$sr1_row1 = mysqli_fetch_array($sr1);
			$srid = $sr1_row1['srid'];
		}
		//save notifcation
		$savenot = mysqli_query($conn,"INSERT into notification (date,srid,remarks)
		values ('$date','$srid','unseen')");

		if ($savereq == true && $savenot ==true) {
			echo "<script>
			    alert('Request successfully created!');
			    window.location = 'osr.php';
			    </script>";
					exit();
		}else{

		}
    
}

?>
