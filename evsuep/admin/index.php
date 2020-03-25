<?php
include 'check_login.php';
include 'count_records.php';

?>
<!--Hearder-->
  <?php  include('header.php'); ?>
<!-- Main Sidebar-->
  <?php include('main_sidebar.php') ?>


  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard

      </h1>

    </section>

    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo number_format($registered_student); ?></h3>

              <p>Registered Account</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php echo number_format($pr); ?><sup style="font-size: 20px"></sup></h3>

              <p>Purchase Request</p>
            </div>
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
            <a href="error404.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		-->

      </div>
      <div class="row">
        <section class="col-lg-12">

          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-person-cap"></i>

              <h3 class="box-title">Welcome to EVSUOCC-Easy Payment System</h3>


            </div>
            <!-- Content-->




    </section>
  </div>
</section>
</div>

  <footer class="main-footer" class="pull-left" >

    <div class="pull-right hidden-xs">
      <b></b> <br>
    </div>
  </footer>



      </div>
    </div>
  </aside>

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
