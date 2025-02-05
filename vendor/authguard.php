<?php
session_start(); // Start the session

// Check if the user is logged in and has the correct usertype
if(!isset($_SESSION["login_status"])){
    echo "illegal attempt  by skipping login";
    die;
}
if($_SESSION["login_status"] ==false){
    echo "unoatharised access";
    die;

}


// Check if the user is a vendor
if ($_SESSION["usertype"] != "vendor") {
    echo "Forbidden access. Only vendors are allowed.";
    die();
}
?>