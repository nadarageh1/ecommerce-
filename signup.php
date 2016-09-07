<?php
$pageTitle="Sign UP";
include 'init.php';
if($_SERVER['REQUEST_METHOD'] =='POST'){
  if(isset($_POST['signup'])){
    $formErrors = array();
    $username = $_POST['name'];
    $password = $_POST['pass'];
    $password2= $_POST['pass2'];
    $email    = $_POST['email'];
    if(isset($username)){
      // FILTER_SANITIZE_STRING prevent hacked and filter input
      $filteredUser =filter_var($username,FILTER_SANITIZE_STRING);
      if(strlen($filteredUser)<4){
        $formErrors[]= 'Username Must Be Larger Than 4 Characters ';
      }

    }
      if(isset($password)&& isset($password2) ){
       $pass1 = sha1($password);
       $pass2 = sha1($password2);
        // when check check $password because 
     //empty string has hashed in sh1 that mean 
     //if i check the $hashedpass for ever dont return mistake
        if(empty($password)){
         $formErrors[]= 'Password Can Not Be Empty '; 
        }
 
       if($pass1 !== $pass2){
       $formErrors[]= 'Sorry, Password is Not Matched ';
       }
    }
    // validate Email
      if(isset($email)){
      // FILTER_SANITIZE_STRING prevent hacked and filter input
      $filteredEmail =filter_var($email,FILTER_SANITIZE_EMAIL);
      if(filter_var($filteredEmail,FILTER_VALIDATE_EMAIL) !=true){
        $formErrors[]= 'This Email Is Not Valid';
      }
    }
    if(empty($formErrors)){
           // check if User Exist in Database
       /*  i create function  checkItems  
      to check if that item or user or category there is in database or not
      this function is in (includes/functions/functions.php) *prevent dublicated*
       */
          $check =checkItems("username","users",$username);
          if($check == 1){
              $formErrors[]= 'This Username Is Already Exist';

          }
          else{
                     $stmt = $conn->prepare("INSERT INTO
                             users(username,password,email,regstatus,date)
                             VALUES
                             (:username,:password,:email,0,now())
                             ;");
        $stmt->execute(
        array(  
      ':username'  =>$username,
      ':password'  =>$pass1,
      ':email'     =>$email,
      ));
        
     $suceesMSG ="Congerate, Now you Registered";
         
     }    
    }
  }
}

 include'views/users/login.php';




?>