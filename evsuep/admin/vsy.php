<?php
include 'check_login.php';
?>

  <?php  include('header.php'); ?>

  <?php include('main_sidebar.php') ?>


  <div class="content-wrapper center" >
    <section class="content-header">
      <h1>

      </h1>

    </section>

    <section class="content">
      <center>
      <div class="row">
        <section class="col-lg-3">

          <div class="box box-info center">
            <div class="box-header">
              <i class="fa fa-person-cap"></i>
              <h3 class="box-title">School Year</h3>
            </div>
            <!-- Content-->
              <form action="delete_account.php" method="post">
								<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
								<thead>
									<tr>
										<th></th>
										<th width="350" ><center>Year</center></th>
										<th width="350" ><center>Semester</center></th>
									 </tr>
								</thead>
								<tbody>


									<?php
											 include '../db_config/connection.php';

											$sql = "SELECT * FROM sy";
														 $result = $conn->query($sql);

														 if ($result->num_rows > 0) {

															while($row = $result->fetch_assoc()) {
																$syid = $row['syid'];


											 ?>
										<tr>
  										<td width="30">
  										<input type="checkbox" name="selector[]" value="<?php echo $id; ?>" hidden>
  										</td>
  										<td width="250"><center><?php echo $row['syyear']; ?></center></td>
  										<td width="250"><center><?php echo $row['sysem']; ?></center></td>
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
