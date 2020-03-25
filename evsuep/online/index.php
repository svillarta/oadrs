<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EVSUEP | Sign in</title>
  <link rel="icon" href="./dist/img/evsu.jpg">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="./">Online EVSUOCC Registrar Request</a>
  </div>
<?php
if(isset($_GET['login_err'])) {
	$error = $_GET['login_err'];
	print '<center><b style="color:red;">';
	echo"$error";
	print '</b></center>';
}
?>

<?php
if(isset($_GET['message'])) {
	$error = $_GET['message'];
	print '<center><b style="color:green;">';
	echo"$error";
	print '</b></center>';
}
?>
  <div class="login-box-body">
    <p class="login-box-msg">Please sign in </p>

    <form action="build/login.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="User Name" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        <a href="r.php" class="btn btn-default btn-block btn-flat">Sign Up</a>
      </div>


    </form>
    <p align="Left"><a href="error404.php">I forgot my password</a></p><br>


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
</html>
