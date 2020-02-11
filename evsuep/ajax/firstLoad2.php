<?php
$count = 0;
$count1 = 0;
include '../db_config/connection.php';



$query = mysqli_query($conn,"SELECT * FROM online_account");
while ($row = mysqli_fetch_assoc($query)) {
  $sidA = $row['sid'];
  if (isset($sidA)) {
    $sql = mysqli_query($conn,"SELECT * FROM s_request WHERE remarks='Approved' AND (remarks1='Paid' OR remarks1 ='Released')  AND sid ='$sidA' ");
    if (mysqli_num_rows($sql)>0) {
      $count1 ++;
    }
  }
}



$query = mysqli_query($conn,"SELECT * FROM online_account ");
while ($row = mysqli_fetch_assoc($query)) {
  $sidA = $row['sid'];
  $lastname = $row['lname'];
  $firstname = $row['fname'];
  $mi = $row['mi'];
  
  $fullname = $firstname .' '.$mi.'. '.$lastname;
  if ($count1 == $count+1) {
    $show = 'show';
  }else{
    $show = '';
  }
  $count++;
  $sql = mysqli_query($conn,"SELECT * FROM s_request WHERE remarks1 ='Released' AND sid='$sidA'");
  if (mysqli_num_rows($sql)>0) {
    ?>
    <tr>
      <td>
        <div class="card-collapse">
          <div class="card-header" role="tab" id="headingOne">
            <h5 class="mb-0">
              <a data-toggle="collapse" href="#collapse<?php echo $sidA ?>" aria-expanded="false" aria-controls="collapse<?php echo $sidA ?>" class="collapsed">
                <b><?php echo $fullname; ?> </b> | <b style="color: grey;"><?php echo $sidA; ?></b>
                <i class="material-icons">keyboard_arrow_down</i>
              </a>

            </h5>
          </div>
          <div id="collapse<?php echo $sidA ?>" class="collapse <?php echo $show; ?>" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
            <div class="card-body">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
               <thead>
                <tr>
                  <th>Date</th>
                  <th>Request</th>
                  
                  
                  <th>Remarks</th>
                  
                </tr>
              </thead>
             
              <tbody> 
    <?php
    while($row = mysqli_fetch_assoc($sql)) {
      $srid = $row['srid'];
      $sid = $row['sid'];
      $remarks1 = $row['remarks1'];
      $remarks = $row['remarks'];
      $remarks1 = $row['remarks1'];
      $srequest = $row['srequest'];
      $purpose = $row['purpose'];
      $sql1 = mysqli_query($conn,"SELECT * FROM online_account where sid='$sid' ");
      if (mysqli_num_rows($sql1)>0) {
        while($row1 = mysqli_fetch_assoc($sql1)) {
          $oaid = $row1['id'];
         
        }
        ?>
        <tr scope="row">
          <td ><?php echo $row['sdate']; ?></td>
          <td > <?php echo $row['srequest']; ?> 
          <?php
            if ($srequest =='TRANSCRIPT OF RECORD') {
              ?>
              <i class=" btn-sm" style="font-size: 13px;">(<?php echo $row['purpose']; ?>)</i>
              <?php
            }
            if (($remarks1 =='Paid' || $remarks1 =='Released') && $remarks =='Approved') {
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
          
          <td ><?php echo $remarks1; ?></td>

          
        </tr>
        <?php 
      }else{

      } 
      
    }
    ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php
  }else {
  }
}
        
?>