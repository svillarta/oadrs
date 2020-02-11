<?php
include 'check_login.php';

?>

<?php $srid = $_GET['srid']; ?>

  <?php  include('header.php'); ?>
  <?php include('main_sidebar.php') ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
      </h1>

    </section>
    <section class="content">
      <div class="row">
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
              <th><center>Action</center></th>
             </tr>
          </thead>
          <tbody>

            <?php
                 include '../db_config/connection.php';

                $sql = "SELECT * FROM s_payment where srid='$srid' order by sdate asc";
                       $result = $conn->query($sql);
                        $total=0;
                       if ($result->num_rows > 0) {

                        while($row = $result->fetch_assoc()) {
                          $spid = $row['spid'];
                          $ftid = $row['ftid'];
                          $date = $row['sdate'];
                          $amount = $row['samount'];
                          $total = $amount + $total;
                          $remarks = $row['remarks'];
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
              <?php if ($remarks == 'unpaid') {?>
              <td width="40">
              <a class="btn btn-danger"<a onclick="return confirm('Are you sure you want to delete transaction ?');" href="dirp.php<?php echo '?spid='.$spid.'&srid='.$srid; ?>"><i  class="fa fa-trash"></i></a>
              </td>
            <?php } ?>
              </tr>
              <?php }
                }else {
                      }
                $conn->close();
               ?>
               <tr>
                 <td colspan="3" align ="right">Total Amount:</td>
                 <td><center><?php echo $total; ?></center></td>
               </tr>

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
