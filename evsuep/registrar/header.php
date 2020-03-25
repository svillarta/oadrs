
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Online Dashboard</title>

  <link rel="icon" href="../dist/img/evsu.jpg">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="../../sweetalert/dist/sweetalert2.min.css">
  <style type="text/css">
    .nav1{
      cursor: pointer;
      border: 1px solid gray;
    }
   .notification {
      position: relative;
      display: inline-block;
    }
    .notification .badge {
      position: absolute;
      top: -20px;
      right: -25px;
    }
   
    .fa-stack[data-count]:after{
      position:absolute;
      right:0%;
      top:1%;
      
      padding:.6em;
      border-radius:999px;
      line-height:.75em;
      color: white;
      background:rgba(255,0,0,.85);
      text-align:center;
      min-width:1em;
      font-weight:bold;
  }
 .badge1[data-count]:after{
      position:absolute;
      right:0%;
      top:1%;
      content: attr(data-count);
      font-size:70%;
      padding:.5em;
      border-radius:999px;
      line-height:.75em;
      color: white;
      background:rgba(255,0,0,.85);
      text-align:center;
      min-width:1em;
      font-weight:bold;
  }
  .badge2[data-count]:after{
      position:absolute;
      right:0%;
      top:1%;
      content: attr(data-count);
      font-size:43%;
      padding:.6em;
      border-radius:999px;
      line-height:.75em;
      color: white;
      background:rgba(255,0,0,.85);
      text-align:center;
      min-width:1em;
      font-weight:bold;
  }

  
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="index.php" class="logo">
      <span class="logo-lg "><b>OEPS</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only ">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          
          <li id="fat-menu" class="user user-menu dropdown ">
              <a id="drop3" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
              <div class="pull-left">
                <img src="../profile_images/asd.png" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
              </div>
                 <?php echo $current_user; ?>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
               <li class="user-body">
               
                <div class="center">
                  <?php
                    $fullname  = $_SESSION['fName'];
                    $fullname  .= ' '.$_SESSION['mi'];
                    $fullname  .= '. '.$_SESSION['lName'];
                    echo $fullname;  
                  ?>
                </div>
                
              </li>
              <li class="user-body">

                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat btn-sm">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat btn-sm">Sign out</a>
                </div>
              </li>

            </ul>
            </li>

        </ul>
      </div>
    </nav>
  </header>
