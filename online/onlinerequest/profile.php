
<?php
session_start();
$current_user = $_SESSION['username'];

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
 $myusername = $_SESSION['username'];
 $username = $_SESSION['username'];
 $password = $_SESSION['password'];

 include ('../db_config/connection.php');

  $sql = "SELECT * FROM users where username='$myusername' and password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {
          $current_user_id = $row['username'];
          $user_id = $row['uid'];
          $dep = $row['utype'];
      }

  } else {
         header("../?login_err=You must be Student");
  }


} else {
    header("location:../?login_err=You must login first");
}
$fullName = $_SESSION['fName'].' '.$_SESSION['mi'].'. '.$_SESSION['lName'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Material Dashboard PRO by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <link rel="canonical" href="../../../product/material-dashboard-pro.htm" />
  <!--  Social tags      -->
  
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="../../material/iconfont/material-icons.css" />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../../assets/css/material-dashboard.min.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../../assets/demo/demo.css" rel="stylesheet" />
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
  </script>
  <!-- End Google Tag Manager -->
</head>

<body class="">
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <i class="material-icons">timeline</i>
        </a>
        <a href="index.php" class="simple-text logo-normal">
         OADRS
        </a>
      </div>
      <div class="sidebar-wrapper ">
        <div class="user ">
          <div class="photo">
            <?php

            $uid = $_SESSION['uid'];
              $query = mysqli_query($conn,"SELECT * FROM profilepic WHERE uid = '$uid'");
              if (mysqli_num_rows($query)>0) {
                while ($row = mysqli_fetch_assoc($query)) {
                  $image = $row['image'];
                }
                $output = 'data:image/jpeg;base64,'.base64_encode($image ).'';
              ?>
                <img src="<?php echo $output ?>" class="picture-src" >
              <?php
              }else{
              ?>
                <img src="../../assets/img/default-avatar.png" >
              <?php
              }
            ?>
            
          </div>
          <div class="user-info ">
            <a data-toggle="collapse" href="#collapseExample" class="username" aria-expanded="true">
              <span>
                <b><?php echo $fullName; ?></b>
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse show" id="collapseExample">
              <ul class="nav">
                <li class="nav-item active">
                  <a class="nav-link" href="profile.php">
                    <span class="sidebar-mini"> MP </span>
                    <span class="sidebar-normal"> My Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="changePass.php">
                    <span class="sidebar-mini"> CP </span>
                    <span class="sidebar-normal"> Change Password </span>
                  </a>
                </li>
                
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item  ">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
              <i class="material-icons">control_point_duplicate</i>
              <p> Request
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="pagesExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="osr.php">
                    <span class="sidebar-mini"> CP </span>
                    <span class="sidebar-normal"> Create Request </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="vreq.php">
                    <span class="sidebar-mini"> VR </span>
                    <span class="sidebar-normal"> View Request </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">My Profile</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            
            <ul class="navbar-nav">
              
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="profile.php">Profile</a>
                  <a class="dropdown-item" href="changePass.php">Change Password</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="../logout.php">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->


      <!-- Content -->      
      <div class="content">
        <div class="container-fluid">
          <div class="col-md-8 col-12 mr-auto ml-auto">
            <!--      Wizard container        -->
            <div class="wizard-container">
              <div class="card card-wizard active" data-color="rose" id="wizardProfile">
                <form id="image_form" method="post" enctype="multipart/form-data">
                  <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                  <div class="card-header text-center">
                    <h3 class="card-title">
                      Build Your Profile
                    </h3>
                    <h5 class="card-description">This information will let us know more about you.</h5>
                  </div>
                  <div class="wizard-navigation">
                    <ul class="nav nav-pills">
                      <li class="nav-item" style="width: 33.3333%;">
                        <a class="nav-link active" href="#about" data-toggle="tab" role="tab">
                          About
                        </a>
                      </li>
                      <li class="nav-item" style="width: 33.3333%;">
                        <a class="nav-link" href="#account" data-toggle="tab" role="tab">
                          Account
                        </a>
                      </li>
                      <li class="nav-item" style="width: 33.3333%;">
                        <a class="nav-link" href="#address" data-toggle="tab" role="tab">
                          Departmaent and Course
                        </a>
                      </li>
                    </ul>
                    <div class="moving-tab" style="width: 139.177px; transform: translate3d(-8px, 0px, 0px); transition: transform 0s ease 0s;">
                          About
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="about">
                        <h5 class="info-text"> Let's start with the basic information (with validation)</h5>
                        <div class="row justify-content-center">
                          <div class="col-sm-4">
                            <div class="picture-container">
                              <div class="picture">
                                <?php
                                $uid = $_SESSION['uid'];
                                  $query = mysqli_query($conn,"SELECT * FROM profilepic WHERE uid = '$uid'");
                                  if (mysqli_num_rows($query)>0) {
                                    while ($row = mysqli_fetch_assoc($query)) {
                                      $image = $row['image'];
                                    }
                                    $output = 'data:image/jpeg;base64,'.base64_encode($image ).'';
                                  ?>
                                    <img src="<?php echo $output ?>" class="picture-src" id="wizardPicturePreview" title="">
                                  <?php
                                  }else{
                                  ?>
                                    <img src="../../assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title="">
                                  <?php
                                  }
                                ?>
                                
                                <input type="file" name="image" id="wizard-picture">
                              </div>
                              <h6 class="description">Choose Picture</h6>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">face</i>
                                </span>
                              </div>
                              <div class="form-group bmd-form-group">
                                <label for="fName" class="bmd-label-floating">First Name (required)</label>
                                <input type="text" class="form-control" id="fName" name="fName" required="" value="<?php echo $_SESSION['fName']; ?>">
                              </div>
                            </div>
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">face</i>
                                </span>
                              </div>
                              <div class="form-group bmd-form-group">
                                <label for="mName" class="bmd-label-floating">Middle Initial (required)</label>
                                <input type="text" class="form-control" id="mName" name="mName" required="" value="<?php echo $_SESSION['mi']; ?>">
                              </div>
                            </div>
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">face</i>
                                </span>
                              </div>
                              <div class="form-group bmd-form-group">
                                <label for="lName" class="bmd-label-floating">Last Name (required)</label>
                                <input type="text" class="form-control" id="lName" name="lName" required="" value="<?php echo $_SESSION['lName']; ?>">
                              </div>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <div class="tab-pane" id="account">
                        <h5 class="info-text"> What are you doing? (checkboxes) </h5>
                        
                        <div class="row ">
                          <div class="col-lg-12">
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">account_circle</i>
                                </span>
                              </div>
                              <div class="form-group bmd-form-group">
                                <label for="username" class="bmd-label-floating">username (required)</label>
                                <input type="text" class="form-control" id="username" name="username" required="" value="<?php echo $_SESSION['username']; ?>">
                              </div>
                            </div>
                          </div>
                           <div class="col-lg-12">
                              <div class="input-group form-control-lg">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="material-icons">settings_cell</i>
                                  </span>
                                </div>
                                <div class="form-group bmd-form-group">
                                  <label for="contactNo" class="bmd-label-floating">Contact number (required)</label>
                                  <input type="number" class="form-control" id="contactNo" name="contactNo" required="" value="<?php echo $_SESSION['contact']; ?>">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="input-group form-control-lg">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="material-icons">email</i>
                                  </span>
                                </div>
                                <div class="form-group bmd-form-group">
                                  <label for="email" class="bmd-label-floating">Email (required)</label>
                                  <input type="email" class="form-control" id="email" name="email" required="" aria-required="true" value="<?php echo $_SESSION['email']; ?>">
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="address">
                        <div class="row ">
                          <div class="col-sm-12">
                            <h5 class="info-text"> What is you Department and Course? </h5>
                          </div>
                          <div class="col-lg-6">
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">list_alt</i>
                                </span>
                              </div>
                              <div class="dropdown bootstrap-select">
                                <select class="selectpicker" name="department" id="department" data-size="7" data-style="select-with-transition" title="Select Department" tabindex="-98">
                                 
                                  <?php
                                  $query = mysqli_query($conn,"SELECT * FROM online_account WHERE uid ='$uid'");
                                  if (mysqli_num_rows($query)>0) {
                                    while ($row = mysqli_fetch_assoc($query)) {
                                     $department = $row['department'];
                                    }
                                  }

                                  $queryDep = "SELECT * FROM department";
                                  $resultDep = $conn->query($queryDep);
                                  
                                    while ($rowDep = $resultDep->fetch_assoc()) {
                                      $dep = $rowDep['dep'];
                                      if ($department ==$dep) {
                                        ?>
                                        <option selected="" value="<?php echo $dep; ?>"><?php echo $dep; ?></option>
                                        <?php
                                      }else{
                                        ?>
                                        <option value="<?php echo $dep; ?>"><?php echo $dep; ?></option>
                                        <?php
                                      }
                                      
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">donut_large</i>
                                </span>
                              </div>
                              <div class="dropdown form-group"  >
                                <select class="form-control" name="course" id="course">
                                <?php
                                $query = mysqli_query($conn,"SELECT * FROM online_account WHERE uid ='$uid'");
                                  if (mysqli_num_rows($query)>0) {
                                    while ($row = mysqli_fetch_assoc($query)) {
                                     $course = $row['course'];
                                    }
                                  }
                                 $queryDep = "SELECT * FROM course WHERE dep ='$department'";
                                  $resultDep = $conn->query($queryDep);
                                  
                                    while ($rowDep = $resultDep->fetch_assoc()) {
                                      $c = $rowDep['course'];
                                      if ($course == $c) {
                                        ?>
                                        <option selected="" value="<?php echo $c; ?>"><?php echo $c; ?></option>
                                        <?php
                                      }else{
                                        ?>
                                        <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                                        <?php
                                      }
                                      
                                    }?>
                                  
                                </select>
                              </div>
                            </div>
                          </div>
                          
                          
                          
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="mr-auto">
                      <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">
                    </div>
                    <div class="ml-auto">
                      <button class="pull-right btn btn-primary" type="button" id="loading" disabled=""><i class="fa fa-spinner fa-spin"></i> Loading...</span></button>
                      <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="Next">
                      <input type="submit" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" id="submit" value="Finish" style="display: none;">
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </form>
              </div>
            </div>
            <!-- wizard container -->
          </div>
        </div>
      </div>
      <!-- End Content -->





        <footer class="footer">
          <div class="container-fluid">
            <nav class="float-left">
              
            </nav>
            <div class="copyright float-right">
              &copy;
              <script>
                document.write(new Date().getFullYear())
              </script>, made with <i class="material-icons">favorite</i> by
              <a href="../../product/buy/bundle/www_creative-tim_default_6.html" target="_blank">Creative Tim</a> for a better web.
            </div>
          </div>
        </footer>
      </div>
    </div>
    <div class="fixed-plugin">
      <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
          <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
          <li class="header-title"> Sidebar Filters</li>
          <li class="adjustments-line">
            <a href="javascript:void(0)" class="switch-trigger active-color">
              <div class="badge-colors ml-auto mr-auto">
                <span class="badge filter badge-purple" data-color="purple"></span>
                <span class="badge filter badge-azure" data-color="azure"></span>
                <span class="badge filter badge-green" data-color="green"></span>
                <span class="badge filter badge-warning" data-color="orange"></span>
                <span class="badge filter badge-danger" data-color="danger"></span>
                <span class="badge filter badge-rose active" data-color="rose"></span>
              </div>
              <div class="clearfix"></div>
            </a>
          </li>
          <li class="header-title">Sidebar Background</li>
          <li class="adjustments-line">
            <a href="javascript:void(0)" class="switch-trigger background-color">
              <div class="ml-auto mr-auto">
                <span class="badge filter badge-black active" data-background-color="black"></span>
                <span class="badge filter badge-white" data-background-color="white"></span>
                <span class="badge filter badge-red" data-background-color="red"></span>
              </div>
              <div class="clearfix"></div>
            </a>
          </li>
          <li class="adjustments-line">
            <a href="javascript:void(0)" class="switch-trigger">
              <p>Sidebar Mini</p>
              <label class="ml-auto">
                <div class="togglebutton switch-sidebar-mini">
                  <label>
                    <input type="checkbox">
                    <span class="toggle"></span>
                  </label>
                </div>
              </label>
              <div class="clearfix"></div>
            </a>
          </li>
          <li class="adjustments-line">
            <a href="javascript:void(0)" class="switch-trigger">
              <p>Sidebar Images</p>
              <label class="switch-mini ml-auto">
                <div class="togglebutton switch-sidebar-image">
                  <label>
                    <input type="checkbox" checked="">
                    <span class="toggle"></span>
                  </label>
                </div>
              </label>
              <div class="clearfix"></div>
            </a>
          </li>
          <li class="header-title">Images</li>
          <li class="active">
            <a class="img-holder switch-trigger" href="javascript:void(0)">
              <img src="../assets/img/sidebar-1.jpg" alt="">
            </a>
          </li>
          <li>
            <a class="img-holder switch-trigger" href="javascript:void(0)">
              <img src="../assets/img/sidebar-2.jpg" alt="">
            </a>
          </li>
          <li>
            <a class="img-holder switch-trigger" href="javascript:void(0)">
              <img src="../assets/img/sidebar-3.jpg" alt="">
            </a>
          </li>
          <li>
            <a class="img-holder switch-trigger" href="javascript:void(0)">
              <img src="../assets/img/sidebar-4.jpg" alt="">
            </a>
          </li>
          <li class="button-container">
            <a href="../../product/material-dashboard-pro.htm" target="_blank" class="btn btn-rose btn-block btn-fill">Buy Now</a>
            <a href="../docs/2.1/getting-started/introduction.html" target="_blank" class="btn btn-default btn-block">
              Documentation
            </a>
            <a href="../../product/material-dashboard_2.htm" target="_blank" class="btn btn-info btn-block">
              Get Free Demo!
            </a>
          </li>
          <li class="button-container github-star">
            <a class="github-button" href="https://github.com/creativetimofficial/ct-material-dashboard-pro" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
          </li>
          <li class="header-title">Thank you for 95 shares!</li>
          <li class="button-container text-center">
            <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>
            <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button>
            <br>
            <br>
          </li>
        </ul>
      </div>
    </div>
    <!--   Core JS Files   -->
    <!--   Core JS Files   -->
  <script src="../../assets/js/core/jquery.min.js"></script>
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="../../assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="../../assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="../../assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="../../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../../assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../../assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="../../assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="../../assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="../../assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../../assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="../../assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Chartist JS -->
  <script src="../../assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/material-dashboard.min.js" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="../../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <!-- Sharrre libray -->
  <script src="../../assets/demo/jquery.sharrre.js"></script>
  <script>
    $(document).ready(function() {


      $('#facebook').sharrre({
        share: {
          facebook: true
        },
        enableHover: false,
        enableTracking: false,
        enableCounter: false,
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('facebook');
        },
        template: '<i class="fab fa-facebook-f"></i> Facebook',
        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
      });

      $('#google').sharrre({
        share: {
          googlePlus: true
        },
        enableCounter: false,
        enableHover: false,
        enableTracking: true,
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('googlePlus');
        },
        template: '<i class="fab fa-google-plus"></i> Google',
        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
      });

      $('#twitter').sharrre({
        share: {
          twitter: true
        },
        enableHover: false,
        enableTracking: false,
        enableCounter: false,
        buttons: {
          twitter: {
            via: 'CreativeTim'
          }
        },
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('twitter');
        },
        template: '<i class="fab fa-twitter"></i> Twitter',
        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
      });

      // Facebook Pixel Code Don't Delete
      ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window,
        document, 'script', '//connect.facebook.net/en_US/fbevents.js');

      try {
        fbq('init', '111649226022273');
        fbq('track', "PageView");

      } catch (err) {
        console.log('Facebook Track Error:', err);
      }

    });
  </script>
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
  </noscript>
  <script>
    $(document).ready(function() {
      // Initialise the wizard
      demo.initMaterialWizard();
      setTimeout(function() {
        $('.card.card-wizard').addClass('active');
      }, 600);
    });
  </script>
  </body>

