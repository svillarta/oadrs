<?php
session_start();
$current_user = $_SESSION['fullname'];
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
 $myusername = $_SESSION['username'];

 include ('../db_config/connection.php');

$sql = "SELECT * FROM users where username='$myusername' and utype='Registrar'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $current_user_id = $row['username'];
        $user_id = $row['uid'];
        $dep = $row['utype'];
    }
} else {
       header("../?login_err=You must be Administrator");
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
    OADRS
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <link rel="canonical" href="../../../product/material-dashboard-pro.htm" />
  <!--  Social tags      -->
  
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="../../material/iconfont/material-icons.css" />
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
      <div class="sidebar-wrapper">
        <div class="user">
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
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                <b><?php echo $fullName; ?></b>
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item ">
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
          <li class="nav-item active">
            <a class="nav-link" data-toggle="collapse" aria-expanded="true" href="#pagesExamples">
              <i class="material-icons">control_point_duplicate</i>
              <p> Releasing
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse show" id="pagesExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="releasing.php">
                    <span class="sidebar-mini"> RR </span>
                    <span class="sidebar-normal"> Ready to Release </span>
                  </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="released.php">
                    <span class="sidebar-mini"> AR </span>
                    <span class="sidebar-normal"> Already Released</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#report">
              <i class="material-icons">report</i>
              <p> Reports
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="report">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="approvedReport.php">
                    <span class="sidebar-mini"> AR </span>
                    <span class="sidebar-normal"> Approved Reports </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="releasedReport.php">
                    <span class="sidebar-mini"> RR </span>
                    <span class="sidebar-normal"> Released Reports</span>
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
            <a class="navbar-brand" href="#pablo">Released Files</a>
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
                  <a class="dropdown-item" href="logout.php">Log out</a>
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
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon row" >
                  <div class="col-md-6" id="addStudent" style="cursor: pointer;">
                    <div class="card-icon">
                      <i class="material-icons">person_add</i>
                    </div>
                    <h4 class="card-title">Add Student</h4>
                  </div>
                  <div class="col-md-6" style="color: gray; ">
                    <form action="" method="POST" id="monthlyForm">
                        
                      
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="panel panel-default">
                          <div class="panel-body">
                            Report Date
                          </div>
                          <div class="panel-footer">
                            <input type="month" name="reportMonhtly" id="reportMonhtly" class="form-control" required="">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="panel panel-default">
                          <div class="panel-body">
                            If you want to save the file
                          </div>
                          <div class="panel-footer">
                            <input type="submit" name=""  class="btn btn-primary btn-block btn-fill btn-sm" value="Save As">
                          </div>
                        </div>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
                <div class="card-body">

                  <div class="toolbar row">

                    
                  </div><hr>
                    <div class="material-datatables">
                      <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                          <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>E-mail</th>
                            <th>Contact No.</th>
                            <th>Department</th>
                            <th>Requested File(s)</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>E-mail</th>
                            <th>Contact No.</th>
                            <th>Department</th>
                            <th>Requested File(s)</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                       <tbody>
                       </tbody>
                      </table>
                    </div>
                  
                       
                      
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
          </div>
          <!-- end row -->
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

    <!-- Reporting and pringting -->
    <!--page Count-->
<div class="modal fade" id="monthlyReportPrinting" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h4 class="modal-title" id="gridSystemModalLabel"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="material-datatables">
          <table id="datatablesReport" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="display: none;">
            <thead>
              <tr>
                <th>Student ID</th>
                <th>Full Name</th>
                <th>E-mail</th>
                <th>Contact No.</th>
                <th>Department</th>
                <th>Requested File(s)</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Student ID</th>
                <th>Full Name</th>
                <th>E-mail</th>
                <th>Contact No.</th>
                <th>Department</th>
                <th>Requested File(s)</th>
              </tr>
            </tfoot>
           <tbody>
           </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer row">
        <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



    <!--page Count-->
<div class="modal fade" id="countPage" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h4 class="modal-title" id="gridSystemModalLabel"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 ">
              <p style="background-color: #D1D0CE">File Requested<code id="srequest"></code></p>
              <hr>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 input-group " id="reqFile">

            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer row">
        <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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
  <script src="../../assets/js/plugins/jquery.dataTables.min.js"></script>
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
  
  </body>
<!-- <button type="button" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="Edit Task">
                                <i class="material-icons">edit</i>
                              <div class="ripple-container"></div></button> -->
</html>
<script type="text/javascript">
  //first load
      function firstLoad(){
        var table = $('#datatables').DataTable({
          "pagingType": "full_numbers",
          "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
          ],
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records"
          },

          "ajax":{
            "url":"../ajax/firstLoad2.php",
            "dataSrc":""
          },
          "columns":[
            {"data":"sid"},
            {"data":"fullName"},
            {"data":"email"},
            {"data":"contactno"},
            {"data":"depCourse"},
            {"data": "reqFiles",
              "render": function (data, type, row, meta){
                return type === 'display' && data.length >  40 ?
                  '<span title="'+data+'">'+data.substr(0,35)+'...</span>':
                  data;
              }
            },
            {"data": "sid",
              "render": function (data, type, row, meta){
                return '<a href="#" rel="tooltip" title="" class="btn btn-link btn-warning btn-just-icon show" data-original-title="View Files"' 
                          +'fullName="'+row.fullName+'"'
                          +' reqFiles="'+row.reqFiles+'">'
                          +'<i class="material-icons">dvr</i></a>';
              }

            }
          ]
        });

      // // show a record
      table.on('click', '.show', function(e) {
         fullName = jQuery(this).attr('fullName');
         reqFiles = jQuery(this).attr('reqFiles');
        $('#gridSystemModalLabel').html('<span>'+fullName+'</span>');
        $('#reqFile').html('<span>'+reqFiles+'</span>');

        $('#countPage').modal('show');
        e.preventDefault();
      });
     }
  firstLoad();

  //count TOR
  function TOR() {
    $.ajax({
         url:"../ajax/TOR1.php",
          success:function(data3){
            $('#TOR-load').html(data3);
         }
       });
  }
  TOR();
  //count GOODMORAL
  function GOODMORAL() {
    $.ajax({
         url:"../ajax/GOODMORAL1.php",
          success:function(data3){
            $('#GOODMORAL-load').html(data3);
         }
       });
  }
  GOODMORAL();

  //count CERTIFICATE OF GRADES
  function COG() {
    $.ajax({
         url:"../ajax/COG1.php",
          success:function(data3){
            $('#COG-load').html(data3);
         }
       });
  }
  
  COG();
