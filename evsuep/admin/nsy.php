
<?php
include '../db_config/connection.php';
if(isset($_POST['nsy'])) {

		$sem = $_POST['sem'];
		$date=date(Y);

	$sy_query = mysql_query("select * from sy where syyear='$date' And sysem='$sem' ")or die(mysql_error());
	$count_sy = mysql_num_rows($sy_query);

	if ($count_sy > 0){
	echo "<script>
		alert('Semester Already Exist!');
		</script>";
	header("location: csy.php?message=1");
	}else{

	$saveua = mysql_query("insert into sy (syyear,sysem) values ('$date','$sem')")or die(mysql_error());

	//userinfo

	echo "<script>
		alert('Successfully Added!');
		</script>";

	header("location: csy.php?message=School Year Successfully Added!");

	exit();

	}

	}
	?>
