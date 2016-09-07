<?php
ob_start();
@session_start();
$pageTitle="Login Page";
if(isset($_SESSION['user'])){
 header("Location: profile.php");
 exit();
}
include 'init.php';
include 'views/users/login.php';
if($_SERVER['REQUEST_METHOD'] =='POST'){
  if(isset($_POST['login'])){
   
  $username   =$_POST['username'];
  $password   =$_POST['password'];
  $hashedPass =sha1($password);
  // check if the user is exist in the Database
  $stmt = $conn->prepare("SELECT 
                             id,username , password ,regstatus  
                          FROM 
                             users 
                          WHERE 
                             username =:username 
                          AND 
                             password =:password 
                             ;");
  $stmt->execute(
  array(
':username'  =>$username,
':password' =>$hashedPass
));
  $user  =$stmt->fetch();
  $count =$stmt->rowCount();
 // if $count >0 this mean the website has information about that record
  if($count>0){
    // to store username to use it in another page
  $_SESSION['user']   =$username;
  $_SESSION['user_id']=$user['id']; // Register Session Id
  $_SESSION['reg']    =$user['regstatus'];
 header("Location: profile.php"); // redirect to index page 
   exit(); 
   }
  }
}
ob_end_flush();
?>