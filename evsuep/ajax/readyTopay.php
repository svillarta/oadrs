<?php
include ('../db_config/connection.php');
$output = '';
$count = 0;
$query = mysqli_query($conn,"SELECT * FROM s_payment WHERE remarks= 'Ready'");
if(mysqli_num_rows($query)>0){
	while ($row = mysqli_fetch_assoc($query)) {
		$count ++;
	}
	$output ='<span class="fa-stack badge1 fa-1x has-badge" data-count="'.$count.'"><i class="fa fa-users"></i></span>';
}else{
	$output = 'no';
}

echo $output;
?>