</html>
<script type="text/javascript">
  
  $('#department').on('change',function(){
    var dep = $('#department').val();

    $.ajax({  
        url:"../ajax/course.php",  
        type:"post",  
        data:{dep:dep},
        beforeSend: function(){
         
        },    
        success:function(dataa){ 
          $('#course').html(dataa);

        }
    });
  });
</script>
<script type="text/javascript">
$('#loading').hide();
$('#image_form').submit(function(event){
  event.preventDefault();
  var image_name = $('#wizard-picture').val();
  var fName = $('#fName').val();
  var mName = $('#mName').val();
  var lName = $('#lName').val();
  var username = $('#username').val();
  var contactNo = $('#contactNo').val();
  var email = $('#email').val();
  var department = $('#department').val();
  var course = $('#course').val();

  if (fName == '') {
    Swal.fire(
          'WARNING!!',
          'Name Field is empty',
          'info'
        )
  }else if (mName == '') {
    Swal.fire(
          'WARNING!!',
          'Middle initial Field is empty',
          'info'
        )
  }else if (lName == '') {
    Swal.fire(
          'WARNING!!',
          'Last name Field is empty',
          'info'
        )
  }else if (username == '') {
    Swal.fire(
          'WARNING!!',
          'Username Field is empty',
          'info'
        )
  }else if (contactNo == '') {
    Swal.fire(
          'WARNING!!',
          'Contact number Field is empty',
          'info'
        )
  }else if (email == '') {
    Swal.fire(
          'WARNING!!',
          'E-mail Field is empty',
          'info'
        )
  }else if (email == '') {
    Swal.fire(
          'WARNING!!',
          'E-mail Field is empty',
          'info'
        )
  }else{
    if(image_name == ''){
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to update without updating you images profile picture?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url:"../ajax/profileData.php",
            method:"POST",
            data:{fName:fName,mName:mName,lName:lName,username:username,contactNo:contactNo,email:email,department:department,course:course},
            
            beforeSend: function(){
              $('#loading').show();
              $('#submit').hide();
            },  
            success:function(data){
              $('#loading').hide();
              $('#submit').show();
              if (data =='success') {
                Swal.fire(
                    'SUCCESS!',
                    'Your file has been successfully updated.',
                    'success'
                  )
              window.location.replace("");
              }else{
                Swal.fire(
                    'ERROR',
                    data,
                    'error'
                  )
              }
              
              
            }
          });


          
        }
      })
      return false;
    }else{
      var extension = $('#wizard-picture').val().split('.').pop().toLowerCase();
      if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){
        alert("Invalid Image File");
        $('#wizard-picture').val('');
        return false;
     }else{
      $.ajax({
        url:"../ajax/profilePic.php",
        method:"POST",
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data){
          
         
        }
      })
      
      $.ajax({
          url:"../ajax/profileData.php",
          method:"POST",
          data:{fName:fName,mName:mName,lName:lName,username:username,contactNo:contactNo,email:email,department:department,course:course},
          beforeSend: function(){
            $('#loading').show();
            $('#submit').hide();
          },  
          success:function(data){
            $('#loading').hide();
            $('#submit').show();
           if (data == 'success') {
              Swal.fire(
                    'SUCCESS!',
                    'Your file has been successfully updated.',
                    'success'
                  )
              window.location.replace("");
            }else{
               Swal.fire(
                    'ERROR',
                    data,
                    'error'
                  )
            }
          }
        })

      
     }
    }
  }


  
});
</script>