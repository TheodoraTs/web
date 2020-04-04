<?php	//Destroy the session along with its variables and redirect to the login page
session_start();
session_destroy();
header("location:login_admin.php");
?>