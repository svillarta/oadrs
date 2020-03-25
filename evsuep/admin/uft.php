<?php
include 'check_login.php';
?>

<?php $ftid = $_GET['ftid']; ?>

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
        <section class="col-lg-6">

         <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-person-cap"></i>
              <h3 class="box-title">Update Fee</h3>
            </div>

            <?php
            $ftquery = mysql_query("select * from fee_type as ft where ftid = '$ftid' ")or die(mysql_error());
            $count_ft = mysql_num_rows($ftquery);

            if($count_ft > 0){
              $ft_row = mysql_fetch_array($ftquery);
              $ftid = $ft_row['ftid'];
            ?>

            <!-- Content-->
              <form method="post">
                     <div class="form-row" >
						<div class="form-group col-md-1" >

					  </div>


					  	<div class="form-row">
						<div class="form-group col-md-5" align="left">
						  <label >Fee Description:</label>
						    <input value="<?php echo $ft_row['fdesc']; ?>" type="text" class="form-control" name="fd"  placeholder="Fee Description" required>
						</div>

					   <div class="form-group col-md-4"align="left">
					   <label >Amount:</label>
					    <input value="<?php echo $ft_row['amount']; ?>" type="text" class="form-control" name="fa"  placeholder="Amount" required>
					   </div>

					   <div class="form-group col-md-4">
                      </div>
					  </div>

            <?php
          }
            ?>
            <div class="box-footer clearfix">
              <button  class="pull-right btn btn-primary" name="update"><i class="fa fa-save">Update</i></button>
              <a class="pull-right btn btn-default" href="vft.php"><i  class="fa fa-arrow-left">Back</i></a>
            </div>

					</div>

            </form>

            <!--Update Query MYSQL -->
            <?php
                    include '../db_config/connection.php';

                    if (isset($_POST['update'])){

                    $fd = $_POST['fd'];
                    $fa = $_POST['fa'];


                    mysql_query("update fee_type set fdesc = '$fd', amount = '$fa' where ftid = '$ftid' ")or die(mysql_error());
                    ?>
                    <script>
                      window.location = "uft.php<?php echo '?ftid='.$ftid; ?>";
                    </script>
                    <?php
                    }

                    ?>


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
