
<?php
include './db_config/connection.php';
if(isset($_POST['regacc'])) {

		$sid = $_POST['sid'];
		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$mi = $_POST['mi'];
		$email = $_POST['email'];
		$contact = $_POST['contactno'];
		$department = $_POST['department'];
		$course = $_POST['course'];
		$username = $_POST['username'];
		$pass = $_POST['password'];

	$emp_query = mysql_query("select * from users where username='$username' And password='$pass' ")or die(mysql_error());
	$count_emp = mysql_num_rows($emp_query);

	if ($count_emp > 0){
		echo '<script type="text/javascript">
			alert("Account Already Exist!");
			window.location = "r.php";
		</script>';


	}else{

	$saveua = mysql_query("insert into users (username,password,utype) values ('$username','$pass','Student')")or die(mysql_error());

	//userinfo
	$ui = mysql_query("select * from users where username='$username' And password='$pass' ")or die(mysql_error());
	$cui= mysql_num_rows($ui);
	if($cui > 0)
	{
		$ui_row = mysql_fetch_array($ui);
		$uid = $ui_row['uid'];
		$saveui = mysql_query("insert into online_account (uid,sid,lname,fname,mi,email,contactno,department,course)
		values ('$uid','$sid','$lastname','$firstname','$mi','$email','$contact','$department','$course')")or die(mysql_error());
	}
	echo "<script>
	 alert('Successfully Added!');
	 window.location = 'r.php';
	</script>";


	exit();
	}

	}
	?>
