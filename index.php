<?php 
ob_start();
$pageTitle = "Home Page";
include 'init.php';
     include'views/items/homepage.php';

ob_end_flush();
?>
