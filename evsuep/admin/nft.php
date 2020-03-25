
<?php
include('../db_config/connection.php');
if(isset($_POST['nf'])) {

		$fd = $_POST['fd'];
		$fa = $_POST['fa'];

	$fee_query = mysql_query("select * from fee_type where fdesc='$fd' ")or die(mysql_error());
	$count_emp = mysql_num_rows($fee_query);

	if ($count_emp > 0){
		echo "<script>
		alert('Fee Description Already Exist!');
		window.location = 'cft.php';
		</script>";

	}else{
	$saveua = mysql_query("insert into fee_type (fdesc,amount) values ('$fd','$fa')")or die(mysql_error());

	echo "<script>
	alert('Fee Successfully Added!');
	window.location = 'cft.php';
	</script>";
	exit();
	}
	}
	?>