HD();
TC();

  //count HONORABLE DISMISSAL
  function HD() {
    $.ajax({
         url:"../ajax/HD1.php",
          success:function(data3){
            $('#HD-load').html(data3);
         }
       });
  }
  
  COG();
HD();
TC();

  //count TRANSFER CODINTIAL
  function TC() {
    $.ajax({
         url:"../ajax/TC1.php",
          success:function(data3){
            $('#TC-load').html(data3);
         }
       });
  }
  
  COG();
HD();
TC();
</script>
<script type="text/javascript">
  //approve the pending request
  $(document).on('click','.release',function(envent){
    event.preventDefault();
    sid      = jQuery(this).attr('sid');
   
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({  
              url:"../ajax/release.php",
              type:'post',
              data:{sid:sid},
              beforeSend: function(){
               
              },    
              success:function(dataa){ 
                if (dataa=='success') {
                  Swal.fire({
                        icon: 'success',
                        title: 'SUCCESS',
                        text: 'File has been released',
                        footer: ''
                      })
                  firstLoad();
                }else{
                  Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: dataa,
                        footer: ''
                      })
                  firstLoad();
                }
              }
          });

        }
      })
  });
</script>
<script type="text/javascript">
  //page count save
  //approve the pending request
  $('#loading').hide();
  $('#pageSave').show();
  $(document).on('click','#pageSave',function(envent){
    event.preventDefault();
    var srid = $('#srid').val();
    var sid = $('#sid').val();
    var pageCount = $('#pageCount').val();
    $.ajax({  
        url:"../ajax/reqToCasher.php",
        type:'post',
        data:{srid:srid,sid:sid,pageCount:pageCount},
        beforeSend: function(){
          $('#loading').show();
          $('#pageSave').hide();
          $('#close').hide();
        },    
        success:function(dataa){ 
          $('#loading').hide();
          $('#pageSave').show();
          $('#close').show();
          $('#countPage').modal('hide');
          firstLoad();
          if (dataa =='success') {
            Swal.fire({
                  icon: 'success',
                  title: 'SUCCESS',
                  text: 'The request is ready to paid',
                  footer: ''
                })
            firstLoad();

          }else{
            Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Somethning wrong',
                  footer: dataa
                })
          }
          
            
        }
    });
    // Swal.fire({
    //     title: 'Are you sure?',
    //     text: "You won't be able to revert this!",
    //     type: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes, update it!'
    //   }).then((result) => {
    //     if (result.value) {


    //     }
    //   })
  });
