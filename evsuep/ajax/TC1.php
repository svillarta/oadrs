<?php
include '../db_config/connection.php';
$count = 0;
$query = mysqli_query($conn,"SELECT * FROM s_request WHERE remarks = 'Approved' AND remarks1='Paid' AND srequest = 'TRANSFER CODINTIAL'");
if (mysqli_num_rows($query)>0) {
	while (mysqli_fetch_assoc($query)) {
	$count ++;
	}
}
if ($count == 0) {
	$output =' <span class="fa-stack badge2 fa-2x has-badge">
                      <i class="fa fa-users"></i>
                    </span>';
}else{
	$output =' <span class="fa-stack badge2 fa-2x has-badge" data-count="'.$count.'">
                      <i class="fa fa-users"></i>
                    </span>';
}


echo $output;
?>