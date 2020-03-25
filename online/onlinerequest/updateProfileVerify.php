<?php

include ('../db_config/connection.php');
include ('check_login.php');


?>
<!--Hearder-->
  <?php  include('header.php'); ?>
<!-- Main Sidebar-->
  <?php include('main_sidebar.php'); ?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Verification
      </h1>

    </section>

    <section class="content">
      <center>
      <div class="row">
        <section class="col-lg-12">
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-person-cap"></i>
              <h3 class="box-title">Password</h3>
            </div>
            <!-- Content-->
            <form>
              <?php

                include("../db_config/connection.php");
                $uid         = $_POST['uid']; 
                $lName       = $_POST['lName']; 
                $fName       = $_POST['fName'];
                $mi          = $_POST['mi'];
                $email       = $_POST['email'];
                $contactno   = $_POST['no'];
                $department  = $_POST['department'];
                $course      = $_POST['course'];

                function randStrGen($len){
                    $result = "";
                    $chars = "abcdefghijklmnopqrstuvwxyz-0123456789";
                    $charArray = str_split($chars);
                    for($i = 0; $i < $len; $i++){
                      $randItem = array_rand($charArray);
                      $result .= "".$charArray[$randItem];
                    }
                    return $result;

                }
                // Usage example
                $randstr = randStrGen(5);// for password

               
                $randstr1 = randStrGen(5);// for password

                ?>
                <input type="hidden" name="uid"        id="uid" value="<?php echo $uid; ?>">
                <input type="hidden" name="lName"      id="lName" value="<?php echo $lName; ?>">
                <input type="hidden" name="fName"      id="fName" value="<?php echo $fName; ?>">
                <input type="hidden" name="mi"         id="mi" value="<?php echo $mi; ?>">
                <input type="hidden" name="email"      id="email"value="<?php echo $email; ?>">
                <input type="hidden" name="contactno"  id="contactno" value="<?php echo $contactno; ?>">
                <input type="hidden" name="department" id="department" value="<?php echo $department; ?>">
                <input type="hidden" name="course"     id="course" value="<?php echo $course; ?>">

                
                <br>
                <div id="alert">
                  
                </div>
                <div class="col-md-6 col-md-offset-3" align="center"><br>
                  <input type="text"  name="password" id="password" class="form-control" placeholder="Enter Password">
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <hr>
                    </div>
                </div>
                <div class="box-footer clearfix">
                  <button type="submit" class="pull-right btn btn-primary" name="osr" id="update" style="margin: 1px;">Submit
                    <i class="fa fa-arrow-circle-up"></i>
                  </button>

                  <a href="profile.php" type="submit" class="pull-right btn btn-danger" name="osr"  style="margin: 1px;">Cancel
                    <i class="fa fa-arrow-circle-up"></i>
                  </a>
                </div>
                
            </form>
        </section>
      </div>
    </center>
  </section>

  <section>
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="no">&times;</span></button>
            <h4 class="modal-title">ALERT!</h4>
          </div>
          <div class="modal-body">
            <p>Do you want to procceed this proccess?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default no">No</button>
            <button type="button" class="btn btn-primary" id="yes">Yes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </section>

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
<script src="../dist/js/sweetalert2.js"></script>
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
$('#myModal').modal('show');
var a = 0;
var b = 0;

$('#yes').on('click',function(e){
  e.preventDefault();
   $('#myModal').modal('hide');
    a = 2; 
    
});

$('.no').on('click',function(e){
  e.preventDefault();
   $('#myModal').modal('hide');
    a = 1;
});

 
$('#myModal').on('hidden.bs.modal', function (e) {
  b = 1;
})


setInterval(function(){
    if (a == 0 && b == 0) {
    
    }else if(a== 1 && b ==1){
      window.location = 'profile.php';
    }else if(a== 0 && b ==1){
      $('#myModal').modal('show');
    }
  }, 1500);
</script>
<script type="text/javascript">
  $('#update').on('click',function(event){
    event.preventDefault();

    var password    = $('#password').val(); 
    $.ajax({  
        url:"../ajax/verifyPass.php",  
        type:"post",  
        data:{password:password},
        beforeSend: function(){
         
        },    
        success:function(dataa){ 
          if (dataa == 'success') {
              var uid         = $('#uid').val();
              var lName       = $('#lName').val();
              var fName       = $('#fName').val();
              var mi          = $('#mi').val();
              var email       = $('#email').val();
              var contactno   = $('#contactno').val();
              var department  = $('#department').val();
              var course      = $('#course').val();
              $.ajax({  
                  url:"../ajax/updateProfile.php",  
                  type:"post",  
                  data:{uid:uid,lName:lName,fName:fName,mi:mi,email:email,contactno:contactno,department:department,course:course},
                  beforeSend: function(){
                   
                  },    
                  success:function(dataa){ 
                    alert('Profile Updated');
                    window.location = 'index.php';
                  }
              });
          }else{
            $('#alert').html('<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Password</strong> is incorrect!</div>');
          }
        }
    });


   
  });
</script>