</script>

<script type="text/javascript">
  //select request
  $(document).on('click','.requesting',function(envent){
    event.preventDefault();
    var requesting = jQuery(this).attr('request');
    $.ajax({  
        url:"../ajax/requesting1.php",
        type:'post',
        data:{requesting:requesting},
        beforeSend: function(){
          
        },    
        success:function(dataa){ 
          $('#accordion').html(dataa);
        }
    });
  });
  
</script>
<script type="text/javascript">
  //search
   $(document).on('keyup','#search',function(envent){
    event.preventDefault();
    var search = $('#search').val();
    $.ajax({  
        url:"../ajax/searching1.php",
        type:'post',
        data:{search:search},
        beforeSend: function(){
          
        },    
        success:function(dataa){ 
          $('#accordion').html(dataa);
        }
    });
  });
</script>
<script type="text/javascript">
  //view 
  $(document).on('click','.view',function(envent){
    event.preventDefault();
    var srid = jQuery(this).attr('srid');
    alert(srid);
  });
</script>
<script type="text/javascript">
  $(document).on('click','#addStudent',function(envent){
    window.location.replace("addStudent.php");
  });


  // monthly reporting session
  $(document).on('change', '#reportMonhtly', function(event){
    var month = $('#reportMonhtly').val();
    $('#datatables').DataTable().destroy();
    var table = $('#datatables').DataTable({
          "pagingType": "full_numbers",
          "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
          ],
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records"
          },

          "ajax":{
            "url":"../ajax/monthlyReport.php",
            "type": "POST",
            "data": {month:month},
            "dataSrc":""
          },
          "columns":[
            {"data":"sid"},
            {"data":"fullName"},
            {"data":"email"},
            {"data":"contactno"},
            {"data":"depCourse"},
            {"data": "reqFiles",
              "render": function (data, type, row, meta){
                return type === 'display' && data.length >  40 ?
                  '<span title="'+data+'">'+data.substr(0,35)+'...</span>':
                  data;
              }
            },
            {"data": "sid",
              "render": function (data, type, row, meta){
                return '<a href="#" rel="tooltip" title="" class="btn btn-link btn-warning btn-just-icon show" data-original-title="View Files"' 
                          +'fullName="'+row.fullName+'"'
                          +' reqFiles="'+row.reqFiles+'">'
                          +'<i class="material-icons">dvr</i></a>';
              }

            }
          ]
        });

  });

  $(document).on('submit','#monthlyForm', function(event){
    event.preventDefault();
     var month = $('#reportMonhtly').val();
     $('#datatablesReport').DataTable({
          "bFilter": false,
          "bInfo": false,
          "paging": false,
          "pagingType": "full_numbers",
          "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
          ],
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records"
          },
          dom: 'lBfrtip',
          button: [
            'excel', 'csv', 'pdf', 'copy'
          ],
          "ajax":{
            "url":"../ajax/monthlyReport.php",
            "type": "POST",
            "data": {month:month},
            "dataSrc":""
          },
          "columns":[
            {"data":"sid"},
            {"data":"fullName"},
            {"data":"email"},
            {"data":"contactno"},
            {"data":"depCourse"},
            {"data": "reqFiles"}
          ]
        });
    $('#monthlyReportPrinting').modal('show');
  });
</script>