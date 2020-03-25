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
      <div class="row">
        <section class="col-lg-12">

          <div class="box box-info">
            <div class="box-header">

              <i class="fa fa-person-cap"></i>
              <center>
              <h3 class="box-title" >Notification</h3>
            </center>
            </div>
            <!-- Content-->



              <form method="POST">
								<table cellpadding="0" cellspacing="0" border="0" class="table" id="myTable">
								<thead>
                  <tr class="header">
                    <th></th>
                    <th width="150" ><center></center></th>
                    <th width="150" ><center></center></th>
                    <th width="350" ><center></center></th>
                    <th width="350" ><center></center></th>
                    <th width="350" ><center></center></th>
                    <th width="500" ><center></center></th>
                    <th width="350" ><center></center></th>
                    <th width="150" ><center></center></th>
										<th width="350" ><center><input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for date.." align="left"></center></th>

										<th></th>
									 </tr>
									<tr class="header">
										<th></th>
										<th width="150" ><center>Date</center></th>
										<th width="150" ><center>Student ID</center></th>
										<th width="350" ><center>Lastname</center></th>
										<th width="350" ><center>FirstName</center></th>
										<th width="350" ><center>M.I.</center></th>
										<th width="500" ><center>Request</center></th>
										<th width="350" ><center>Purpose</center></th>
                		<th width="150" ><center>Pick-Up Date</center></th>
                    <th width="850"><center>Action</center></th>
									 </tr>
								</thead>
								<tbody>
									<?php

											 include '../db_config/connection.php';

											$sql = "SELECT * FROM s_request where remarks='Confirmed' AND (remarks1!='Releasing' And remarks1!='done') order by srid desc";
														 $result = $conn->query($sql);
														 if ($result->num_rows > 0) {
															while($row = $result->fetch_assoc()) {
																$srid = $row['srid'];
  															$sid = $row['sid'];
                                $remarks1 = $row['remarks1'];
                                $remarks = $row['remarks'];
                                $srequest = $row['srequest'];
                                $purpose = $row['purpose'];

											 ?>
										<tr>
  										<td width="30">
  										<input type="checkbox" name="selector[]" value="<?php echo $srid; ?>" hidden>
  										</td>
  										<td width="150"><center><?php echo $row['sdate']; ?></center></td>
  										<td width="150"><center><?php echo $row['sid']; ?></center></td>
                      <?php
                      $sql1 = "SELECT * FROM online_account where sid='$sid' ";
                             $result1 = $conn->query($sql1);
                             if ($result1->num_rows > 0) {
                              while($row1 = $result1->fetch_assoc()) {
                                $oaid = $row1['id'];
                                $lastname = $row1['lname'];
                                $firstname = $row1['fname'];
                                $mi = $row1['mi'];

                      ?>

                    <?php }} ?>
                      <td width="350"><center><?php echo $lastname; ?></center></td>
                      <td width="350"><center><?php echo $firstname; ?></center></td>
                      <td width="350"><center><?php echo $mi; ?></center></td>
  										<td width="500"><center><?php echo $row['srequest']; ?></center></td>
  										<td width="350"><center><?php echo $row['purpose']; ?></center></td>
                      <td width="350"><center><?php echo $row['pdate']; ?></center></td>

                      <td width="850" align="center">
                        <?php if($remarks1!='Cashier' && $remarks1 !='Releasing'){ ?>
                        <a class="btn btn-success"<a onclick="return confirm('Are you sure you want to create payment?');" href="cspr.php<?php echo '?srid='.$srid.'&sr='.$srequest.'&p='.$purpose; ?>"><i  class="fa fa-plus"></i></a>
                        <?php }?>
                        <a class="btn btn-success"<a onclick="return confirm('Are you sure you want to proceed?');" href="pus.php<?php echo '?srid='.$srid; ?>"><i  class="fa fa-calendar"></i></a>
                        <?php if($remarks1!='Cashier' && $remarks1 != 'Releasing'){ ?>
                        <a class="btn btn-default" <a onclick="return confirm('Are you sure you want to submit to cashier?');" href="ct.php<?php echo '?srid='.$srid; ?>"><i  class="fa fa-dollar"></i></a>
                        <?php }?>
                        <a class="btn btn-primary" href="vspt.php<?php echo '?srid='.$srid; ?>" ><i  class="fa fa-eye"></i></a>
                        <!--<a class="pull-right btn btn-primary" href="vspt.php<?php echo '?srid='.$srid; ?>" ><i  class="fa fa-list"></i></a>-->

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

            <?php


            include '../db_config/connection.php';

            if (isset($_POST['update'])){

          	$pickup = $_POST['pdate'];
            mysql_query("update s_request set pdate = '$pickup' where srid = '$srid' ")or die(mysql_error());

            ?>
            <script>
            	window.location = "vpsr.php";
            </script>
            <?php
            }

            ?>
        </section>
      </div>
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
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
</html>
