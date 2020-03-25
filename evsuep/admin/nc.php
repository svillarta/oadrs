
<?php
include('../db_config/connection.php');
if(isset($_POST['nc'])) {
$course = $_POST['course'];
$c_query = mysql_query("select * from course where course='$course' ")or die(mysql_error());
$count_c = mysql_num_rows($c_query);

if ($count_c > 0){
  echo "<script>
  alert('Course Already Exist!');
  window.location = 'cc.php';
  </script>";

  }else{
    $savec = mysql_query("insert into course (course) values ('$course')")or die(mysql_error());

    echo "<script>
    alert('Successfully Added!');
    window.location = 'cc.php';
    </script>";
    exit();
  }
}
?>
