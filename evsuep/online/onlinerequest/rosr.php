
<?php
include ('../db_config/connection.php');
include ("check_login.php");
if(isset($_POST['osr'])) {
		$rquest = $_POST['rquest'];
		$purpose = $_POST['purpose'];
	  $username = $_SESSION['username'];
	  $password = $_SESSION['password'];
		$date = date("Y/m/d");

		$ui = mysql_query("select * from users where username='$username' And password='$password' ")or die(mysql_error());
		$cui= mysql_num_rows($ui);
		if($cui > 0)
		{
			$ui_row = mysql_fetch_array($ui);
			$uid = $ui_row['uid'];

		}
		$ui1 = mysql_query("select * from online_account where uid='$uid' ")or die(mysql_error());
		$cui1= mysql_num_rows($ui1);
		if($cui1 > 0)
		{
			$ui_row1 = mysql_fetch_array($ui1);
			$sid = $ui_row1['sid'];
		}
		$savereq = mysql_query("insert into s_request (sdate,sid,srequest,purpose,remarks)
		values ('$date','$sid','$rquest','$purpose','Pending')")or die(mysql_error());
		//check s_request
		$sr1 = mysql_query("select * from s_request where sdate = '$date' and sid = '$sid' and srequest='$rquest' and purpose='$purpose'")or die(mysql_error());
		$csr1 = mysql_num_rows($sr1);
		if ($csr1>0) {
			// code...
			$sr1_row1 = mysql_fetch_array($sr1);
			$srid = $sr1_row1['srid'];
		}
		//save notifcation
		$savenot = mysql_query("insert into notification (date,srid,remarks)
		values ('$date','$srid','unseen')")or die(mysql_error());

    echo "<script>
    alert('Request successfully created!');
    window.location = 'osr.php';
    </script>";
		exit();
}

?>
