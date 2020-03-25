
<?php
include './db_config/connection.php';
if(isset($_POST['getpass'])) {
	$code = $_POST['code'];
	$fpquery = mysql_query("select * from forgot_pass where code='$code' ")or die(mysql_error());
	$count_fp = mysql_num_rows($fpquery);
	$rowp = mysql_fetch_array($fpquery);
	$sid = $rowp['sid'];
	if ($count_fp > 0){


		echo "<script>
		 alert('Code Accepted!');
		 window.location = 'cp.php?sid=".$sid."';
		</script>";
			exit();
	}else{
		echo "<script>
		 alert('Wrong Code! Please Try Again');
		 window.location = 'tc.php';
		</script>";
	exit();
	}

	}
	?>
