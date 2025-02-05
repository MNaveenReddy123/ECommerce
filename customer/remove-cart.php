<?php
 include "../shared/connection.php";
 include "authguard.php";
 $cartid=$_GET['cartid'];
 mysqli_query($conn,"delete from cart where cartid=$cartid");
 header("location:view-cart.php") ;
?>