<?php 
@session_start();
$pageTitle = "Profile Page";
include 'init.php';
if(isset($_SESSION['user'])){
	if($_SESSION['reg']==1){
$informations = getAllFrom("*","users","WHERE username='{$_SESSION['user']}'","","id","ASC");
if(!empty($informations)){
		 include_once 'views/users/profile.php';	
}	
}
  else{
        echo '<div class="container">';
              echo '<div class="alert alert-danger">
              This User Is Waiting Approval</div>';
          echo '</div>';
  }
}
else{
	header("Location: login.php");
}
?>
