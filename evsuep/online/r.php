<?php
//include 'check_login.php';
include('header.php');
?>

  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>

    <link rel="icon" href="../dist/img/evsu.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  </head>
  <body class="hold-transition login-page">
  <div class="login-box">

    <div class="login-box-body">
      <p class="login-box-msg">Please Register </p>

      <form action="rsa.php" method="post">
        <div class="form-group has-feedback">
          <input type="text" name="sid" class="form-control" placeholder="Student ID" required>
          <span class="glyphicon glyphicon-qrcode form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" name="lastname" class="form-control" placeholder="Lastname" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div><div class="form-group has-feedback">
          <input type="text" name="firstname" class="form-control" placeholder="Firstname" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div><div class="form-group has-feedback">
          <input type="text" name="mi" class="form-control" placeholder="Middle Initial" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div><div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="tel"  maxlength="10" name="contactno" class="form-control" placeholder="10 Digit Cellphone Number" required>
          <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="User Name" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <button type="submit" name="regacc" class="btn btn-success btn-block btn-flat">Register</button>
            <a href="index.php" class="btn btn-default btn-block btn-flat">Go Back</a>
        </div>


      </form>


    </div>
  </div>

  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
  </body>
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
