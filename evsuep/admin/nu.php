
<?php
include '../db_config/connection.php';
if(isset($_POST['newacc'])) {

		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$mi = $_POST['mi'];
		$address = $_POST['address'];
		$dob = $_POST['dob'];
		$email = $_POST['email'];
		$position = $_POST['position'];
		$department = $_POST['department'];
		$utype = $_POST['utype'];
		$username = $_POST['username'];
		$pass = $_POST['password'];

	$emp_query = mysql_query("select * from users where username='$username' And password='$pass' ")or die(mysql_error());
	$count_emp = mysql_num_rows($emp_query);

	if ($count_emp > 0){

	    echo "<script>
	    alert('Account already existed!');
	    window.location = 'create_account.php';
	    </script>";

	}else{

	$saveua = mysql_query("insert into users (username,password,utype) values ('$username','$pass','$utype')")or die(mysql_error());

	//userinfo
	$ui = mysql_query("select * from users where username='$username' And password='$pass' ")or die(mysql_error());
	$cui= mysql_num_rows($ui);
	if($cui > 0)
	{
		$ui_row = mysql_fetch_array($ui);
		$uid = $ui_row['uid'];
		$saveui = mysql_query("insert into user_info (uid,lname,fname,mi,bdate,address,email,position,department)
		values ('$uid','$lastname','$firstname','$mi','$dob','$address','$email','$position','$department')")or die(mysql_error());
	}

	    echo "<script>
	    alert('Successfully Registered!');
	    window.location = 'create_account.php';
	    </script>";

	exit();
	?>

	<?php
	}

	}
	?>
