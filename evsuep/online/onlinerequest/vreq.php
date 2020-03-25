<?php
include ('check_login.php');
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
              <h3 class="box-title">List of Transactions</h3>
            </div>
            <!-- Content-->
              <form action="error404.php" method="post">
								<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
								<thead>
									<tr>
										<th></th>
										<th width="350" ><center>Date</center></th>
										<th width="350" ><center>Request</center></th>
										<th width="350" ><center>Purpose</center></th>
										<th width="350" ><center>Pick-Up Date</center></th>
										<th width="350" ><center>Amount</center></th>
										<th width="350" ><center>Remarks</center></th>
										<th><center>Action</center></th>
									 </tr>
								</thead>
								<tbody>
                  <?php
                    $uname = $_SESSION['username'];
                    $pass = $_SESSION['password'];
                    $user_query = mysql_query("select * from users where username='$uname' and password='$pass'")or die(mysql_error());
                    while($row = mysql_fetch_array($user_query)){
                    $uid = $row['uid'];
                  }
                  ?>

									<?php
											 include ('../db_config/connection.php');

                       //get sid
                         $sid_query = mysql_query("select * from online_account where uid = '$uid'")or die(mysql_error());
                         $row = mysql_fetch_array($sid_query);
                         $sid = $row['sid'];

                         $sid_query1 = mysql_query("select * from s_request where sid = '$sid'")or die(mysql_error());
                         $row1 = mysql_fetch_array($sid_query1);
	                       $srid = $row1['srid'];

                         $sid_query2 = mysql_query("select sum(samount) from s_payment where srid = '$srid'")or die(mysql_error());
                         $row2 = mysql_fetch_array($sid_query2);


											       $sql = "SELECT * FROM s_request WHERE sid='$sid' AND remarks='Pending'";
														 $result = $conn->query($sql);

														 if ($result->num_rows > 0) {

															while($row = $result->fetch_assoc()) {
																$srid = $row['srid'];
											 ?>
										<tr>
										<td width="30">
										<input type="checkbox" name="selector[]" value="<?php echo $srid; ?>" hidden>
										</td>
										<td width="250"><center><?php echo $row['sdate']; ?></center></td>
										<td width="250"><center><?php echo $row['srequest']; ?></center></td>
										<td width="250"><center><?php echo $row['purpose']; ?></center></td>
										<td width="250"><center><?php echo $row['pdate']; ?></center></td>
                   <td width="250"><center><?php echo $row2['sum(samount)']; ?></center></td>
										<td width="250"><center><?php echo $row['remarks']; ?></center></td>
										<td width="40">
                      <center>
										<a href="error404.php<?php echo '?id='.$id; ?>"  class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-danger"<a onclick="return confirm('Are you sure you want to delete account ?');" href="dosr.php<?php echo '?srid='.$srid; ?>"><i  class="fa fa-trash"></i></a>
                  </center>
                    </td>
										</tr>
										<?php }
											}else {
														}
											$conn->close();
										 ?>
                     <?php
                          include '../db_config/connection.php';

                         $sql = "SELECT * FROM s_request where sid='$sid' and remarks='Confirmed'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {

                                 while($row = $result->fetch_assoc()) {
                                   $srid = $row['srid'];
                                   $sid_query3 = mysql_query("select sum(samount) from s_payment where srid = '$srid'")or die(mysql_error());
                                   $row3 = mysql_fetch_array($sid_query3);


                          ?>
                       <tr>
                       <td width="30">
                       <input type="checkbox" name="selector[]" value="<?php echo $srid; ?>" hidden>
                       </td>
                       <td width="250"><center><?php echo $row['sdate']; ?></center></td>
                       <td width="250"><center><?php echo $row['srequest']; ?></center></td>
                       <td width="250"><center><?php echo $row['purpose']; ?></center></td>
                       <td width="250"><center><?php echo $row['pdate']; ?></center></td>
   										<td width="250"><center><?php echo $row3['sum(samount)']; ?></center></td>
                       <td width="250"><center><?php echo $row['remarks']; ?></center></td>
                       <td width="250"><center><a class="pull-center btn btn-primary" href="vspt.php<?php echo '?srid='.$srid; ?>" ><i  class="fa fa-eye"></i></a></center></td>

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
