<?php
include 'check_login.php';


?>
<!--Hearder-->
  <?php  include('header.php'); ?>
<!-- Main Sidebar-->
  <?php include('main_sidebar.php'); ?>


  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        ADD STUDENT

      </h1>

    </section>

    <section class="content">
      <center>
      <div class="row">
        <section class="col-lg-12">
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-person-cap"></i>
              <h3 class="box-title">Profile</h3>
            </div>
            <!-- Content-->
           
              <form action="" method="post" id="updateForm">
                
                <div class="form-row">
                  <div class="form-group col-md-4"align="left">
                    <label >First Name</label>
                    <input type="text" class="form-control" name="fName" id="fName" placeholder="Enter your First Name"  required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4"align="left">
                    <label >M.I</label>
                    <input type="text" class="form-control" name="mi" id="mi" placeholder="Enter your Middle initial"  required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4"align="left">
                    <label >Last Name</label>
                    <input type="text" class="form-control" name="lName" id="lName" placeholder="Enter your Last Name"  required>
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <hr>
                    </div>
                </div>

                
                <div class="form-row">
                  <div class="form-row">
                    <div class="form-group col-md-4"align="left">
                      <label >Student ID</label>
                      <input type="text" class="form-control" name="studentId" id="studentId" placeholder="Enter Student ID"  required>
                    </div>
                  </div>
                  <div class="form-group col-md-4"align="left">
                  <label >Department</label>
                    <select class="form-control" name="department" id="department" required>
                       
                      <?php
                      $queryDep = "SELECT * FROM department";
                      $resultDep = $conn->query($queryDep);
                      
                        while ($rowDep = $resultDep->fetch_assoc()) {
                          $dep = $rowDep['dep'];
                          ?>
                          <option value="<?php echo $dep; ?>"><?php echo $dep; ?></option>
                          <?php
                        }
                      ?>
                      
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4"align="left">
                  <label >Course</label>
                    <select class="form-control" name="course" id="course" required>
                      <option value="" disabled >Select Request</option>
                      
                    </select>
                  </div>
                </div>



                <div class="form-row">
                    <div class="form-group col-md-12">
                      <hr>
                    </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6"align="left">
                    <label >Contact Number</label>
                    <input type="text" class="form-control" name="no" id="no" placeholder="Enter you active cellphone number"   required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6"align="left">
                    <label >E-mail</label>
                    <input type="text" class="form-control" name="email" id="email"  placeholder="Enter your active E-mail account"   required>
                  </div>
                </div>
                <!-- <script>
                //select
                function rquest(){
                   var data = document.getElementById("rquest").value;
                   if( data == "transfer"){

                    <div class="form-row">
                      <div class="form-group col-md-3"align="left">
                        <label >Purpose:</label>
                        <input type="text" class="form-control" name="purpose"  placeholder="Purpose" required>
                      </div>
                    </div>

                    }
                  }
                </script> -->
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <hr>
                    </div>
                </div>
                <div class="box-footer clearfix">
                  <button type="submit" class="pull-right btn btn-primary" name="osr" id="submit">Save
                    <i class="fa fa-arrow-circle-up"></i></button>
                </div>
            </form>
        </section>
      </div>
    </center>
  </section>
  </div>

  <footer class="main-footer" class="pull-left" >

    <div class="pull-right hidden-xs">
      <b></b> <br>
    </div>

  </footer>



      </div>
    </div>
  </aside>

  <div class="control-sidebar-bg"></div>
</div>

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
  $('#submit').on('click',function(e){
    e.preventDefault();
    var fName = $('fName').val();
    var mi = $('mi').val();
    var lName = $('lName').val();
    var studentId = $('studentId').val();
    var department = $('department').val();
    var course = $('course').val();
    var no = $('no').val();
    var email = $('email').val();
    $.ajax({  
        url:"../ajax/addStudent.php",  
        type:"post",  
        data:{fName:fName,mi:mi,lName:lName,studentId:studentId,department:department,course:course,no:no,email:email},
        beforeSend: function(){
         
        },    
        success:function(dataa){ 
          alert('asd');
        }
    });
  });
</script>