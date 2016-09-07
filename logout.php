<?php 
// start session
session_start();
// unset or destroy to data
session_unset();
// destroy for session 
session_destroy();


 header("Location: index.php"); // redirect to dashboard page 
   exit();



?>