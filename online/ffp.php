
<?php
include './db_config/connection.php';
if(isset($_POST['getpass'])) {
		$to = "evsuormoc2018@gmail.com";
		$sid = $_POST['sid'];
		$email = $_POST['email'];
		$code = rand(1000,9999);
		$message =  "Type this code to recover the password " . $code;
		$header = "From:" . $to;
		$subject = "EVSU-Online Request";
	$fpquery = mysql_query("select * from online_account where sid='$sid' And email='$email' ")or die(mysql_error());
	$count_fp = mysql_num_rows($fpquery);

	if ($count_fp > 0){

		$savefp = mysql_query("insert into forgot_pass (sid,email,code)	values ('$sid','$email','$code')")or die(mysql_error());
		mail( "$email", "Subject: $subject","$message", $header );
		echo "<script>
		 alert('Enter this Code " . $code ."');
		 window.location = 'tc.php';
		</script>";
			exit();
	}else{
		echo "<script>
		 alert('Wrong Information! Please Try Again');
		 window.location = 'fp.php';
		</script>";
	exit();
	}

	}
	?>
