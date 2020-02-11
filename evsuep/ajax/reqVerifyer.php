<?php
include '../db_config/connection.php';
$sid = $_POST['sid'];
$srid = $_POST['srid'];
$srequest = $_POST['srequest'];

?>

    
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 ">
            <?php
            if ($srequest =='TRANSCRIPT OF RECORD') {
            	?>
            	<p style="background-color: #D1D0CE">How many page for <code ><?php echo $srequest; ?></code>?</p>
            	<?php
            }else{
            	?>
            	<p style="background-color: #D1D0CE">You approve <code ><?php echo $srequest; ?></code> request</p>
            	<?php
            }
            ?>
              
              <hr>
              <input type="hidden" name="" id="srid" value="<?php echo $srid; ?>">
              <input type="hidden" name="" id="sid" value="<?php echo $sid; ?>">
            </div>

            <div class="row">

        	<?php
            if ($srequest =='TRANSCRIPT OF RECORD') {
            	?>
            	<div class="col-md-12 input-group form-control-lg">
	                <div class="input-group-prepend">
	                  <span class="input-group-text">
	                    <i class="material-icons">edit</i>
	                  </span>
	                </div>
	                <div class="form-group bmd-form-group">
	                  <label for="contactNo" class="bmd-label-floating">Page Count</label>
	                  <input type="number" class="form-control col-md-12" id="pageCount" name="contactNo" required="" >
	                </div>
	              </div>
            	<?php
            }else{
            	?>
            	<input type="hidden" class="form-control col-md-12" id="pageCount" name="contactNo" required="" value="1">
            	<?php
            }
            ?>
              
              
            </div>

          </div>
        </div>
      </div>
      
  

<?php

?>