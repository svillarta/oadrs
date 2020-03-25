<?php
include 'check_login.php';
?>

  <?php  include('header.php'); ?>

  <?php include('main_sidebar.php') ?>


  <div class="content-wrapper">
    <section class="content-header">
      <h1>

      </h1>

    </section>

    <section class="content">
      <center>
      <div class="row">
        <section class="col-lg-12">

          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-person-cap"></i>
              <h3 class="box-title">Notification</h3>
            </div>
            <!-- Content-->
              <form action="error404.php" method="post">
								<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
								<thead>
									<tr>
										<th></th>
										<th width="350" ><center>Date</center></th>
										<th width="350" ><center>Student ID</center></th>
                    <th width="350" ><center>Lastname</center></th>
                    <th width="350" ><center>FirstName</center></th>
                    <th width="350" ><center>M.I.</center></th>
										<th width="350" ><center>Request</center></th>
										<th width="350" ><center>Purpose</center></th>
										<th width="350" >Action</th>
										<th></th>
									 </tr>
								</thead>
								<tbody>
									<?php
											 include '../db_config/connection.php';
                            $sql = mysqli_query($conn,"SELECT * FROM notification where remarks='unseen'");
														
														if (mysqli_num_rows($sql)>0) {
															while($row = mysqli_fetch_assoc($sql)) {
																$nid = $row['nid'];
  															$srid = $row['srid'];
                                
                                $sql1 = mysqli_query($conn,"SELECT * FROM s_request where srid = '$srid'");
                                while ($row1 = mysqli_fetch_assoc($sql1)) {
                                  $sid = $row1['sid'];
                                  $srequest = $row1['srequest'];
                                  $purpose = $row1['purpose'];
                                  $date = $row['date1'];
                                }
                                  
                                  
                								?>
                										<tr>
                  										<td width="30">
                  										<input type="checkbox" name="selector[]" value="<?php echo $nid; ?>" hidden>
                  										</td>
                  										<td width="250"><center><?php echo $row['date1']; ?></center></td>
                  										<td width="250"><center><?php echo $row1['sid']; ?></center></td>
                                      <?php
                                     
                                      $sql2 = mysqli_query($conn,"SELECT * FROM online_account where sid='$sid'");
                                      if (mysqli_num_rows($sql2)>0) {
                                        while($row2 = mysqli_fetch_assoc($sql2)) {
                                          $oaid = $row2['id'];
                                          $lastname = $row2['lname'];
                                          $firstname = $row2['fname'];
                                          $mi = $row2['mi'];
                                        }
                                      }
                                      ?>
                                      <td width="350"><center><?php echo $lastname; ?></center></td>
                                      <td width="350"><center><?php echo $firstname; ?></center></td>
                                      <td width="350"><center><?php echo $mi; ?></center></td>
                  										<td width="250"><center><?php echo $row1['srequest']; ?></center></td>
                  										<td width="250"><center><?php echo $row1['purpose']; ?></center></td>
                  										<td width="40">
                                        <a class="pull-center btn btn-success"  onclick="return confirm('Are you sure you want to confirm?');" href="evosr.php<?php echo '?nid='.$nid; ?>&srid=<?php echo $srid; ?>">Confirm</a>
                  										</td>
                										</tr>
                										<?php 
                              }
      											}else {

      														}
      															 
      										 ?>
								</tbody>

							</table>


            </form>
        </section>
      </div>
    </center>





  <?php include('footer.php') ?>




  <div class="control-sidebar-bg"></div>
</div>

<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../plugins/morris/morris.min.js"></script>
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../plugins/knob/jquery.knob.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/pages/dashboard.js"></script>
<script src="../dist/js/demo.js"></script>
</body>
</html>

