<?php
session_start();
include 'init.php';
if($_SERVER['REQUEST_METHOD'] =='POST'){
  $username   =$_POST['user'];
  $password   =$_POST['pass'];
  $hashedPass =sha1($password);
  // check if the user is exist in the Database
  $stmt = $conn->prepare("SELECT 
                             username , password ,id
                          FROM 
                             users 
                          WHERE 
                             username =:username 
                          AND 
                             password =:password 
                          AND 
                             groupid=1
                          LIMIT 1
                             ;");
  $stmt->execute(
  array(
':username'  =>$username,
':password' =>$hashedPass
));
  // to take  all data from database to work with them 
  $row = $stmt->fetch();
  $count =$stmt->rowCount();
 // if $count >0 this mean the website has information about that record
  if($count>0){
    // to store username to use it in another page
  $_SESSION['username'] =$username;
  // to store it to use it in another page
  $_SESSION['id'] = $row['id'];  // rgister session id
  header("Location: dashboard.php"); // redirect to dashboard page 
   exit();
   

  }
  else{
      header("Location: index.php"); // redirect to dashboard page 
   exit();
  }


}



?>