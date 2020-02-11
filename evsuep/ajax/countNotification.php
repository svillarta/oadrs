<?php
include ('../db_config/connection.php');
$output = '';
$count = 0;
$query = mysqli_query($conn,"SELECT * FROM notification WHERE remarks= 'unseen'");
if(mysqli_num_rows($query)>0){
	while ($row = mysqli_fetch_assoc($query)) {
		$count ++;
	}
	$output ='('.$count.')';
}else{
	$output = 'no';
}

echo $output;
?>