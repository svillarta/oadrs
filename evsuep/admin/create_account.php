<?php
include 'check_login.php';
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
      <center>
      <div class="row">
        <section class="col-lg-12">
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-person-cap"></i>
              <h3 class="box-title">Create New Account</h3>
            </div>
            <!-- Content-->
              <form action="nu.php" method="post">

						  <div class="form-row">
						<div class="form-group col-md-4" align="left">
						  <label>Last Name:</label>
						  <input type="text" class="form-control" name="lastname"  placeholder="Last Name" required>
						</div>
						<div class="form-group col-md-4"align="left">
						  <label >First Name:</label>
						   <input type="text" class="form-control" name="firstname"  placeholder="First Name" required>
						</div>
						<div class="form-group col-md-4 " align="left">
						  <label >Middle Initial:</label>
						    <input type="text" class="form-control" name="mi"  placeholder="Middle Initial" required>
						</div>
					  </div>

					<div class="form-row">
						<div class="form-group col-md-4" align="left">
						  <label >Address:</label>
						    <input type="text" class="form-control" name="address"  placeholder="Address" required>
						</div>

					   <div class="form-group col-md-2"align="left">
					   <label >Birthdate:</label>
					   <input type="date" name="dob" class="form-control" placeholder="Date of Birth">
					   </div>

					   <div class="form-group col-md-4" align="left">
						  <label >Email:</label>
              <input type="email" class="form-control" name="email"  placeholder="Email" required>
						</div>

					   <div class="form-group col-md-2">
                      </div>
					  </div>


            					<div class="form-row">
                                  <div class="form-group col-md-12">
                                    <hr>
                                  </div>
            					</div>


					  <div class="form-row">
					  <div class="form-group col-md-4"align="left">
						  <label >Position:</label>
						    <input type="text" class="form-control" name="position"  placeholder="Position" required>
						</div>
						<div class="form-group col-md-4"align="left">
						  <label >Department:</label>
						     <input type="text" class="form-control" name="department"  placeholder="Department" required>
						</div>

						  <div class="form-group col-md-4"align="left">
					  <label >User Type:</label>
                        <select class="form-control" name="utype" required>
                          <option value="" disabled selected>Select User Type</option>
                          <option value="Admin">Administrator</option>
                          <option value="Registrar">Registrar</option>
                          <option value="Cashier">Cashier</option>
                          <option value="Accounting">Accounting</option>
                        </select>
                      </div>
						</div>


					<div class="form-row">
                      <div class="form-group col-md-12">
                        <hr>
                      </div>
					</div>

					 <div class="form-row">
                      <div class="form-group col-md-3"align="left">
					  <label >UserName:</label>
					  <input type="text" class="form-control" name="username"  placeholder="Username" required>
                      </div>
					</div>
					<div class="form-row">
                      <div class="form-group col-md-3"align="left">
					  <label >Password:</label>
					  <input type="text" class="form-control" name="password"  placeholder="Password" required>
                      </div>
					</div>
					<div class="form-row">
                      <div class="form-group col-md-7">
                      </div>
					</div>
          <div class="box-footer clearfix">
            <button type="submit" class="pull-right btn btn-primary" name="newacc">Save
              <i class="fa fa-arrow-circle-up"></i></button>

            <a class="pull-right btn btn-default" href="index.php"><i  class="fa fa-arrow-left">Back</i></a>
          </div>


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
