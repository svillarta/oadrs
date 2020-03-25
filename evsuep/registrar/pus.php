<?php
include 'check_login.php';
$srid = $_GET['srid'];
?>

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
        <section class="col-lg-5">

         <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-person-cap"></i>
              <h3 class="box-title">Create Schedule for Pick-up of Documents</h3>
            </div>

            <?php
            $pus_query = mysql_query("select pdate from s_request where srid = '$srid' ")or die(mysql_error());
            $count_pus = mysql_num_rows($pus_query);

            if($count_pus > 0){
              $pus_row = mysql_fetch_array($pus_query);
            ?>

            <!-- Content-->
              <form method="post">
                     <div class="form-row" >
						<div class="form-group col-md-4" >

					  </div>


					  	<div class="form-row">
						<div class="form-group col-md-4" align="left">
						  <label >Date:</label>
					    <input value="<?php echo $pus_row['pdate']; ?>" type="date" class="form-control" name="pdate"  required>
						</div>
            <div class="form-group col-md-10">
           </div>
					  </div>



            <?php
          }
            ?>
            <div class="box-footer clearfix">
              <button  class="pull-right btn btn-primary" name="update">Update
                <i class="fa fa-arrow-circle-up"></i></button>
                <a class="pull-right btn btn-default" href="vpsr.php"><i  class="fa fa-arrow-left"></i></a>
            </div>

					</div>

            </form>

            <!--Update Query MYSQL -->
            <?php
                    include '../db_config/connection.php';

                    if (isset($_POST['update'])){

                    $pdate = $_POST['pdate'];

                    mysql_query("update s_request set pdate = '$pdate' where srid = '$srid' ")or die(mysql_error());
                    ?>
                    <script>
                      window.location = "vpsr.php";
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
