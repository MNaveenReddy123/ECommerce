<?php 
$pid= $_GET['pid'];
include "../shared/connection.php";
include "authguard.php";
mysqli_query($conn,"insert into cart(userid,pid) values($_SESSION[user_id],$pid)");
header("location:view-cart.php");
?>