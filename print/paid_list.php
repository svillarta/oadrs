<?php
  include("../db.php");
  include("../auth.php"); //include auth.php file on all secure pages
  include("../db.php")
?>

<?php
  $query  = mysqli_query($con,"SELECT * from overtime");
  while($row=mysqli_fetch_array($query))
  {
    @$rate           = $row['rate'];
  }


?>

<!DOCTYPE html>
<html lang="en">
   <head>
        <script src="jquery-1.10.2.js" type="text/JavaScript" language="javascript"></script>
        <script src="jquery-ui-1.10.4.custom.js"></script>
        <script src="jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>

        <link type="text/css" rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.4.custom.css" />

        <link type="text/css" rel="stylesheet" href="PrintArea.css" />                <!-- Y : rel is stylesheet and media is in [all,print,empty,undefined] -->
        
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bootstrap, a sleek, intuitive, and powerful mobile first front-end framework for faster and easier web development.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, bootstrap, front-end, frontend, web development">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">

    <title></title>

    <script>
      <!--
        var ScrollMsg= "Payroll and Management System - "
        var CharacterPosition=0;
        function StartScrolling() {
        document.title=ScrollMsg.substring(CharacterPosition,ScrollMsg.length)+
        ScrollMsg.substring(0, CharacterPosition);
        CharacterPosition++;
        if(CharacterPosition > ScrollMsg.length) CharacterPosition=0;
        window.setTimeout("StartScrolling()",150); }
        StartScrolling();
      // -->
    </script>
    
    <link href="../assets/logo.png" rel="shortcut icon">
    <link href="assets/css/justified-nav.css" rel="stylesheet">


    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="data:text/css;charset=utf-8," data-href="assets/css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet"> -->
    <!-- <link href="assets/css/docs.min.css" rel="stylesheet"> -->
    <link href="assets/css/search.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/css/styles.css" /> -->
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.min.css">


    </head>
<body>

   
      <br>

<!-- <h3><b>Ordinance</b></h3> -->

         
      <div>
        <div class="form-group" style="position: fixed; right:  1%; bottom: 5%; z-index: 1000px;">
          <button name="submit" value="Print" class="btn btn-success" id="payout"><span class="glyphicon glyphicon-print"> </span> Print</button>
            <a href="../home_salary.php" id="payout" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
        </div>
      </div>

        
