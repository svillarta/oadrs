<?php
include('check_login.php');
include('header.php');
include('main_sidebar.php') ;
?>
<div class="content-wrapper">
  <section class="content">
    <center>
    <div class="row">
    <section class="col-lg-4">
    </section>
    <section class="col-lg-5">
      <div class="box box-info">
        <div class="box-header">
          <i class="fa fa-person-cap"></i>
          <h3 class="box-title">Course</h3>
        </div>
            <!-- Content-->
        <form action="dc.php" method="post">
					<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
		       <thead>
  					<tr>
  						<th></th>
  						<th width="350" ><center>Courses</center></th>
  						<th width="100"><center>Action</center></th>
  		      </tr>
			     </thead>
		       <tbody>
							<?php
				        include('../db_config/connection.php');
	              $sc = "SELECT * FROM course  order by course asc";
				        $result = $conn->query($sc);
								 if ($result->num_rows > 0)
                 {
									while($row = $result->fetch_assoc())
                  {
                  	$cid = $row['cid'];
							 ?>
								<tr>
								<td width="30">
								<input type="checkbox" name="selector[]" value="<?php echo $cid; ?>" hidden>
								</td>
								<td width="350"><center><?php echo $row['course']; ?></center></td>
								<td width="100">
    							<a href="uc.php<?php echo '?cid='.$cid; ?>"  class="btn btn-success"><i  class="fa fa-pencil"></i></a>
                  <a class="btn btn-danger"<a onclick="return confirm('Are you sure you want to delete?');" href="dc.php<?php echo '?cid='.$cid; ?>"><i  class="fa fa-trash"></i></a>
								</td>
								</tr>
								<?php }
									}else {}
		              $conn->close();
								 ?>
								</tbody>
							</table>
              <div class="box-footer clearfix">
                <a class="pull-right btn btn-default" href="index.php"><i  class="fa fa-arrow-left">Back</i></a>
              </div>
            </form>
        </section>
      </div>
  <?php include('footer.php') ?>
  <div class="control-sidebar-bg"></div>
</div>
</center>

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
