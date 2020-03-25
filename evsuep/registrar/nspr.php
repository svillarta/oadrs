<?php
if(isset($_POST['ncspr'])) {
$ftid = $_POST['ftid'];
$qty = $_POST['qty'];
$date = date("Y/m/d");
$srid = $_GET['srid'];
$sr = $_GET['sr'];
$p = $_GET['p'];
}else{
	header("location:./");
}

include '../db_config/connection.php';

$ui1 = mysql_query("select * from fee_type where ftid='$ftid' ")or die(mysql_error());
$cui1= mysql_num_rows($ui1);
if($cui1 > 0)
{
	$ui_row1 = mysql_fetch_array($ui1);
	$amount = $ui_row1['amount'];
}


$ui = mysql_query("select * from s_request where srid='$srid' ")or die(mysql_error());
$cui= mysql_num_rows($ui);
if($cui > 0)
{
	$ui_row = mysql_fetch_array($ui);
	$sid = $ui_row['sid'];
}

$tamount = $amount * $qty;

$savenot = mysql_query("insert into s_payment (srid, sid, ftid, sdate, samount, remarks)
VALUES ('$srid', '$sid', '$ftid', '$date', '$tamount', 'unpaid')")or die(mysql_error());


header("location:cspr.php?srid=$srid&sr=$sr&p=$p");

$conn->close();

?>
