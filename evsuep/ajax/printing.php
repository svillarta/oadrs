<?php
session_start();
include ('../db_config/connection.php');
$output = '';
$userId = $_SESSION['uid'];
$sid = $_POST['sid'];
$total = 0;

$query1 = mysqli_query($conn,"SELECT * FROM user_info WHERE uid = '$userId'");
while ($row1 = mysqli_fetch_assoc($query1)) {
  $cfName = $row1['fname'];
  $cmi = $row1['mi'];
  $clName = $row1['lname'];
  $cashierFullName =  $cfName.' '.$cmi.'. '.$clName;
}

$queryStudent = mysqli_query($conn,"SELECT * FROM online_account WHERE sid ='$sid'");
if (mysqli_num_rows($queryStudent)>0) {

	while ($rowStudent = mysqli_fetch_assoc($queryStudent)) {
		$lname = $rowStudent['lname'];
		$mi = $rowStudent['mi'];
		$fname = $rowStudent['fname'];

		$fullname = $lname.', '.$fname.' '.$mi.'.';
	}
	$output .= '
		<table style="margin-bottom: 10px;">
          <thead>
            <tr>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center> </th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="2" style="font-size: 12px; font-weight:normal">Accounttable No. 51 <br> Revised February 2008<br></td>
              <td colspan="3"></td>
              <td colspan="2" style="font-size: 13px; " align="right">ORIGINAL</td>
            </tr>
            <tr><td></td> </tr>
            <tr>
              <td colspan="1"><center><img class="ph" src="../../images/Philippines.png"></center></td>
              <td colspan="5">
                <center>
                  <span class="head" style="font-size: 12px; font-weight:normal">Republic of the Philippines</span><br> 
                  <span class="head" style="font-size: 13px; ">EASTERN VISAYAS STATE UNIVERSITY</span><br> 
                  <span class="head" style="font-size: 12px; font-weight:normal">ORMOC CITY CAMPUS</span><br> 
                  <span class="head" style="font-size: 12px; font-weight:normal">Ormoc City</span><br> 
                </center>
              </td>
              <td><center><img class="ph" src="../../images/evsu.png"></center></td>
            </tr>
            <tr>
              <td colspan="4"></td>
              <td colspan="3"><span style="font-size: 13px; font-weight:normal">No. EVSU - OCC:</span></td>
            </tr>
            <tr>
              <td colspan="7" class="head"><center>OFFICIAL RECEIPT</center></td>
            </tr>
            <tr>
              <td ><span style="font-size: 13px; font-weight:normal; ">Payor:</span></td>
              <td colspan="3" style="border-bottom: 1px solid black;">'.$fullname.'</td>
              <td ><span style="font-size: 13px; font-weight:normal;">Date:</span></td>
              <td colspan="2" style="border-bottom: 1px solid black;">'.date("m/d/Y").'</td>
            </tr>
            <tr >
              <td > </td>
            </tr>
          </tbody>
        </table>
       

        <table style="margin-bottom: 10px; border: 1px solid black;" >
          <thead >
            <tr style="font-size: 13px; font-weight:normal;">
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center> </th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
              
            </tr>
          </thead>
          <tbody style="font-size: 13px; font-weight:normal;">
          <tr>
	          <th colspan="3" style="border: 1px solid black;"><center>Nature of Collection</center></th>
	          <th colspan="2" style="border: 1px solid black;"><center>Account Code</center> </th>
	          <th colspan="2" style="border: 1px solid black;"><center>Amount</center></th>
	        </tr>';
}else{

}

