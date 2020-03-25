
<?php
include('../db_config/connection.php');
if(isset($_POST['ndep'])) {
$dep = $_POST['dep'];
$dep_query = mysql_query("select * from department where dep='$dep' ")or die(mysql_error());
$count_dep = mysql_num_rows($dep_query);

if ($count_dep > 0){
  echo "<script>
  alert('Department Already Exist!');
  window.location = 'cdep.php';
  </script>";

  }else{
    $saveua = mysql_query("insert into department (dep) values ('$dep')")or die(mysql_error());

    echo "<script>
    alert('Successfully Added!');
    window.location = 'cdep.php';
    </script>";
    exit();
  }
}
?>
