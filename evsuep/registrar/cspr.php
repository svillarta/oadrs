<?php
include 'check_login.php';

?>

<?php
$srid = $_GET['srid'];
$sre = $_GET['sr'];
$pu = $_GET['p']; ?>

  <?php  include('header.php'); ?>
  <?php include('main_sidebar.php') ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
      </h1>

    </section>
    <section class="content">
      <center>
      <div class="row">
        <section class="col-lg-6">
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-person-cap"></i>
              <h3 class="box-title"><?php echo $_GET['sr']. '( '. $_GET['p'].')'?> </h3>
            </div>
            <!-- Content-->
              <form action="nspr.php?srid=<?php echo $srid; ?>&ftid=<?php echo $ftid; ?>&sr=<?php echo $sre; ?>&p=<?php echo $pu; ?>" method="post">

                <div class="form-row">
                  <div class="form-group col-md-2" align="left">
                  </div>
                </div>

              	 <div class="form-row">
				 	<div class="form-group col-md-4"align="left">
					  	<label >Fee Description:</label>
		                <select class="form-control" name="ftid" required>
		                  <option value="" disabled selected>Select Fee Type</option>

	                  		<?php
							include '../db_config/connection.php';

							$sql = "SELECT * FROM fee_type";
						 	$result = $conn->query($sql);

						 	if ($result->num_rows > 0) {

							while($row = $result->fetch_assoc()) {
								$id = $row['ftid'];

						 	?>

			                  <option value="<?php echo $row['ftid']; ?>"><?php echo $row['fdesc']; ?></option>
		                  	<?php }
							}else {

								}
							 $conn->close();
						 	?>
		                </select>
	              	</div>
					</div>

					<?php
						//include '../db_config/connection.php';
						//$gft = $_GET['ft'];

						//$sql = "SELECT * FROM fee_type where fdesc='$gft'";
					 	//$result = $conn->query($sql);

					 	//if ($result->num_rows > 0) {

						//while($row = $result->fetch_assoc()) {
						//	$id = $row['ftid'];
						//	$amount = $row['amount'];

						//}
					//}
						// $conn->close();
				 	?>

					<div class="form-row">
						<div class="form-group col-md-4" align="left">
						  <label>Qty:</label>
						  <input type="number" class="form-control" name="qty"  placeholder="Quantity" min="1" max="100" value="<?php echo $amount; ?>" required>
						</div>
					</div>
          <!--
					<div class="form-row">
						<div class="form-group col-md-4" align="left">
						  <label>Amount:</label>
						  <input type="text" class="form-control" name="Amount"  placeholder="Amount" required>
						</div>
					</div>
        -->
					<div class="form-row">
            <div class="form-group col-md-12">
              <hr>
            </div>
					</div>
          <div class="box-footer clearfix">
            <button type="submit" class="pull-right btn btn-primary" name="ncspr">Add
              <i class="fa fa-arrow-circle-up"></i></button>
          </div>


            </form>
        </section>
      </div>
    </center>
    <!-- transaction -->
    <section class="col-lg-6">
    <center>
    <div class="box box-info">
      <div class="box-header">
        <i class="fa fa-person-cap"></i>
        <h3 class="box-title">View Payment Request Transaction</h3>
      </div>
      <!-- Content-->
        <form action="#" method="post">
          <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
          <thead>
            <tr>
              <th></th>
              <th width="350" ><center>Date</center></th>
              <th width="350" ><center>Request</center></th>
              <th width="350" ><center>Amount</center></th>
              <th></th>
             </tr>
          </thead>
          <tbody>

            <?php
                 include '../db_config/connection.php';

                $sql = "SELECT * FROM s_payment where srid='$srid'";
                       $result = $conn->query($sql);

                       if ($result->num_rows > 0) {

                        while($row = $result->fetch_assoc()) {
                          $spid = $row['spid'];
                          $ftid = $row['ftid'];
                          $date = $row['sdate'];
                          $amount = $row['samount'];
                 ?>
              <tr>
              <td width="30">
              <input type="checkbox" name="selector[]" value="<?php echo $spid; ?>" hidden>
              </td>
              <td width="250"><center><?php echo $date; ?></center></td>
              <?php
                $ui = mysql_query("select * from fee_type where ftid='$ftid' ")or die(mysql_error());
                $cui= mysql_num_rows($ui);
                if($cui > 0)
                {
                	$ui_row = mysql_fetch_array($ui);
                	$fdesc = $ui_row['fdesc'];
                }
              ?>
              <td width="250"><center><?php echo $fdesc; ?></center></td>
              <td width="250"><center><?php echo $amount; ?></center></td>
              <td width="40">
              <a class="btn btn-danger"<a onclick="return confirm('Are you sure you want to delete transaction ?');" href="dprt.php<?php echo '?spid='.$spid; ?>&sr=<?php echo $sre; ?>&p=<?php echo $pu; ?>"><i  class="fa fa-trash"></i></a>
              </td>
              </tr>
              <?php }
                }else {
                      }
                $conn->close();
               ?>

          </tbody>

        </table>


      </form>
  </section>
</div>
</center>

  <?php include('footer.php') ?>


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
