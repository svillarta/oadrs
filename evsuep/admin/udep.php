<?php
include('check_login.php');
$depid = $_GET['depid'];
include('header.php');
include('main_sidebar.php');
 ?>
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <section class="col-lg-4"></section>
        <section class="col-lg-4">
         <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-person-cap"></i>
              <h3 class="box-title">Department</h3>
            </div>
            <?php
            $depquery = mysql_query("select * from department where depid = '$depid' ")or die(mysql_error());
            $count_dep = mysql_num_rows($depquery);
            if($count_dep > 0){
              $dep_row = mysql_fetch_array($depquery);
              $depid = $dep_row['depid'];
            ?>
            <!-- Content-->
              <form method="post">

                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                    <thead>
                      <tr>
                        <td align="right">Department:</td>
                        <td width="300"><input value="<?php echo $dep_row['dep']; ?>" type="text" class="form-control" name="dep"  placeholder="Departmnet" required></td>
                      </tr>
                    </thead>

               </table>
                 <div class="box-footer clearfix">
                   <button  class="pull-right btn btn-primary" name="update"><i class="fa fa-save">Update</i></button>
                   <a class="pull-right btn btn-default" href="vdep.php"><i  class="fa fa-arrow-left">Back</i></a>
                </div>
                <?php
                  }
                ?>
			         </div>
            </form>

            <!--Update Query MYSQL -->
            <?php
              include '../db_config/connection.php';

              if (isset($_POST['update'])){
                $dep = $_POST['dep'];
                mysql_query("update department set dep = '$dep' where depid = '$depid' ")or die(mysql_error());

                echo "<script>
                alert('Successfully Updated!');
                window.location = 'udep.php?depid=$depid';
                </script>";
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
