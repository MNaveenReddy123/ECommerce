<?php
session_start();
//  print_r($_POST);
//  echo "<br>";
//  print_r($_FILES['pdtimg']);
 $source=$_FILES['pdtimg']['tmp_name'];
 $target= "../shared/images/".$_FILES['pdtimg']['name'];
 
 move_uploaded_file($source,$target);
 include "../shared/connection.php";

 mysqli_query($conn,"insert into product (name,price,detail,impath,owner)
 values('$_POST[pname]',
        '$_POST[pprice]',
        '$_POST[pdetail]',
        '$target',
        $_SESSION[user_id])
 ");

?>