$query = mysqli_query($conn,"SELECT * FROM s_payment WHERE sid ='$sid' AND remarks ='Ready'");
if(mysqli_num_rows($query)>0){
	while ($row =mysqli_fetch_assoc($query)) {
		$spid = $row['spid'];
		$srid = $row['srid'];
		$sid = $row['sid'];
		$pages = $row['pages'];
		$samount = $row['samount'];
		$remarks = $row['remarks'];
		if ($remarks =='Ready') {
			$status = 'Not paid';
		}else if ($remarks =='Paid') {
			$status = 'Paid';
		}
		if ($pages == 1) {
			$page = 'page';

		}else{
			$page = 'pages';

		}
		$querySReq = mysqli_query($conn,"SELECT * FROM s_request WHERE srid ='$srid'");
		if (mysqli_num_rows($querySReq)>0) {
			while ($rowSReq = mysqli_fetch_assoc($querySReq)) {
				$srid = $rowSReq['srid'];
				$srequest = $rowSReq['srequest'];
				$purpose = $rowSReq['purpose'];
				if ($srequest == 'TRANSCRIPT OF RECORD') {
					$newsamount = $samount - 40;
				}else{
					$newsamount = $samount;
				}
			}
			$total = $newsamount + $total;

			$output .='
					
		            <tr>
		              <td colspan="3" style="border-right: 1px solid black;">'.$srequest.'-'.$pages.''.$page.'</td>
		              <td colspan="2" style="border-right: 1px solid black;"></td>
		              <td colspan="2" style="border-right: 1px solid black;">'.$newsamount.'</td>
		            </tr>'; 	
		}else{

		}

	}

	$num = $total;
	function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}
	$output .='
            <tr>
              <td colspan="3" style="border-right: 1px solid black;">Documentary Stamp-2pcs</td>
              <td colspan="2" style="border-right: 1px solid black;"></td>
              <td colspan="2" style="border-right: 1px solid black;">40</td>
            </tr>
            <tr>
              <td colspan="5" style="border: 1px solid black;" class="btn-sm"><span class="pull-left">Fund</span> <span class="pull-right">TOTAL</span> </td>
              <td colspan="2" style="border: 1px solid black;">
              	<span style="font-size: 15px; font-weight:normal;">&#8369;</span> '.$total.'</td>
            </tr>
            <tr>
              <td colspan="7" class="btn-sm">Amount in Words: <b style="text-transform: uppercase;">'.convertNumberToWord("$num").'PESOS</b></td>
            </tr>
          </tbody>
        </table>

        <table >
          <thead>
            <tr>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center> </th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
              <th width="70" class="btn-sm"><center></center></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="7" style="font-size: 12px; font-weight:normal">Remarks: <br><br> Mode of Payment:<br></td>
            </tr>
            <tr style="font-size: 12px; font-weight:normal" style="border: 1px solid black;">
              <td style="border: 1px solid black;" colspan="1" ><center>Cash</center> </td>
              <td style="border: 1px solid black;" colspan="4" rowspan="2" ><center>Drawee Bank</center> </td>
              <td style="border: 1px solid black;" colspan="1"  rowspan="2" ><center>Number</center> </td> 
              <td style="border: 1px solid black;" colspan="1"  rowspan="2" ><center>Date</center> </td> 
            </tr>
            <tr>
              <td  colspan="1" style="font-size: 12px; font-weight:normal; border: 1px solid black;"><center>Cheque</center> </td>
            </tr>
            <tr style="font-size: 12px; font-weight:normal">
              <td style="border: 1px solid black;" colspan="5"><center>Postal/Money Order</center> </td>
              <td style="border: 1px solid black;" colspan="1"><center></center> </td>
              <td style="border: 1px solid black;" colspan="1"><center></center> </td>
            </tr>
            <tr>
              <td colspan="7" style="padding-top: 3px;"> </td>
            </tr>
            <tr style="font-size: 12px; font-weight:normal; ">
              <td colspan="7"><center><i>Received the amount stated above</i></center> </td>
              
            </tr>
            
            <tr style="font-size: 12px; font-weight:normal;">
              <td colspan="5"><i>Noted: Write the number and date of this receipt at the</i> </td>
              <td colspan="2" style="border-bottom: 1px solid black;"><center>'.$cashierFullName.'</center> </td>
              
            </tr>
            <tr style="font-size: 12px; font-weight:normal;">
              <td colspan="5"><i>back of check or money order received.</i> </td>
              <td colspan="2"><center>Collecting Officer</center> </td>
              
            </tr>
            
          </tbody>
        </table>
			';
}else{

}

echo $output;
?>