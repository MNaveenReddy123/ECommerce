<?php
  $pid=$_GET['pid'];
  echo "recieved pid $pid";
  include "../shared/connection.php";
  mysqli_query($conn,"delete from product where pid=$pid");
  header("Location:view.php");

?>