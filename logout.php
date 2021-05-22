<?php 
session_start();
unset($_SESSION['admins']);
header("location:loginpanel.php");
exit;

?>