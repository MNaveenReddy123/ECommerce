<?php
session_start(); // Start the session
session_destroy(); // Destroy the session
header("location:login.html"); // Redirect to login page
exit();
?>
