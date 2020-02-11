<?php
include '../db_config/connection.php';
$requesting = $_POST['requesting'];
if ($requesting =='refresh') {
	$sql = mysqli_query($conn,"SELECT * FROM s_request WHERE remarks='Pending'");
}else{
	$sql = mysqli_query($conn,"SELECT * FROM s_request WHERE srequest = '$requesting' AND remarks='Pending'");
}

if (mysqli_num_rows($sql)>0) {
  while($row = mysqli_fetch_assoc($sql)) {
    $srid = $row['srid'];
    $sid = $row['sid'];
    $remarks1 = $row['remarks1'];
    $remarks = $row['remarks'];
    $srequest = $row['srequest'];
    $purpose = $row['purpose'];

      
      $sql1 = mysqli_query($conn,"SELECT * FROM online_account where sid='$sid' ");
      if (mysqli_num_rows($sql1)>0) {
        while($row1 = mysqli_fetch_assoc($sql1)) {
          $oaid = $row1['id'];
          $lastname = $row1['lname'];
          $firstname = $row1['fname'];
          $mi = $row1['mi'];

        }
        ?>
        
        <tr scope="row">
          
          <td ><center><?php echo $row['sdate']; ?></center></td>
          <td ><center><?php echo $row['sid']; ?></center></td>
     
          <td ><center><?php echo $lastname.', '.$firstname.' '.$mi.'.'; ?></center></td>
   
          <td > <?php echo $row['srequest']; ?> 
          <?php
            if ($remarks =='Approved') {
              
              $s_payment = mysqli_query($conn,"SELECT * FROM s_payment WHERE sid='$sid' AND srid='$srid'");
              if (mysqli_num_rows($s_payment)>0) {
                while ($s_paymentRow = mysqli_fetch_assoc($s_payment)) {
                  $pages = $s_paymentRow['pages'];
                }
                ?>
              <i class="pull-right btn-sm" style="font-size: 13px;"><?php echo $pages; ?> page(s)</i>
            <?php
              }
            }else{

            }
            ?>
          </td>
          <td ><center><?php echo $row['purpose']; ?></center></td>
          <td ><center><?php echo $remarks; ?></center></td>

          <td  align="center">
            <?php
            if ($remarks =='Approved') {
              
              ?>
              <a class="btn btn-primary btn-sm" href="vspt.php<?php echo '?srid='.$srid; ?>" ><i  class="fa fa-eye"></i></a>
            <?php
            }else if ($remarks =='Pending') {
             ?>
              <a class="pull-center btn btn-success btn-sm confirm"  href=""  sid="<?php echo $sid; ?>" srid="<?php echo $srid; ?>" srequest="<?php echo $srequest; ?>">Approve</a>
              <?php
            }
            ?>
          </td>
        </tr>
        <?php 
      }else{

      } 
      
  }
}else {
}
?>