<?php
include 'check_login.php';
?>

  <?php  include('header.php'); ?>

  <?php include('main_sidebar.php') ?>


  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Pending Files Request 
      </h1>

    </section>

    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="container-fluid">
            <div class="row">
              <div class="col box box-info nav1 requesting"  request="TRANSCRIPT OF RECORD">
                <div class="container notification">
                  <center class="box-header">
                    <h3 class="box-title">TRANSCRIPT OF RECORD</h3>
                  </center> 
                  <span class="badge" id="TOR-load"> 
                   <span class="fa-stack badge2 fa-2x has-badge" data-count="10">
                      <i class="fa fa-users"></i>
                    </span>
                  </span>
                </div>
              </div>
              <div class="col box box-info nav1 requesting"  request="GOODMORAL">
                <div class="col notification">
                  <center class="box-header">
                    <h3 class="box-title">GOODMORAL</h3>
                  </center> 
                  <span class="badge" id="GOODMORAL-load"> 
                   <span class="fa-stack badge2 fa-2x has-badge" data-count="10">
                      <i class="fa fa-users"></i>
                    </span>
                  </span>
                </div>
              </div>
              <div class="col box box-info nav1 requesting"  request="CERTIFICATE OF GRADES">
                <div class="col notification">
                  <center class="box-header">
                    <h3 class="box-title">CERTIFICATE OF GRADES</h3>
                  </center> 
                  <span class="badge" id="COG-load"> 
                   <span class="fa-stack badge2 fa-2x has-badge" data-count="10">
                      <i class="fa fa-users"></i>
                    </span>
                  </span>
                </div>
              </div>
              <div class="col box box-info nav1 requesting"  request="HONORABLE DISMISSAL">
                <div class="col notification">
                  <center class="box-header">
                    <h3 class="box-title">HONORABLE DISMISSAL</h3>
                  </center> 
                  <span class="badge" id="HD-load"> 
                   <span class="fa-stack badge2 fa-2x has-badge" data-count="10">
                      <i class="fa fa-users"></i>
                    </span>
                  </span>
                </div>
              </div>
              <div class="col box box-info nav1 requesting" request="TRANSFER CODINTIAL">
                <div class="col notification">
                  <center class="box-header">
                    <h3 class="box-title">TRANSFER CODINTIAL</h3>
                  </center> 
                  <span class="badge" id="TC-load"> 
                    <span class="fa-stack badge2 fa-2x has-badge" data-count="10">
                      <i class="fa fa-users"></i>
                    </span>
                  </span>
                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <section class="col-lg-12">
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-refresh pull-right btn btn-default requesting" data-toggle="tooltip" data-placement="bottom" title="Refresh" request="refresh" style="cursor: pointer;"></i>
              <div class="form-group  has-feedback ">
                <div class="col-lg-5" >
                  <label class="control-label" for="inputGroupSuccess1">Search</label>
                  <div class="input-group" style="border-bottom: 2px solid #98AFC7; ">
                    <input type="text" class="form-control " placeholder="Search" id="search" style="border:none; ">
                    <i class="fa fa-search " style="margin: 1%; font-size: 150%"></i>
                  </div>
                </div>
              </div>
             
            </div>
            <!-- Content-->


            <div class="bs-example" data-example-id="simple-responsive-table">
              <div class="table-responsive">
                <table class="table table-hover" >
                <thead>
                  <tr class="header">
                  </tr>
                  <tr class="header">
                    <th ><center>Date</center></th>
                    <th  ><center>Student ID</center></th>
                    <th  ><center>Full Name</center></th>
                    <th  ><center>Request</center></th>
                    <th  ><center>Purpose</center></th>
                    <th ><center>Status</center></th>
                    <th ><center>Action</center></th>
                  </tr>
                </thead>
                <tbody id="content">
                
                  </tbody>
                </table>
              </div>
            </div>
            

        </section>
      </div>
  <?php include('footer.php') ?>



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
<script src="../../sweetalert/dist/sweetalert2.all.min.js"></script>
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<!--page Count-->
<div class="modal fade" id="countPage" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h4 class="modal-title" id="gridSystemModalLabel">Page Count</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 ">
              <p style="background-color: #D1D0CE">How many page for <code id="srequest"></code>?</p>
              <hr>
              <input type="hidden" name="" id="srid">
              <input type="hidden" name="" id="sid">
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label for="exampleInputEmail1">Page</label>
                <input type="number" class="form-control" id="pageCount" placeholder="Page Count" >
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="button" id="loading" disabled=""><i class="fa fa-spinner fa-spin"></i> Loading...</span></button>
        <button type="button" class="btn btn-primary" id="pageSave">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
</html>

<script type="text/javascript">
var audio = new Audio('../../sounds/facebook_pc.mp3');
var lastCount = 0;

setInterval(function () {
  //count pending request
  $.ajax({  
        url:"../ajax/pendingReq.php",
        beforeSend: function(){
        },    
        success:function(dataa){ 
          if (dataa =='no') {
            $('#pendingReq').html();
            $('#all').html();

          }else{
            if (dataa > lastCount) {
              lastCount = dataa;
              audio.play();
            }else{
             
            }
            $('#pendingReq').html(dataa);
            $('#all').html(dataa);
            
            
          }
        }
    });
  TOR();
  GOODMORAL();
  COG();
  HD();
  TC();
}, 2000);
</script>
<script type="text/javascript">
  //first load
  function firstLoad() {
    $.ajax({
         url:"../ajax/firstLoad.php",
          success:function(data3){
            $('#content').html(data3);
         }
       });
  }
  firstLoad();

  //count TOR
  function TOR() {
    $.ajax({
         url:"../ajax/TOR.php",
          success:function(data3){
            $('#TOR-load').html(data3);
         }
       });
  }
  TOR();
  //count GOODMORAL
  function GOODMORAL() {
    $.ajax({
         url:"../ajax/GOODMORAL.php",
          success:function(data3){
            $('#GOODMORAL-load').html(data3);
         }
       });
  }
  GOODMORAL();

  //count CERTIFICATE OF GRADES
  function COG() {
    $.ajax({
         url:"../ajax/COG.php",
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
         url:"../ajax/HD.php",
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
         url:"../ajax/TC.php",
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
  $(document).on('click','.confirm',function(envent){
    event.preventDefault();
    sid       = jQuery(this).attr('sid');
    srid      = jQuery(this).attr('srid');
    srequest  = jQuery(this).attr('srequest');
   
    $('#srequest').html(srequest);
    $('#srid').val(srid);
    $('#sid').val(sid);
    $('#countPage').modal('show');
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
        url:"../ajax/requesting.php",
        type:'post',
        data:{requesting:requesting},
        beforeSend: function(){
          
        },    
        success:function(dataa){ 
          $('#content').html(dataa);
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
        url:"../ajax/searching.php",
        type:'post',
        data:{search:search},
        beforeSend: function(){
          
        },    
        success:function(dataa){ 
          $('#content').html(dataa);
        }
    });
  });
</script>
