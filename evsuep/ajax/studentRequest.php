<?php
include '../db_config/connection.php';
$output ='';
$sid = $_POST['sid'];
$query = mysqli_query($conn,"SELECT * FROM s_request WHERE sid ='$sid' AND remarks ='Pending' AND remarks1 ='Pending'");
if (mysqli_num_rows($query)>0) {
	$output .='
		<div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
              <thead>
                <tr>
                  <th>Date of Request</th>
                  <th>Request File</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Date of Request</th>
                  <th>Request File</th>
                  <th class="text-right">Actions</th>
                </tr>
              </tfoot>
              <tbody>';
	while ($row = mysqli_fetch_assoc($query)) {
		$srid = $row['srid'];
		$srequest = $row['srequest'];
		$purpose = $row['purpose'];
		$sdate = $row['sdate'];

		$output .='
			<tr>
	              <td>'.$sdate.'</td>
	              <td>'.$srequest;

	              if ($srequest == 'TRANSCRIPT OF RECORD') {
	              	$output .=' ('.$purpose.')';
	              }else{}

	    $output .='      	
	              </td>
	              <td class="text-right">
	                <a href="#" class="btn btn-success btn-sm confirm" sid="'.$sid.'" srid="'.$srid.'" srequest="'.$srequest.'">Approve</a>
	              </td>
	            </tr>';
	}
}else{
	
}
echo $output;
?>