<div class="PrintArea area3">
  <table class="table table-bordered" >
    <tr>
      <!--First print -->
      <td style="width:400px;" >
         <?php
          $query10 = $sql = mysqli_query($con,"SELECT * FROM print WHERE print = 0");
          if(mysqli_num_rows($query10)>0){
            while ($row10 = mysqli_fetch_assoc($query10)) {
              $id=$row10['emp_id'];
            }
          mysqli_query($con,"UPDATE print SET print = 1 WHERE emp_id = '$id'");


          
          $sql = mysqli_query($con,"SELECT * FROM allowance WHERE id ='$id'");
          if(mysqli_num_rows($sql)>0){
            while ($r=mysqli_fetch_assoc($sql)) {
              $allowance =$r['rate']; 
            }
          }
          $status = 0;      
          $sql = mysqli_query($con,"UPDATE employee set status='$status'  WHERE emp_id ='$id'");
          $sql = mysqli_query($con,"SELECT * from deductions WHERE deduction_id ='$id'");
            if(mysqli_num_rows($sql)>0){
              while ($row=mysqli_fetch_assoc($sql)) {
                $deduction_cs         = $row['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row['groceries'];//Groceries
                $deduction_bugas      = $row['bugas'];//Bugas
                $deduction_ga         = $row['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row['c_a'];//Cash advance
              }
            }else{
              $deduction_cs         = 0;//cunstruction supply
              $deduction_groceries  = 0;//Groceries
              $deduction_bugas      = 0;//Bugas
              $deduction_ga         = 0;//Gails Apparel's
              $deduction_ca         = 0;//Cash advance
              $days                 = 0;//work of time
              $hour                 = 0;//Overtime
              mysqli_query($con,"INSERT INTO deductions VALUES('$id','$deduction_cs','$deduction_groceries','$deduction_bugas','$deduction_ga','$deduction_ca','')");
            }
          $query  = mysqli_query($con,"SELECT * from employee where emp_id= '$id'");
          while($row=mysqli_fetch_array($query)){
            $lname           = $row['lname'];
            $fname           = $row['fname'];
            $days_of_work    = $row['days_of_work'];
            $rate            = $row['rate'];
            $overtime        = $row['overtime'];
            $amount          = $row['rate'] * $row['days_of_work'];
            if($rate >= 200 && $rate <= 250 ){
              $time_rate  = 25;
            }elseif($rate < 200 ){
              $rate1      = $rate / 8; 
              $time_rate  = $rate1;
            }else{
              $rate1      = $rate  - 50;
              $time_rate  = $rate1 / 8;
            }       
            $ot_rate         = $row['overtime'] * $time_rate; 
            $total_amount    = $amount + $ot_rate + $allowance; 
            $query1  = mysqli_query($con,"SELECT * from deductions where deduction_id = '$id'");
              while($row1=mysqli_fetch_array($query1)){
                $deduction_cs         = $row1['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row1['groceries'];//Groceries
                $deduction_bugas      = $row1['bugas'];//Bugas
                $deduction_ga         = $row1['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row1['c_a'];//Cash advance
                $deduction            = $row1['to_ded'];
              }
              $payout   = $total_amount - $deduction;
          }
          mysqli_query($con,"UPDATE _date set _date=CURRENT_DATE() where id = 1");
          $sql= mysqli_query($con,"SELECT * FROM _date");
          if($sql) {
            while ($row = mysqli_fetch_assoc($sql)) {
              $date = $row['_date'];
            }
          }else{
            ?>
              <script>
                alert('Invalid.');
              </script>
            <?php 
          }
          ?>
        
    
      
          <div class="col-sm-12">
            <img class="pull-left" src="../assets/logo.png" style="width: 80px; height: 50px; padding: 0; margin-top: 0px; left: 0;">
            
            <label class="pull-right">Date : <?php echo $date; ?></label>
          </div>
          <div>
            <label ></label>
          </div>  
          <div>
            <div ><h4 style="margin-left: 20%;"><?php echo $lname; ?>, <?php echo $fname; ?></h4></div>
          </div>
        
          <div class="col-sm-12">
            <label>Days of work :  </label>
            <label class="pull-right"><strong  ><?php echo $days_of_work; ?></strong></label>
          </div>
          <div class="col-sm-12">
            <label>Rate : </strong></label>
            <label class="pull-right"><strong  ><?php echo $rate; ?></label>
          </div>

          <!-- start overtime-->
          <div class="col-sm-12">
             <label >Overtime :  </strong></label>
             <label class="pull-right"><strong ><?php echo $overtime; ?></label> 
          </div>
          <div class="col-sm-12">
            <label ">Overtime Rate :  </label>
            <label class="pull-right"> <strong ><?php echo $time_rate; ?></strong></label>
          </div>
          
          <!--end overtime-->
          <div class="col-sm-12">
            <label style="padding-left: 50%;" class="padding-left">Salary :  </label>
            <label class="pull-right"><strong><?php echo $total_amount; ?></strong></label>
          </div>
          <div>
            <label></label>
          </div>
          <div class="form-group">
          <div class="col-sm-4">
            <div ><h4 style="margin-left: 20%;" >Deduction/s </h4></div>
          </div>
        </div>
        <!--start deduction-->
        <?php
        if ($deduction_cs!=0) {
          ?>
          <div class="col-sm-12">
            <label>Construction Supply :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_cs; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_groceries!=0) {
          ?>
          <div class="col-sm-12">
            <label>Groceries : </label>
            <label class="pull-right"><strong ><?php echo $deduction_groceries; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_bugas!=0) {
          ?>
          <div class="col-sm-12">
            <label >Bugas :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_bugas; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ga!=0) {
          ?>
          <div class="col-sm-12">
            <label >Gails Apparel's : </strong></label>
            <label class="pull-right"><strong  ><?php echo $deduction_ga; ?></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ca!=0) {
          ?>
          <div class="col-sm-12">
            <label>Cash Advance : </strong></label>
            <label class="pull-right"><strong ><?php echo $deduction_ca; ?></label>
          </div>
          <?php
        }
        ?>
        <div  class="col-sm-12">
          <label style="padding-left: 35%;">Total Deduction : </label>
          <label class="pull-right"><strong style="padding-left: 46px;" ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label ></label>
        </div>  
               
        <!--end deduction-->
               
        <div class="col-sm-12">
          <label >Salary : </label>
          <label class="pull-right"><strong ><?php echo $total_amount; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label>Total Deduction :</label>
          <label class="pull-right"> <strong ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label style="padding-left: 35%;"><h4>Total Salary : </h4></label>
          <label class="pull-right"><h4><strong ><?php echo $payout; ?></strong></h4></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div style="border-top: 2px solid #999;">
          <label style=" padding-left: 40%;">Signature </label>
        </div>
    
      <?php
      }else{

      }
      ?>
      </td>
      <!--end print -->

      <!--second print -->
      <td style="width:400px;" >
      <?php
          $query10 = $sql = mysqli_query($con,"SELECT * FROM print WHERE print = 0");
          if(mysqli_num_rows($query10)>0){
            while ($row10 = mysqli_fetch_assoc($query10)) {
              $id=$row10['emp_id'];
            }
          mysqli_query($con,"UPDATE print SET print = 1 WHERE emp_id = '$id'");


          
          $sql = mysqli_query($con,"SELECT * FROM allowance WHERE id ='$id'");
          if(mysqli_num_rows($sql)>0){
            while ($r=mysqli_fetch_assoc($sql)) {
              $allowance =$r['rate']; 
            }
          }
          $status = 0;      
          $sql = mysqli_query($con,"UPDATE employee set status='$status'  WHERE emp_id ='$id'");
          $sql = mysqli_query($con,"SELECT * from deductions WHERE deduction_id ='$id'");
            if(mysqli_num_rows($sql)>0){
              while ($row=mysqli_fetch_assoc($sql)) {
                $deduction_cs         = $row['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row['groceries'];//Groceries
                $deduction_bugas      = $row['bugas'];//Bugas
                $deduction_ga         = $row['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row['c_a'];//Cash advance
              }
            }else{
              $deduction_cs         = 0;//cunstruction supply
              $deduction_groceries  = 0;//Groceries
              $deduction_bugas      = 0;//Bugas
              $deduction_ga         = 0;//Gails Apparel's
              $deduction_ca         = 0;//Cash advance
              $days                 = 0;//work of time
              $hour                 = 0;//Overtime
              mysqli_query($con,"INSERT INTO deductions VALUES('$id','$deduction_cs','$deduction_groceries','$deduction_bugas','$deduction_ga','$deduction_ca','')");
            }
          $query  = mysqli_query($con,"SELECT * from employee where emp_id= '$id'");
          while($row=mysqli_fetch_array($query)){
            $lname           = $row['lname'];
            $fname           = $row['fname'];
            $days_of_work    = $row['days_of_work'];
            $rate            = $row['rate'];
            $overtime        = $row['overtime'];
            $amount          = $row['rate'] * $row['days_of_work'];
            if($rate >= 200 && $rate <= 250 ){
              $time_rate  = 25;
            }elseif($rate < 200 ){
              $rate1      = $rate / 8; 
              $time_rate  = $rate1;
            }else{
              $rate1      = $rate  - 50;
              $time_rate  = $rate1 / 8;
            }        
            $ot_rate         = $row['overtime'] * $time_rate; 
            $total_amount    = $amount + $ot_rate + $allowance; 
            $query1  = mysqli_query($con,"SELECT * from deductions where deduction_id = '$id'");
              while($row1=mysqli_fetch_array($query1)){
                $deduction_cs         = $row1['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row1['groceries'];//Groceries
                $deduction_bugas      = $row1['bugas'];//Bugas
                $deduction_ga         = $row1['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row1['c_a'];//Cash advance
                $deduction            = $row1['to_ded'];
              }
              $payout   = $total_amount - $deduction;
          }
          mysqli_query($con,"UPDATE _date set _date=CURRENT_DATE() where id = 1");
          $sql= mysqli_query($con,"SELECT * FROM _date");
          if($sql) {
            while ($row = mysqli_fetch_assoc($sql)) {
              $date = $row['_date'];
            }
          }else{
            ?>
              <script>
                alert('Invalid.');
              </script>
            <?php 
          }
          ?>

    
    
      
          <div class="col-sm-12">
            <img class="pull-left" src="../assets/logo.png" style="width: 80px; height: 50px; padding: 0; margin-top: 0px; left: 0;">
            
            <label class="pull-right">Date : <?php echo $date; ?></label>
          </div>
          <div>
            <label ></label>
          </div>  
          <div>
            <div ><h4 style="margin-left: 20%;"><?php echo $lname; ?>, <?php echo $fname; ?></h4></div>
          </div>
        
          <div class="col-sm-12">
            <label>Days of work :  </label>
            <label class="pull-right"><strong  ><?php echo $days_of_work; ?></strong></label>
          </div>
          <div class="col-sm-12">
            <label>Rate : </strong></label>
            <label class="pull-right"><strong  ><?php echo $rate; ?></label>
          </div>

          <!-- start overtime-->
          <div class="col-sm-12">
             <label >Overtime :  </strong></label>
             <label class="pull-right"><strong ><?php echo $overtime; ?></label> 
          </div>
          <div class="col-sm-12">
            <label ">Overtime Rate :  </label>
            <label class="pull-right"> <strong ><?php echo $time_rate; ?></strong></label>
          </div>
          
          <!--end overtime-->
          <div class="col-sm-12">
            <label style="padding-left: 50%;" class="padding-left">Salary :  </label>
            <label class="pull-right"><strong><?php echo $total_amount; ?></strong></label>
          </div>
          <div>
            <label></label>
          </div>
          <div class="form-group">
          <div class="col-sm-4">
            <div ><h4 style="margin-left: 20%;" >Deduction/s </h4></div>
          </div>
        </div>
        <!--start deduction-->
        <?php
        if ($deduction_cs!=0) {
          ?>
          <div class="col-sm-12">
            <label>Construction Supply :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_cs; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_groceries!=0) {
          ?>
          <div class="col-sm-12">
            <label>Groceries : </label>
            <label class="pull-right"><strong ><?php echo $deduction_groceries; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_bugas!=0) {
          ?>
          <div class="col-sm-12">
            <label >Bugas :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_bugas; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ga!=0) {
          ?>
          <div class="col-sm-12">
            <label >Gails Apparel's : </strong></label>
            <label class="pull-right"><strong  ><?php echo $deduction_ga; ?></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ca!=0) {
          ?>
          <div class="col-sm-12">
            <label>Cash Advance : </strong></label>
            <label class="pull-right"><strong ><?php echo $deduction_ca; ?></label>
          </div>
          <?php
        }
        ?>
        <div  class="col-sm-12">
          <label style="padding-left: 35%;">Total Deduction : </label>
          <label class="pull-right"><strong style="padding-left: 46px;" ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label ></label>
        </div>  
               
        <!--end deduction-->
               
        <div class="col-sm-12">
          <label >Salary : </label>
          <label class="pull-right"><strong ><?php echo $total_amount; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label>Total Deduction :</label>
          <label class="pull-right"> <strong ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label style="padding-left: 35%;"><h4>Total Salary : </h4></label>
          <label class="pull-right"><h4><strong ><?php echo $payout; ?></strong></h4></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div style="border-top: 2px solid #999;">
          <label style=" padding-left: 40%;">Signature </label>
        </div>
    
      
      <?php
      }
      ?>
      </td>
      <!--end print -->
      <!--3rd print --> 
      <td style="width:400px;" >
      <?php
          $query10 = $sql = mysqli_query($con,"SELECT * FROM print WHERE print = 0");
          if(mysqli_num_rows($query10)>0){
            while ($row10 = mysqli_fetch_assoc($query10)) {
              $id=$row10['emp_id'];
            }
          mysqli_query($con,"UPDATE print SET print = 1 WHERE emp_id = '$id'");


          
          $sql = mysqli_query($con,"SELECT * FROM allowance WHERE id ='$id'");
          if(mysqli_num_rows($sql)>0){
            while ($r=mysqli_fetch_assoc($sql)) {
              $allowance =$r['rate']; 
            }
          }
          $status = 0;      
          $sql = mysqli_query($con,"UPDATE employee set status='$status'  WHERE emp_id ='$id'");
          $sql = mysqli_query($con,"SELECT * from deductions WHERE deduction_id ='$id'");
            if(mysqli_num_rows($sql)>0){
              while ($row=mysqli_fetch_assoc($sql)) {
                $deduction_cs         = $row['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row['groceries'];//Groceries
                $deduction_bugas      = $row['bugas'];//Bugas
                $deduction_ga         = $row['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row['c_a'];//Cash advance
              }
            }else{
              $deduction_cs         = 0;//cunstruction supply
              $deduction_groceries  = 0;//Groceries
              $deduction_bugas      = 0;//Bugas
              $deduction_ga         = 0;//Gails Apparel's
              $deduction_ca         = 0;//Cash advance
              $days                 = 0;//work of time
              $hour                 = 0;//Overtime
              mysqli_query($con,"INSERT INTO deductions VALUES('$id','$deduction_cs','$deduction_groceries','$deduction_bugas','$deduction_ga','$deduction_ca','')");
            }
          $query  = mysqli_query($con,"SELECT * from employee where emp_id= '$id'");
          while($row=mysqli_fetch_array($query)){
            $lname           = $row['lname'];
            $fname           = $row['fname'];
            $days_of_work    = $row['days_of_work'];
            $rate            = $row['rate'];
            $overtime        = $row['overtime'];
            $amount          = $row['rate'] * $row['days_of_work'];
            if($rate >= 200 && $rate <= 250 ){
              $time_rate  = 25;
            }elseif($rate < 200 ){
              $rate1      = $rate / 8; 
              $time_rate  = $rate1;
            }else{
              $rate1      = $rate  - 50;
              $time_rate  = $rate1 / 8;
            }       
            $ot_rate         = $row['overtime'] * $time_rate; 
            $total_amount    = $amount + $ot_rate + $allowance; 
            $query1  = mysqli_query($con,"SELECT * from deductions where deduction_id = '$id'");
              while($row1=mysqli_fetch_array($query1)){
                $deduction_cs         = $row1['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row1['groceries'];//Groceries
                $deduction_bugas      = $row1['bugas'];//Bugas
                $deduction_ga         = $row1['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row1['c_a'];//Cash advance
                $deduction            = $row1['to_ded'];
              }
              $payout   = $total_amount - $deduction;
          }
          mysqli_query($con,"UPDATE _date set _date=CURRENT_DATE() where id = 1");
          $sql= mysqli_query($con,"SELECT * FROM _date");
          if($sql) {
            while ($row = mysqli_fetch_assoc($sql)) {
              $date = $row['_date'];
            }
          }else{
            ?>
              <script>
                alert('Invalid.');
              </script>
            <?php 
          }
          ?>

          <div class="col-sm-12">
            <img class="pull-left" src="../assets/logo.png" style="width: 80px; height: 50px; padding: 0; margin-top: 0px; left: 0;">
            
            <label class="pull-right">Date : <?php echo $date; ?></label>
          </div>
          <div>
            <label ></label>
          </div>  
          <div>
            <div ><h4 style="margin-left: 20%;"><?php echo $lname; ?>, <?php echo $fname; ?></h4></div>
          </div>
        
          <div class="col-sm-12">
            <label>Days of work :  </label>
            <label class="pull-right"><strong  ><?php echo $days_of_work; ?></strong></label>
          </div>
          <div class="col-sm-12">
            <label>Rate : </strong></label>
            <label class="pull-right"><strong  ><?php echo $rate; ?></label>
          </div>

          <!-- start overtime-->
          <div class="col-sm-12">
             <label >Overtime :  </strong></label>
             <label class="pull-right"><strong ><?php echo $overtime; ?></label> 
          </div>
          <div class="col-sm-12">
            <label ">Overtime Rate :  </label>
            <label class="pull-right"> <strong ><?php echo $time_rate; ?></strong></label>
          </div>
          
          <!--end overtime-->
          <div class="col-sm-12">
            <label style="padding-left: 50%;" class="padding-left">Salary :  </label>
            <label class="pull-right"><strong><?php echo $total_amount; ?></strong></label>
          </div>
          <div>
            <label></label>
          </div>
          <div class="form-group">
          <div class="col-sm-4">
            <div ><h4 style="margin-left: 20%;" >Deduction/s </h4></div>
          </div>
        </div>
        <!--start deduction-->
        <?php
        if ($deduction_cs!=0) {
          ?>
          <div class="col-sm-12">
            <label>Construction Supply :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_cs; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_groceries!=0) {
          ?>
          <div class="col-sm-12">
            <label>Groceries : </label>
            <label class="pull-right"><strong ><?php echo $deduction_groceries; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_bugas!=0) {
          ?>
          <div class="col-sm-12">
            <label >Bugas :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_bugas; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ga!=0) {
          ?>
          <div class="col-sm-12">
            <label >Gails Apparel's : </strong></label>
            <label class="pull-right"><strong  ><?php echo $deduction_ga; ?></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ca!=0) {
          ?>
          <div class="col-sm-12">
            <label>Cash Advance : </strong></label>
            <label class="pull-right"><strong ><?php echo $deduction_ca; ?></label>
          </div>
          <?php
        }
        ?>
        <div  class="col-sm-12">
          <label style="padding-left: 35%;">Total Deduction : </label>
          <label class="pull-right"><strong style="padding-left: 46px;" ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label ></label>
        </div>  
               
        <!--end deduction-->
               
        <div class="col-sm-12">
          <label >Salary : </label>
          <label class="pull-right"><strong ><?php echo $total_amount; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label>Total Deduction :</label>
          <label class="pull-right"> <strong ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label style="padding-left: 35%;"><h4>Total Salary : </h4></label>
          <label class="pull-right"><h4><strong ><?php echo $payout; ?></strong></h4></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div style="border-top: 2px solid #999;">
          <label style=" padding-left: 40%;">Signature </label>
        </div>
    
     
      <?php
      }
      ?>
       </td>
      <!--end print -->
   
    </tr>
      <!--4rth print -->
      <td style="width:400px;" >
          <?php
          $query10 = $sql = mysqli_query($con,"SELECT * FROM print WHERE print = 0");
          if(mysqli_num_rows($query10)>0){
            while ($row10 = mysqli_fetch_assoc($query10)) {
              $id=$row10['emp_id'];
            }
          mysqli_query($con,"UPDATE print SET print = 1 WHERE emp_id = '$id'");


          
          $sql = mysqli_query($con,"SELECT * FROM allowance WHERE id ='$id'");
          if(mysqli_num_rows($sql)>0){
            while ($r=mysqli_fetch_assoc($sql)) {
              $allowance =$r['rate']; 
            }
          }
          $status = 0;      
          $sql = mysqli_query($con,"UPDATE employee set status='$status'  WHERE emp_id ='$id'");
          $sql = mysqli_query($con,"SELECT * from deductions WHERE deduction_id ='$id'");
            if(mysqli_num_rows($sql)>0){
              while ($row=mysqli_fetch_assoc($sql)) {
                $deduction_cs         = $row['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row['groceries'];//Groceries
                $deduction_bugas      = $row['bugas'];//Bugas
                $deduction_ga         = $row['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row['c_a'];//Cash advance
              }
            }else{
              $deduction_cs         = 0;//cunstruction supply
              $deduction_groceries  = 0;//Groceries
              $deduction_bugas      = 0;//Bugas
              $deduction_ga         = 0;//Gails Apparel's
              $deduction_ca         = 0;//Cash advance
              $days                 = 0;//work of time
              $hour                 = 0;//Overtime
              mysqli_query($con,"INSERT INTO deductions VALUES('$id','$deduction_cs','$deduction_groceries','$deduction_bugas','$deduction_ga','$deduction_ca','')");
            }
          $query  = mysqli_query($con,"SELECT * from employee where emp_id= '$id'");
          while($row=mysqli_fetch_array($query)){
            $lname           = $row['lname'];
            $fname           = $row['fname'];
            $days_of_work    = $row['days_of_work'];
            $rate            = $row['rate'];
            $overtime        = $row['overtime'];
            $amount          = $row['rate'] * $row['days_of_work'];
            if($rate >= 200 && $rate <= 250 ){
              $time_rate  = 25;
            }elseif($rate < 200 ){
              $rate1      = $rate / 8; 
              $time_rate  = $rate1;
            }else{
              $rate1      = $rate  - 50;
              $time_rate  = $rate1 / 8;
            }        
            $ot_rate         = $row['overtime'] * $time_rate; 
            $total_amount    = $amount + $ot_rate + $allowance; 
            $query1  = mysqli_query($con,"SELECT * from deductions where deduction_id = '$id'");
              while($row1=mysqli_fetch_array($query1)){
                $deduction_cs         = $row1['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row1['groceries'];//Groceries
                $deduction_bugas      = $row1['bugas'];//Bugas
                $deduction_ga         = $row1['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row1['c_a'];//Cash advance
                $deduction            = $row1['to_ded'];
              }
              $payout   = $total_amount - $deduction;
          }
          mysqli_query($con,"UPDATE _date set _date=CURRENT_DATE() where id = 1");
          $sql= mysqli_query($con,"SELECT * FROM _date");
          if($sql) {
            while ($row = mysqli_fetch_assoc($sql)) {
              $date = $row['_date'];
            }
          }else{
            ?>
              <script>
                alert('Invalid.');
              </script>
            <?php 
          }
          ?>

          <div class="col-sm-12">
            <img class="pull-left" src="../assets/logo.png" style="width: 80px; height: 50px; padding: 0; margin-top: 0px; left: 0;">
            <label class="pull-right">Date : <?php echo $date; ?></label>
          </div>
          <div>
            <label ></label>
          </div>  
          <div>
            <div ><h4 style="margin-left: 20%;"><?php echo $lname; ?>, <?php echo $fname; ?></h4></div>
          </div>
        
          <div class="col-sm-12">
            <label>Days of work :  </label>
            <label class="pull-right"><strong  ><?php echo $days_of_work; ?></strong></label>
          </div>
          <div class="col-sm-12">
            <label>Rate : </strong></label>
            <label class="pull-right"><strong  ><?php echo $rate; ?></label>
          </div>

          <!-- start overtime-->
          <div class="col-sm-12">
             <label >Overtime :  </strong></label>
             <label class="pull-right"><strong ><?php echo $overtime; ?></label> 
          </div>
          <div class="col-sm-12">
            <label ">Overtime Rate :  </label>
            <label class="pull-right"> <strong ><?php echo $time_rate; ?></strong></label>
          </div>
          
          <!--end overtime-->
          <div class="col-sm-12">
            <label style="padding-left: 50%;" class="padding-left">Salary :  </label>
            <label class="pull-right"><strong><?php echo $total_amount; ?></strong></label>
          </div>
          <div>
            <label></label>
          </div>
          <div class="form-group">
          <div class="col-sm-4">
            <div ><h4 style="margin-left: 20%;" >Deduction/s </h4></div>
          </div>
        </div>
        <!--start deduction-->
        <?php
        if ($deduction_cs!=0) {
          ?>
          <div class="col-sm-12">
            <label>Construction Supply :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_cs; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_groceries!=0) {
          ?>
          <div class="col-sm-12">
            <label>Groceries : </label>
            <label class="pull-right"><strong ><?php echo $deduction_groceries; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_bugas!=0) {
          ?>
          <div class="col-sm-12">
            <label >Bugas :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_bugas; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ga!=0) {
          ?>
          <div class="col-sm-12">
            <label >Gails Apparel's : </strong></label>
            <label class="pull-right"><strong  ><?php echo $deduction_ga; ?></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ca!=0) {
          ?>
          <div class="col-sm-12">
            <label>Cash Advance : </strong></label>
            <label class="pull-right"><strong ><?php echo $deduction_ca; ?></label>
          </div>
          <?php
        }
        ?>
        <div  class="col-sm-12">
          <label style="padding-left: 35%;">Total Deduction : </label>
          <label class="pull-right"><strong style="padding-left: 46px;" ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label ></label>
        </div>  
               
        <!--end deduction-->
               
        <div class="col-sm-12">
          <label >Salary : </label>
          <label class="pull-right"><strong ><?php echo $total_amount; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label>Total Deduction :</label>
          <label class="pull-right"> <strong ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label style="padding-left: 35%;"><h4>Total Salary : </h4></label>
          <label class="pull-right"><h4><strong ><?php echo $payout; ?></strong></h4></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div style="border-top: 2px solid #999;">
          <label style=" padding-left: 40%;">Signature </label>
        </div>
    
      
      <?php
      }
      ?>
      </td>
      <!--end print -->

      <!--5th print -->
       <td style="width:400px;" >
       <?php
          $query10 = $sql = mysqli_query($con,"SELECT * FROM print WHERE print = 0");
          if(mysqli_num_rows($query10)>0){
            while ($row10 = mysqli_fetch_assoc($query10)) {
              $id=$row10['emp_id'];
            }
          mysqli_query($con,"UPDATE print SET print = 1 WHERE emp_id = '$id'");


          
          $sql = mysqli_query($con,"SELECT * FROM allowance WHERE id ='$id'");
          if(mysqli_num_rows($sql)>0){
            while ($r=mysqli_fetch_assoc($sql)) {
              $allowance =$r['rate']; 
            }
          }
          $status = 0;      
          $sql = mysqli_query($con,"UPDATE employee set status='$status'  WHERE emp_id ='$id'");
          $sql = mysqli_query($con,"SELECT * from deductions WHERE deduction_id ='$id'");
            if(mysqli_num_rows($sql)>0){
              while ($row=mysqli_fetch_assoc($sql)) {
                $deduction_cs         = $row['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row['groceries'];//Groceries
                $deduction_bugas      = $row['bugas'];//Bugas
                $deduction_ga         = $row['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row['c_a'];//Cash advance
              }
            }else{
              $deduction_cs         = 0;//cunstruction supply
              $deduction_groceries  = 0;//Groceries
              $deduction_bugas      = 0;//Bugas
              $deduction_ga         = 0;//Gails Apparel's
              $deduction_ca         = 0;//Cash advance
              $days                 = 0;//work of time
              $hour                 = 0;//Overtime
              mysqli_query($con,"INSERT INTO deductions VALUES('$id','$deduction_cs','$deduction_groceries','$deduction_bugas','$deduction_ga','$deduction_ca','')");
            }
          $query  = mysqli_query($con,"SELECT * from employee where emp_id= '$id'");
          while($row=mysqli_fetch_array($query)){
            $lname           = $row['lname'];
            $fname           = $row['fname'];
            $days_of_work    = $row['days_of_work'];
            $rate            = $row['rate'];
            $overtime        = $row['overtime'];
            $amount          = $row['rate'] * $row['days_of_work'];
            if($rate >= 200 && $rate <= 250 ){
              $time_rate  = 25;
            }elseif($rate < 200 ){
              $rate1      = $rate / 8; 
              $time_rate  = $rate1;
            }else{
              $rate1      = $rate  - 50;
              $time_rate  = $rate1 / 8;
            }       
            $ot_rate         = $row['overtime'] * $time_rate; 
            $total_amount    = $amount + $ot_rate + $allowance; 
            $query1  = mysqli_query($con,"SELECT * from deductions where deduction_id = '$id'");
              while($row1=mysqli_fetch_array($query1)){
                $deduction_cs         = $row1['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row1['groceries'];//Groceries
                $deduction_bugas      = $row1['bugas'];//Bugas
                $deduction_ga         = $row1['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row1['c_a'];//Cash advance
                $deduction            = $row1['to_ded'];
              }
              $payout   = $total_amount - $deduction;
          }
          mysqli_query($con,"UPDATE _date set _date=CURRENT_DATE() where id = 1");
          $sql= mysqli_query($con,"SELECT * FROM _date");
          if($sql) {
            while ($row = mysqli_fetch_assoc($sql)) {
              $date = $row['_date'];
            }
          }else{
            ?>
              <script>
                alert('Invalid.');
              </script>
            <?php 
          }
          ?>

      
          <div class="col-sm-12">
            <img class="pull-left" src="../assets/logo.png" style="width: 80px; height: 50px; padding: 0; margin-top: 0px; left: 0;">
            <label class="pull-right">Date : <?php echo $date; ?></label>
          </div>
          <div>
            <label ></label>
          </div>  
          <div>
            <div ><h4 style="margin-left: 20%;"><?php echo $lname; ?>, <?php echo $fname; ?></h4></div>
          </div>
        
          <div class="col-sm-12">
            <label>Days of work :  </label>
            <label class="pull-right"><strong  ><?php echo $days_of_work; ?></strong></label>
          </div>
          <div class="col-sm-12">
            <label>Rate : </strong></label>
            <label class="pull-right"><strong  ><?php echo $rate; ?></label>
          </div>

          <!-- start overtime-->
          <div class="col-sm-12">
             <label >Overtime :  </strong></label>
             <label class="pull-right"><strong ><?php echo $overtime; ?></label> 
          </div>
          <div class="col-sm-12">
            <label ">Overtime Rate :  </label>
            <label class="pull-right"> <strong ><?php echo $time_rate; ?></strong></label>
          </div>
          
          <!--end overtime-->
          <div class="col-sm-12">
            <label style="padding-left: 50%;" class="padding-left">Salary :  </label>
            <label class="pull-right"><strong><?php echo $total_amount; ?></strong></label>
          </div>
          <div>
            <label></label>
          </div>
          <div class="form-group">
          <div class="col-sm-4">
            <div ><h4 style="margin-left: 20%;" >Deduction/s </h4></div>
          </div>
        </div>
        <!--start deduction-->
        <?php
        if ($deduction_cs!=0) {
          ?>
          <div class="col-sm-12">
            <label>Construction Supply :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_cs; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_groceries!=0) {
          ?>
          <div class="col-sm-12">
            <label>Groceries : </label>
            <label class="pull-right"><strong ><?php echo $deduction_groceries; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_bugas!=0) {
          ?>
          <div class="col-sm-12">
            <label >Bugas :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_bugas; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ga!=0) {
          ?>
          <div class="col-sm-12">
            <label >Gails Apparel's : </strong></label>
            <label class="pull-right"><strong  ><?php echo $deduction_ga; ?></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ca!=0) {
          ?>
          <div class="col-sm-12">
            <label>Cash Advance : </strong></label>
            <label class="pull-right"><strong ><?php echo $deduction_ca; ?></label>
          </div>
          <?php
        }
        ?>
        <div  class="col-sm-12">
          <label style="padding-left: 35%;">Total Deduction : </label>
          <label class="pull-right"><strong style="padding-left: 46px;" ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label ></label>
        </div>  
               
        <!--end deduction-->
               
        <div class="col-sm-12">
          <label >Salary : </label>
          <label class="pull-right"><strong ><?php echo $total_amount; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label>Total Deduction :</label>
          <label class="pull-right"> <strong ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label style="padding-left: 35%;"><h4>Total Salary : </h4></label>
          <label class="pull-right"><h4><strong ><?php echo $payout; ?></strong></h4></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div style="border-top: 2px solid #999;">
          <label style=" padding-left: 40%;">Signature </label>
        </div>
    
  
      <?php
      }
      ?>
      </td>
      <!--end print -->

      <!--6th print -->
       <td style="width:400px;" >
      <?php
          $query10 = $sql = mysqli_query($con,"SELECT * FROM print WHERE print = 0");
          if(mysqli_num_rows($query10)>0){
            while ($row10 = mysqli_fetch_assoc($query10)) {
              $id=$row10['emp_id'];
            }
          mysqli_query($con,"UPDATE print SET print = 1 WHERE emp_id = '$id'");


          
          $sql = mysqli_query($con,"SELECT * FROM allowance WHERE id ='$id'");
          if(mysqli_num_rows($sql)>0){
            while ($r=mysqli_fetch_assoc($sql)) {
              $allowance =$r['rate']; 
            }
          }
          $status = 0;      
          $sql = mysqli_query($con,"UPDATE employee set status='$status'  WHERE emp_id ='$id'");
          $sql = mysqli_query($con,"SELECT * from deductions WHERE deduction_id ='$id'");
            if(mysqli_num_rows($sql)>0){
              while ($row=mysqli_fetch_assoc($sql)) {
                $deduction_cs         = $row['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row['groceries'];//Groceries
                $deduction_bugas      = $row['bugas'];//Bugas
                $deduction_ga         = $row['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row['c_a'];//Cash advance
              }
            }else{
              $deduction_cs         = 0;//cunstruction supply
              $deduction_groceries  = 0;//Groceries
              $deduction_bugas      = 0;//Bugas
              $deduction_ga         = 0;//Gails Apparel's
              $deduction_ca         = 0;//Cash advance
              $days                 = 0;//work of time
              $hour                 = 0;//Overtime
              mysqli_query($con,"INSERT INTO deductions VALUES('$id','$deduction_cs','$deduction_groceries','$deduction_bugas','$deduction_ga','$deduction_ca','')");
            }
          $query  = mysqli_query($con,"SELECT * from employee where emp_id= '$id'");
          while($row=mysqli_fetch_array($query)){
            $lname           = $row['lname'];
            $fname           = $row['fname'];
            $days_of_work    = $row['days_of_work'];
            $rate            = $row['rate'];
            $overtime        = $row['overtime'];
            $amount          = $row['rate'] * $row['days_of_work'];
            if($rate >= 200 && $rate <= 250 ){
              $time_rate  = 25;
            }elseif($rate < 200 ){
              $rate1      = $rate / 8; 
              $time_rate  = $rate1;
            }else{
              $rate1      = $rate  - 50;
              $time_rate  = $rate1 / 8;
            } 
    
            $ot_rate         = $row['overtime'] * $time_rate; 
            $total_amount    = $amount + $ot_rate + $allowance; 
            $query1  = mysqli_query($con,"SELECT * from deductions where deduction_id = '$id'");
              while($row1=mysqli_fetch_array($query1)){
                $deduction_cs         = $row1['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row1['groceries'];//Groceries
                $deduction_bugas      = $row1['bugas'];//Bugas
                $deduction_ga         = $row1['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row1['c_a'];//Cash advance
                $deduction            = $row1['to_ded'];
              }
              $payout   = $total_amount - $deduction;
          }
          mysqli_query($con,"UPDATE _date set _date=CURRENT_DATE() where id = 1");
          $sql= mysqli_query($con,"SELECT * FROM _date");
          if($sql) {
            while ($row = mysqli_fetch_assoc($sql)) {
              $date = $row['_date'];
            }
          }else{
            ?>
              <script>
                alert('Invalid.');
              </script>
            <?php 
          }
          ?>

   
    
      
          <div class="col-sm-12">
            <img class="pull-left" src="../assets/logo.png" style="width: 80px; height: 50px; padding: 0; margin-top: 0px; left: 0;">
            <label class="pull-right">Date : <?php echo $date; ?></label>
          </div>
          <div>
            <label ></label>
          </div>  
          <div>
            <div ><h4 style="margin-left: 20%;"><?php echo $lname; ?>, <?php echo $fname; ?></h4></div>
          </div>
        
          <div class="col-sm-12">
            <label>Days of work :  </label>
            <label class="pull-right"><strong  ><?php echo $days_of_work; ?></strong></label>
          </div>
          <div class="col-sm-12">
            <label>Rate : </strong></label>
            <label class="pull-right"><strong  ><?php echo $rate; ?></label>
          </div>

          <!-- start overtime-->
          <div class="col-sm-12">
             <label >Overtime :  </strong></label>
             <label class="pull-right"><strong ><?php echo $overtime; ?></label> 
          </div>
          <div class="col-sm-12">
            <label ">Overtime Rate :  </label>
            <label class="pull-right"> <strong ><?php echo $time_rate; ?></strong></label>
          </div>
          
          <!--end overtime-->
          <div class="col-sm-12">
            <label style="padding-left: 50%;" class="padding-left">Salary :  </label>
            <label class="pull-right"><strong><?php echo $total_amount; ?></strong></label>
          </div>
          <div>
            <label></label>
          </div>
          <div class="form-group">
          <div class="col-sm-4">
            <div ><h4 style="margin-left: 20%;" >Deduction/s </h4></div>
          </div>
        </div>
        <!--start deduction-->
        <?php
        if ($deduction_cs!=0) {
          ?>
          <div class="col-sm-12">
            <label>Construction Supply :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_cs; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_groceries!=0) {
          ?>
          <div class="col-sm-12">
            <label>Groceries : </label>
            <label class="pull-right"><strong ><?php echo $deduction_groceries; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_bugas!=0) {
          ?>
          <div class="col-sm-12">
            <label >Bugas :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_bugas; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ga!=0) {
          ?>
          <div class="col-sm-12">
            <label >Gails Apparel's : </strong></label>
            <label class="pull-right"><strong  ><?php echo $deduction_ga; ?></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ca!=0) {
          ?>
          <div class="col-sm-12">
            <label>Cash Advance : </strong></label>
            <label class="pull-right"><strong ><?php echo $deduction_ca; ?></label>
          </div>
          <?php
        }
        ?>
        <div  class="col-sm-12">
          <label style="padding-left: 35%;">Total Deduction : </label>
          <label class="pull-right"><strong style="padding-left: 46px;" ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label ></label>
        </div>  
               
        <!--end deduction-->
               
        <div class="col-sm-12">
          <label >Salary : </label>
          <label class="pull-right"><strong ><?php echo $total_amount; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label>Total Deduction :</label>
          <label class="pull-right"> <strong ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label style="padding-left: 35%;"><h4>Total Salary : </h4></label>
          <label class="pull-right"><h4><strong ><?php echo $payout; ?></strong></h4></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div style="border-top: 2px solid #999;">
          <label style=" padding-left: 40%;">Signature </label>
        </div>
      <?php
      }
      ?>
      </td>
      <!--end print -->
   
    </tr>
      <!--7th print -->
      <td style="width:400px;" >
        <?php
          $query10 = $sql = mysqli_query($con,"SELECT * FROM print WHERE print = 0");
          if(mysqli_num_rows($query10)>0){
            while ($row10 = mysqli_fetch_assoc($query10)) {
              $id=$row10['emp_id'];
            }
          mysqli_query($con,"UPDATE print SET print = 1 WHERE emp_id = '$id'");


          
          $sql = mysqli_query($con,"SELECT * FROM allowance WHERE id ='$id'");
          if(mysqli_num_rows($sql)>0){
            while ($r=mysqli_fetch_assoc($sql)) {
              $allowance =$r['rate']; 
            }
          }
          $status = 0;      
          $sql = mysqli_query($con,"UPDATE employee set status='$status'  WHERE emp_id ='$id'");
          $sql = mysqli_query($con,"SELECT * from deductions WHERE deduction_id ='$id'");
            if(mysqli_num_rows($sql)>0){
              while ($row=mysqli_fetch_assoc($sql)) {
                $deduction_cs         = $row['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row['groceries'];//Groceries
                $deduction_bugas      = $row['bugas'];//Bugas
                $deduction_ga         = $row['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row['c_a'];//Cash advance
              }
            }else{
              $deduction_cs         = 0;//cunstruction supply
              $deduction_groceries  = 0;//Groceries
              $deduction_bugas      = 0;//Bugas
              $deduction_ga         = 0;//Gails Apparel's
              $deduction_ca         = 0;//Cash advance
              $days                 = 0;//work of time
              $hour                 = 0;//Overtime
              mysqli_query($con,"INSERT INTO deductions VALUES('$id','$deduction_cs','$deduction_groceries','$deduction_bugas','$deduction_ga','$deduction_ca','')");
            }
          $query  = mysqli_query($con,"SELECT * from employee where emp_id= '$id'");
          while($row=mysqli_fetch_array($query)){
            $lname           = $row['lname'];
            $fname           = $row['fname'];
            $days_of_work    = $row['days_of_work'];
            $rate            = $row['rate'];
            $overtime        = $row['overtime'];
            $amount          = $row['rate'] * $row['days_of_work'];
            if($rate >= 200 && $rate <= 250 ){
              $time_rate  = 25;
            }elseif($rate < 200 ){
              $rate1      = $rate / 8; 
              $time_rate  = $rate1;
            }else{
              $rate1      = $rate  - 50;
              $time_rate  = $rate1 / 8;
            }        
            $ot_rate         = $row['overtime'] * $time_rate; 
            $total_amount    = $amount + $ot_rate + $allowance; 
            $query1  = mysqli_query($con,"SELECT * from deductions where deduction_id = '$id'");
              while($row1=mysqli_fetch_array($query1)){
                $deduction_cs         = $row1['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row1['groceries'];//Groceries
                $deduction_bugas      = $row1['bugas'];//Bugas
                $deduction_ga         = $row1['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row1['c_a'];//Cash advance
                $deduction            = $row1['to_ded'];
              }
              $payout   = $total_amount - $deduction;
          }
          mysqli_query($con,"UPDATE _date set _date=CURRENT_DATE() where id = 1");
          $sql= mysqli_query($con,"SELECT * FROM _date");
          if($sql) {
            while ($row = mysqli_fetch_assoc($sql)) {
              $date = $row['_date'];
            }
          }else{
            ?>
              <script>
                alert('Invalid.');
              </script>
            <?php 
          }
          ?>
  
          <div class="col-sm-12">
            <img class="pull-left" src="../assets/logo.png" style="width: 80px; height: 50px; padding: 0; margin-top: 0px; left: 0;">
            <label class="pull-right">Date : <?php echo $date; ?></label>
          </div>
          <div>
            <label ></label>
          </div>  
          <div>
            <div ><h4 style="margin-left: 20%;"><?php echo $lname; ?>, <?php echo $fname; ?></h4></div>
          </div>
        
          <div class="col-sm-12">
            <label>Days of work :  </label>
            <label class="pull-right"><strong  ><?php echo $days_of_work; ?></strong></label>
          </div>
          <div class="col-sm-12">
            <label>Rate : </strong></label>
            <label class="pull-right"><strong  ><?php echo $rate; ?></label>
          </div>

          <!-- start overtime-->
          <div class="col-sm-12">
             <label >Overtime :  </strong></label>
             <label class="pull-right"><strong ><?php echo $overtime; ?></label> 
          </div>
          <div class="col-sm-12">
            <label ">Overtime Rate :  </label>
            <label class="pull-right"> <strong ><?php echo $time_rate; ?></strong></label>
          </div>
          
          <!--end overtime-->
          <div class="col-sm-12">
            <label style="padding-left: 50%;" class="padding-left">Salary :  </label>
            <label class="pull-right"><strong><?php echo $total_amount; ?></strong></label>
          </div>
          <div>
            <label></label>
          </div>
          <div class="form-group">
          <div class="col-sm-4">
            <div ><h4 style="margin-left: 20%;" >Deduction/s </h4></div>
          </div>
        </div>
        <!--start deduction-->
        <?php
        if ($deduction_cs!=0) {
          ?>
          <div class="col-sm-12">
            <label>Construction Supply :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_cs; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_groceries!=0) {
          ?>
          <div class="col-sm-12">
            <label>Groceries : </label>
            <label class="pull-right"><strong ><?php echo $deduction_groceries; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_bugas!=0) {
          ?>
          <div class="col-sm-12">
            <label >Bugas :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_bugas; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ga!=0) {
          ?>
          <div class="col-sm-12">
            <label >Gails Apparel's : </strong></label>
            <label class="pull-right"><strong  ><?php echo $deduction_ga; ?></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ca!=0) {
          ?>
          <div class="col-sm-12">
            <label>Cash Advance : </strong></label>
            <label class="pull-right"><strong ><?php echo $deduction_ca; ?></label>
          </div>
          <?php
        }
        ?>
        <div  class="col-sm-12">
          <label style="padding-left: 35%;">Total Deduction : </label>
          <label class="pull-right"><strong style="padding-left: 46px;" ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label ></label>
        </div>  
               
        <!--end deduction-->
               
        <div class="col-sm-12">
          <label >Salary : </label>
          <label class="pull-right"><strong ><?php echo $total_amount; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label>Total Deduction :</label>
          <label class="pull-right"> <strong ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label style="padding-left: 35%;"><h4>Total Salary : </h4></label>
          <label class="pull-right"><h4><strong ><?php echo $payout; ?></strong></h4></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div style="border-top: 2px solid #999;">
          <label style=" padding-left: 40%;">Signature </label>
        </div>

      <?php
      }
      ?>
      </td>
      <!--end print -->

      <!--8th print -->
       <td style="width:400px;" >
        <?php
          $query10 = $sql = mysqli_query($con,"SELECT * FROM print WHERE print = 0");
          if(mysqli_num_rows($query10)>0){
            while ($row10 = mysqli_fetch_assoc($query10)) {
              $id=$row10['emp_id'];
            }
          mysqli_query($con,"UPDATE print SET print = 1 WHERE emp_id = '$id'");


          
          $sql = mysqli_query($con,"SELECT * FROM allowance WHERE id ='$id'");
          if(mysqli_num_rows($sql)>0){
            while ($r=mysqli_fetch_assoc($sql)) {
              $allowance =$r['rate']; 
            }
          }
          $status = 0;      
          $sql = mysqli_query($con,"UPDATE employee set status='$status'  WHERE emp_id ='$id'");
          $sql = mysqli_query($con,"SELECT * from deductions WHERE deduction_id ='$id'");
            if(mysqli_num_rows($sql)>0){
              while ($row=mysqli_fetch_assoc($sql)) {
                $deduction_cs         = $row['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row['groceries'];//Groceries
                $deduction_bugas      = $row['bugas'];//Bugas
                $deduction_ga         = $row['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row['c_a'];//Cash advance
              }
            }else{
              $deduction_cs         = 0;//cunstruction supply
              $deduction_groceries  = 0;//Groceries
              $deduction_bugas      = 0;//Bugas
              $deduction_ga         = 0;//Gails Apparel's
              $deduction_ca         = 0;//Cash advance
              $days                 = 0;//work of time
              $hour                 = 0;//Overtime
              mysqli_query($con,"INSERT INTO deductions VALUES('$id','$deduction_cs','$deduction_groceries','$deduction_bugas','$deduction_ga','$deduction_ca','')");
            }
          $query  = mysqli_query($con,"SELECT * from employee where emp_id= '$id'");
          while($row=mysqli_fetch_array($query)){
            $lname           = $row['lname'];
            $fname           = $row['fname'];
            $days_of_work    = $row['days_of_work'];
            $rate            = $row['rate'];
            $overtime        = $row['overtime'];
            $amount          = $row['rate'] * $row['days_of_work'];
            if($rate >= 200 && $rate <= 250 ){
              $time_rate  = 25;
            }elseif($rate < 200 ){
              $rate1      = $rate / 8; 
              $time_rate  = $rate1;
            }else{
              $rate1      = $rate  - 50;
              $time_rate  = $rate1 / 8;
            }        
            $ot_rate         = $row['overtime'] * $time_rate; 
            $total_amount    = $amount + $ot_rate + $allowance; 
            $query1  = mysqli_query($con,"SELECT * from deductions where deduction_id = '$id'");
              while($row1=mysqli_fetch_array($query1)){
                $deduction_cs         = $row1['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row1['groceries'];//Groceries
                $deduction_bugas      = $row1['bugas'];//Bugas
                $deduction_ga         = $row1['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row1['c_a'];//Cash advance
                $deduction            = $row1['to_ded'];
              }
              $payout   = $total_amount - $deduction;
          }
          mysqli_query($con,"UPDATE _date set _date=CURRENT_DATE() where id = 1");
          $sql= mysqli_query($con,"SELECT * FROM _date");
          if($sql) {
            while ($row = mysqli_fetch_assoc($sql)) {
              $date = $row['_date'];
            }
          }else{
            ?>
              <script>
                alert('Invalid.');
              </script>
            <?php 
          }
          ?>

   
    
      
          <div class="col-sm-12">
            <img class="pull-left" src="../assets/logo.png" style="width: 80px; height: 50px; padding: 0; margin-top: 0px; left: 0;">
            <label class="pull-right">Date : <?php echo $date; ?></label>
          </div>
          <div>
            <label ></label>
          </div>  
          <div>
            <div ><h4 style="margin-left: 20%;"><?php echo $lname; ?>, <?php echo $fname; ?></h4></div>
          </div>
        
          <div class="col-sm-12">
            <label>Days of work :  </label>
            <label class="pull-right"><strong  ><?php echo $days_of_work; ?></strong></label>
          </div>
          <div class="col-sm-12">
            <label>Rate : </strong></label>
            <label class="pull-right"><strong  ><?php echo $rate; ?></label>
          </div>

          <!-- start overtime-->
          <div class="col-sm-12">
             <label >Overtime :  </strong></label>
             <label class="pull-right"><strong ><?php echo $overtime; ?></label> 
          </div>
          <div class="col-sm-12">
            <label ">Overtime Rate :  </label>
            <label class="pull-right"> <strong ><?php echo $time_rate; ?></strong></label>
          </div>
          
          <!--end overtime-->
          <div class="col-sm-12">
            <label style="padding-left: 50%;" class="padding-left">Salary :  </label>
            <label class="pull-right"><strong><?php echo $total_amount; ?></strong></label>
          </div>
          <div>
            <label></label>
          </div>
          <div class="form-group">
          <div class="col-sm-4">
            <div ><h4 style="margin-left: 20%;" >Deduction/s </h4></div>
          </div>
        </div>
        <!--start deduction-->
        <?php
        if ($deduction_cs!=0) {
          ?>
          <div class="col-sm-12">
            <label>Construction Supply :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_cs; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_groceries!=0) {
          ?>
          <div class="col-sm-12">
            <label>Groceries : </label>
            <label class="pull-right"><strong ><?php echo $deduction_groceries; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_bugas!=0) {
          ?>
          <div class="col-sm-12">
            <label >Bugas :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_bugas; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ga!=0) {
          ?>
          <div class="col-sm-12">
            <label >Gails Apparel's : </strong></label>
            <label class="pull-right"><strong  ><?php echo $deduction_ga; ?></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ca!=0) {
          ?>
          <div class="col-sm-12">
            <label>Cash Advance : </strong></label>
            <label class="pull-right"><strong ><?php echo $deduction_ca; ?></label>
          </div>
          <?php
        }
        ?>
        <div  class="col-sm-12">
          <label style="padding-left: 35%;">Total Deduction : </label>
          <label class="pull-right"><strong style="padding-left: 46px;" ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label ></label>
        </div>  
               
        <!--end deduction-->
               
        <div class="col-sm-12">
          <label >Salary : </label>
          <label class="pull-right"><strong ><?php echo $total_amount; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label>Total Deduction :</label>
          <label class="pull-right"> <strong ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label style="padding-left: 35%;"><h4>Total Salary : </h4></label>
          <label class="pull-right"><h4><strong ><?php echo $payout; ?></strong></h4></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div style="border-top: 2px solid #999;">
          <label style=" padding-left: 40%;">Signature </label>
        </div>

      <?php
      }
      ?>
      </td>
      <!--end print -->

      <!--9th print -->
      <td style="width:400px;" >
      <?php
          $query10 = $sql = mysqli_query($con,"SELECT * FROM print WHERE print = 0");
          if(mysqli_num_rows($query10)>0){
            while ($row10 = mysqli_fetch_assoc($query10)) {
              $id=$row10['emp_id'];
            }
          mysqli_query($con,"UPDATE print SET print = 1 WHERE emp_id = '$id'");


          
          $sql = mysqli_query($con,"SELECT * FROM allowance WHERE id ='$id'");
          if(mysqli_num_rows($sql)>0){
            while ($r=mysqli_fetch_assoc($sql)) {
              $allowance =$r['rate']; 
            }
          }
          $status = 0;      
          $sql = mysqli_query($con,"UPDATE employee set status='$status'  WHERE emp_id ='$id'");
          $sql = mysqli_query($con,"SELECT * from deductions WHERE deduction_id ='$id'");
            if(mysqli_num_rows($sql)>0){
              while ($row=mysqli_fetch_assoc($sql)) {
                $deduction_cs         = $row['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row['groceries'];//Groceries
                $deduction_bugas      = $row['bugas'];//Bugas
                $deduction_ga         = $row['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row['c_a'];//Cash advance
              }
            }else{
              $deduction_cs         = 0;//cunstruction supply
              $deduction_groceries  = 0;//Groceries
              $deduction_bugas      = 0;//Bugas
              $deduction_ga         = 0;//Gails Apparel's
              $deduction_ca         = 0;//Cash advance
              $days                 = 0;//work of time
              $hour                 = 0;//Overtime
              mysqli_query($con,"INSERT INTO deductions VALUES('$id','$deduction_cs','$deduction_groceries','$deduction_bugas','$deduction_ga','$deduction_ca','')");
            }
          $query  = mysqli_query($con,"SELECT * from employee where emp_id= '$id'");
          while($row=mysqli_fetch_array($query)){
            $lname           = $row['lname'];
            $fname           = $row['fname'];
            $days_of_work    = $row['days_of_work'];
            $rate            = $row['rate'];
            $overtime        = $row['overtime'];
            $amount          = $row['rate'] * $row['days_of_work'];
            if($rate >= 200 && $rate <= 250 ){
              $time_rate  = 25;
            }elseif($rate < 200 ){
              $rate1      = $rate / 8; 
              $time_rate  = $rate1;
            }else{
              $rate1      = $rate  - 50;
              $time_rate  = $rate1 / 8;
            }        
            $ot_rate         = $row['overtime'] * $time_rate; 
            $total_amount    = $amount + $ot_rate + $allowance; 
            $query1  = mysqli_query($con,"SELECT * from deductions where deduction_id = '$id'");
              while($row1=mysqli_fetch_array($query1)){
                $deduction_cs         = $row1['const_suplly'];//cunstruction supply
                $deduction_groceries  = $row1['groceries'];//Groceries
                $deduction_bugas      = $row1['bugas'];//Bugas
                $deduction_ga         = $row1['gails_apparel'];//Gails Apparel's
                $deduction_ca         = $row1['c_a'];//Cash advance
                $deduction            = $row1['to_ded'];
              }
              $payout   = $total_amount - $deduction;
          }
          mysqli_query($con,"UPDATE _date set _date=CURRENT_DATE() where id = 1");
          $sql= mysqli_query($con,"SELECT * FROM _date");
          if($sql) {
            while ($row = mysqli_fetch_assoc($sql)) {
              $date = $row['_date'];
            }
          }else{
            ?>
              <script>
                alert('Invalid.');
              </script>
            <?php 
          }
          ?>

          <div class="col-sm-12">
            <img class="pull-left" src="../assets/logo.png" style="width: 80px; height: 50px; padding: 0; margin-top: 0px; left: 0;">
            <label class="pull-right">Date : <?php echo $date; ?></label>
          </div>
          <div>
            <label ></label>
          </div>  
          <div>
            <div ><h4 style="margin-left: 20%;"><?php echo $lname; ?>, <?php echo $fname; ?></h4></div>
          </div>
        
          <div class="col-sm-12">
            <label>Days of work :  </label>
            <label class="pull-right"><strong  ><?php echo $days_of_work; ?></strong></label>
          </div>
          <div class="col-sm-12">
            <label>Rate : </strong></label>
            <label class="pull-right"><strong  ><?php echo $rate; ?></label>
          </div>

          <!-- start overtime-->
          <div class="col-sm-12">
             <label >Overtime :  </strong></label>
             <label class="pull-right"><strong ><?php echo $overtime; ?></label> 
          </div>
          <div class="col-sm-12">
            <label ">Overtime Rate :  </label>
            <label class="pull-right"> <strong ><?php echo $time_rate; ?></strong></label>
          </div>
          
          <!--end overtime-->
          <div class="col-sm-12">
            <label style="padding-left: 50%;" class="padding-left">Salary :  </label>
            <label class="pull-right"><strong><?php echo $total_amount; ?></strong></label>
          </div>
          <div>
            <label></label>
          </div>
          <div class="form-group">
          <div class="col-sm-4">
            <div ><h4 style="margin-left: 20%;" >Deduction/s </h4></div>
          </div>
        </div>
        <!--start deduction-->
        <?php
        if ($deduction_cs!=0) {
          ?>
          <div class="col-sm-12">
            <label>Construction Supply :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_cs; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_groceries!=0) {
          ?>
          <div class="col-sm-12">
            <label>Groceries : </label>
            <label class="pull-right"><strong ><?php echo $deduction_groceries; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_bugas!=0) {
          ?>
          <div class="col-sm-12">
            <label >Bugas :  </label>
            <label class="pull-right"><strong ><?php echo $deduction_bugas; ?></strong></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ga!=0) {
          ?>
          <div class="col-sm-12">
            <label >Gails Apparel's : </strong></label>
            <label class="pull-right"><strong  ><?php echo $deduction_ga; ?></label>
          </div>
          <?php
        }
        ?>
        <?php
        if ($deduction_ca!=0) {
          ?>
          <div class="col-sm-12">
            <label>Cash Advance : </strong></label>
            <label class="pull-right"><strong ><?php echo $deduction_ca; ?></label>
          </div>
          <?php
        }
        ?>
        <div  class="col-sm-12">
          <label style="padding-left: 35%;">Total Deduction : </label>
          <label class="pull-right"><strong style="padding-left: 46px;" ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label ></label>
        </div>  
               
        <!--end deduction-->
               
        <div class="col-sm-12">
          <label >Salary : </label>
          <label class="pull-right"><strong ><?php echo $total_amount; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label>Total Deduction :</label>
          <label class="pull-right"> <strong ><?php echo $deduction; ?></strong></label>
        </div>
        <div class="col-sm-12">
          <label style="padding-left: 35%;"><h4>Total Salary : </h4></label>
          <label class="pull-right"><h4><strong ><?php echo $payout; ?></strong></h4></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div>
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div >
          <label ></label>
        </div>
        <div style="border-top: 2px solid #999;">
          <label style=" padding-left: 40%;">Signature </label>
        </div>

      <?php
      }
      ?>
      </td>
      <!--end print -->

   
    </tr>
    </table>
  </div>


        


  <div style="border: solid 2px #999fff; float: left; margin-left: 20px;" class="hidden SettingsBox">
    <div style="width: 400px; padding: 20px;">
        
      <div style="padding: 0 10px 10px;" class="buttonBar">
          <div class="button b1">Print</div>
          <div class="toggleDialog">open dialog</div>
        </div>


  <div class="hidden testDialog">
    <div>
        This is Print Area 3
    </div>
  </div>
        <div style="font-weight: bold; border-top: solid 1px #999fff; padding-top: 10px;">Settings</div>
        <table>
          <tbody>
          <tr>
            <td><input value="popup" name="mode" id="popup"  type="radio" hecked=""> Popup</td>
          </tr>
          <tr>
            <td style="padding-left: 20px;"><input value="popup" name="popup" id="closePop" type="checkbox"> Close popup</td>
          </tr>
          <tr>
            <td><input value="iframe" name="mode" id="iFrame" type="radio" checked=""> IFrame</td>
          </tr>
          <tr>
            <td>Extra css: <input type="text" name="extraCss" size="50" /></td>
          </tr>
          <tr>
            <td><div class="settingName">Print area:</div>
              <div class="settingVals">
                <input type="checkbox" class="selPA" value="area1" checked /> Area 1<br>
                <input type="checkbox" class="selPA" value="area2" checked /> Area 2<br>
                <input type="checkbox" class="selPA" value="area3" checked /> Area 3<br>
              </div>
            </td>
          </tr>
          <tr>
            <td><div class="settingName">Retain Attributes:</div>
              <div class="settingVals">
                <input type="checkbox" checked name="retainCss"   id="retainCss" class="chkAttr" value="class" /> Class
                <br>
                <input type="checkbox" checked name="retainId"    id="retainId"  class="chkAttr" value="id" /> ID
                <br>
                <input type="checkbox" checked name="retainStyle" id="retainId"  class="chkAttr" value="style" /> Style
              </div>
            </td>
          </tr>
          <tr>
            <td><div style="padding: 3px; border: solid 1px #ddd;">Add to head :
                    <input type="checkbox" checked name="addElements" id="addElements" class="chkAttr" />
                    <pre>&lt;meta charset="utf-8" /&gt;<br>&lt;http-equiv="X-UA-Compatible" content="IE=edge"/&gt;</pre>
                </div>
            </td>
          </tr>
        </tbody></table>
    </div>
  </div>

  <script>
    $(document).ready(function(){

       
        $("button#payout").click(function(){

            var mode = $("input[name='mode']:checked").val();
            var close = mode == "popup" && $("input#closePop").is(":checked");
            var extraCss = $("input[name='extraCss']").val();

            var print = "";
            $("input.selPA:checked").each(function(){
                print += (print.length > 0 ? "," : "") + "div.PrintArea." + $(this).val();
            });

            var keepAttr = [];
            $(".chkAttr").each(function(){
                if ($(this).is(":checked") == false )
                    return;

                keepAttr.push( $(this).val() );
            });

            var headElements = $("input#addElements").is(":checked") ? '<meta charset="utf-8" />,<meta http-equiv="X-UA-Compatible" content="IE=edge"/>' : '';

            var options = { mode : mode, popClose : close, extraCss : extraCss, retainAttr : keepAttr, extraHead : headElements };

            $( print ).printArea( options );
        });

        $("input[name='mode']").click(function(){
            if ( $(this).val() == "iframe" ) $("#closePop").attr( "checked", false );
        });
    });

  </script>
  <script src="assets/js/bootstrap.min.js"></script>
    <!-- <script src="assets/js/docs.min.js"></script> -->
    <script src="assets/js/search.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/dataTables.min.js"></script>
    <!-- FOR DataTable -->
    <script>
      {
        $(document).ready(function()
        {
          $('#myTable').DataTable();
        });
      }
    </script>

    <!-- this function is for modal -->
    <script>
      $(document).ready(function()
      {
        $("#myBtn").click(function()
        {
          $("#myModal").modal();
        });
      });
    </script>

  </body>
</html>