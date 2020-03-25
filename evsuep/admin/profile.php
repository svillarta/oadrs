<?php
include 'check_login.php';
?>

<?php $uid = $_GET['uid']; ?>

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
              <h3 class="box-title">Update Account</h3>
            </div>
            <!-- Content-->

            <?php
            $uquery = mysql_query("select u.uid,u.username,u.password,u.utype,u1.lname,u1.fname,u1.mi,u1.bdate,u1.address,u1.email,u1.position,u1.department from users as u
            inner join user_info as u1 on u.uid = u1.uid where u.uid = '$uid'")or die(mysql_error());
            $count_u = mysql_num_rows($uquery);

            if($count_u > 0){
              $u_row = mysql_fetch_array($uquery);
              $uid = $u_row['uid'];
            ?>

              <form method="post">

						  <div class="form-row">
						<div class="form-group col-md-4" align="left">
						  <label>Last Name:</label>
						  <input value="<?php echo $u_row['lname']; ?>" type="text" class="form-control" name="lastname"  placeholder="Last Name" required>
						</div>
						<div class="form-group col-md-4"align="left">
						  <label >First Name:</label>
						   <input value="<?php echo $u_row['fname']; ?>" type="text" class="form-control" name="firstname"  placeholder="First Name" required>
						</div>
						<div class="form-group col-md-4 " align="left">
						  <label >Middle Initial:</label>
						    <input value="<?php echo $u_row['mi']; ?>" type="text" class="form-control" name="mi"  placeholder="Middle Initial" required>
						</div>
					  </div>

					<div class="form-row">
						<div class="form-group col-md-4" align="left">
						  <label >Address:</label>
						    <input value="<?php echo $u_row['address']; ?>" type="text" class="form-control" name="address"  placeholder="Address" required>
						</div>

					   <div class="form-group col-md-2"align="left">
					   <label >Birthdate:(MM/DD/YYYY)</label>
					   <input value="<?php echo $u_row['bdate']; ?>" type="text" name="dob" class="form-control" placeholder="Date of Birth">
					   </div>

					   <div class="form-group col-md-4" align="left">
						  <label >Email:</label>
              <input value="<?php echo $u_row['email']; ?>" type="email" class="form-control" name="email"  placeholder="Email" required>
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
						    <input value="<?php echo $u_row['position']; ?>" type="text" class="form-control" name="position"  placeholder="Position" required>
						</div>
						<div class="form-group col-md-4"align="left">
						  <label >Department:</label>
						     <input value="<?php echo $u_row['department']; ?>" type="text" class="form-control" name="department"  placeholder="Department" required>
						</div>

						  <div class="form-group col-md-4"align="left">
					  <label >User Type:</label>
                        <select class="form-control" name="utype" required>
                          <option value="<?php echo $u_row['utype']; ?>" disabled selected><?php echo $u_row['utype']; ?></option>
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
					  <input value="<?php echo $u_row['username']; ?>" type="text" class="form-control" name="username"  placeholder="Username" required>
                      </div>
					</div>
					<div class="form-row">
                      <div class="form-group col-md-3"align="left">
					  <label >Password:</label>
					  <input value="<?php echo $u_row['password']; ?>" type="text" class="form-control" name="password"  placeholder="Password" required>
                      </div>
					</div>
					<div class="form-row">
                      <div class="form-group col-md-7">
                      </div>
					</div>

          <?php
        }
          ?>
          <div class="box-footer clearfix">
            <button  class="pull-right btn btn-primary" name="update">Save
              <i class="fa fa-arrow-circle-up"></i></button>
              <a class="pull-right btn btn-default" href="view_account.php"><i  class="fa fa-arrow-left">Back</i></a>
          </div>


            </form>

            <?php
                    include '../db_config/connection.php';

                    if (isset($_POST['update'])){

                    $lastname = $_POST['lastname'];
                    $firstname = $_POST['firstname'];
                    $mi = $_POST['mi'];
                    $bdate = $_POST['dob'];
                    $address = $_POST['address'];
                    $email = $_POST['email'];
                    $position = $_POST['position'];
                    $department = $_POST['department'];
                    $utype = $_POST['utype'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];


                    mysql_query("update users set username = '$username', password = '$password' where uid = '$uid' ")or die(mysql_error());
                    mysql_query("update user_info set lname = '$lastname', fname = '$firstname' , mi = '$mi' , bdate = '$bdate', address = '$address', email = '$email', position = '$position', department = '$department' where uid = '$uid' ")or die(mysql_error());

                    ?>
                    <script>
                      window.location = "eua.php<?php echo '?uid='.$uid; ?>";
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
