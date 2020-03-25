<?php
include('check_login.php');
include('header.php');
include('main_sidebar.php')
?>
<div class="content-wrapper">
  <section class="content">
      <div class="row">
        <section class="col-lg-4">
        </section>
        <section class="col-lg-4">
         <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-person-cap"></i>
              <h3 class="box-title">Course</h3>
            </div>

            <!-- Content-->
            <form action="nc.php" method="post">
            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                <thead>
                  <tr>
                    <td align="right">Course:</td>
                    <td width="300"><input type="text" class="form-control" name="course"  placeholder="Course" required></td>
                  </tr>
                </thead>

           </table>
             <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-primary" name="nc" id="sendEmail">Create
              <i class="fa fa-arrow-circle-up"></i></button>
              <a class="pull-right btn btn-default" href="index.php"><i  class="fa fa-arrow-left">Back</i></a>
            </div>
            </form>
            <!--add department -->
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
