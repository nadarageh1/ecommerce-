<?php
/*
==========================================
== manage members page
== you can Add | Edit | Delete members from here
==that is like AdminsController in laravel
========================================
*/
@session_start();
$pageTitle = "Members Page";
// start 
if (isset($_SESSION['username'])){
include_once 'init.php';
	$do =isset($_GET['do'])? $_GET['do'] :"Manage";
	// start manage page
	//main page members
	if($do=="Manage"){
    $query ='';
    if(isset($_GET['page'])&& $_GET['page']=="Pending"){
      $query ="AND regstatus =0";
    }
		//select all users Except admins
		    $stmt = $conn->prepare("SELECT * FROM 
                                             users 
                               WHERE 
                                             groupid !=1 $query;
                               ORDER BY 
                                             id 
                                DESC

                                             ");
		    $stmt->execute();
		    $rows =$stmt->fetchAll();
        if(!empty($rows)){
          include_once 'views/users/manage.php';
        }
        else{
          echo '<div class="container">';
          echo '<div class="nice-message">There Is No Users To Show</div>';
          echo '<a href="users.php?do=Add" class="btn btn-primary">
            <i class="fa fa-plus"></i>New User </a>';
          echo '</div>';
        }
	}
	// link page add user
	elseif ($do=="Add") {
		include_once 'views/users/add.php';
	}
	// post submit add
	elseif ($do == "Insert") {
			if($_SERVER['REQUEST_METHOD'] =='POST'){
     $username =$_POST['username'];
     $fullname =$_POST['fullname'];
     $email    =$_POST['email'];
     $password =$_POST['password'];
     // when check check $password because 
     //empty string has hashed in sh1 that mean 
     //if i check the $hashedpass for ever dont return mistake
     $hashedpass =sha1($_POST['password']);

     // validate the form 
     $formErrors =array();
         if(strlen($username) <  4){
     	$formErrors[] =' username cannot be less than<strong>4 characters</strong></div>';
        }
           if(strlen($username) >  20){
     	$formErrors[] ='username cannot be more than<strong> 20 characters </strong>';
        }
        if (empty($username)) {
	    $formErrors[] =' username cannot be<strong>Empty </strong> ';
        }
        if(empty($password)){
        $formErrors[] =' password cannot be<strong>Empty </strong> ';
        }
          if (empty($email)) {
	    $formErrors[]= '  email cannot be <strong>Empty </strong> ';
        }
          if (empty($fullname)) {
	    $formErrors[]='fullname cannot be <strong>Empty </strong> ';
        }
        foreach ($formErrors as $error) {
          echo '<div class="alert alert-danger">'.$error."</div><br>";
        }
    /* Insert user info in database
     check if no errors in array errors 
     */
        if(empty($formErrors)){
           // check if User Exist in Database
       /*  i create function  checkItems  
      to check if that item or user or category there is in database or not
      this function is in (includes/functions/functions.php) *prevent dublicated*
       */
          $check =checkItems("username","users",$username);
          if($check == 1){
              $theMsg= '<div class="alert alert-danger">Sorry, that user is exist </div>'; 
              redirectHome($theMsg,'back');
          }
          else{
                     $stmt = $conn->prepare("INSERT INTO
                             users(username,password,email,fullname,regstatus,date)
                             VALUES
                             (:username,:password,:email,:fullname,1,now())
                             ;");
        $stmt->execute(
        array(  
      ':username'  =>$username,
      ':password'  =>$hashedpass,
      ':email'     =>$email,
      ':fullname'  =>$fullname,
      ));
        // echo success message

        $theMsg= '<div class="alert alert-success">'.$stmt->rowCount().'records Inserted </div>'; 
        redirectHome($theMsg,'back');
          }
        }
	  }

  else{
        /*  i create function  redirectHome 
      to check if did any error get away from that page
      this function is in (includes/functions/functions.php)
       */
      $theMsg= '<div class="alert alert-danger">Sorry, you canot get this page redirectly</div>';
      redirectHome($theMsg,'back');
  }
}
	// start control edit page
	elseif ($do =="Edit") {
		//to organize the page the views in folder views
			// intval that mean return integer value
	 $userId = 
	 //check if id is numeric and get the integer value of it
		isset($_GET['UserID']) && is_numeric($_GET['UserID'])? 
		intval($_GET['UserID']): 0;
		// select data by PDO
		  $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id; LIMIT 1;");
  $stmt->execute(
  array(
':id'  =>$_GET['UserID']
));
  // to take  all data from database to work with them 
  $row = $stmt->fetch();
  $count =$stmt->rowCount();
  if($count >0){
  	// if there is such id 
  	include_once ("views/users/edit.php");
   // if there is no such id
  }else{
  	 $theMsg=" <div class='alert alert-danger'>There is no such id</div>";
     redirectHome($theMsg,'back');
  }	
 
}
// submit form edit 
// post edit
elseif ($do =="Update") {
	if($_SERVER['REQUEST_METHOD'] =='POST'){
     $id       =$_POST['id'];
     $username =$_POST['username'];
     $fullname =$_POST['fullname'];
     $email    =$_POST['email'];
     // password trick
     // condition ? true :false
     $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
     // validate the form 
     $formErrors =array();
          if(strlen($username) <  4){
     	$formErrors[] =' username cannot be less than<strong>4 characters</strong></div>';
        }
           if(strlen($username) >  20){
     	$formErrors[] ='username cannot be more than<strong> 20 characters </strong>';
        }
        if (empty($username)) {
	    $formErrors[] =' username cannot be<strong>Empty </strong> ';
        }
          if (empty($email)) {
	    $formErrors[]= '  email cannot be <strong>Empty </strong> ';
        }
          if (empty($fullname)) {
	    $formErrors[]='fullname cannot be <strong>Empty </strong> ';
        }
        foreach ($formErrors as $error) {
          echo '<div class="alert alert-danger">'.$error."</div><br>";
        }
       // update the data with this info
        // check if no errors in array errors 
        if(empty($formErrors)){
           $stmt = $conn->prepare("SELECT * FROM 
                                                users 
                                   WHERE 
                                                username=:username 
                                   AND 
                                                id !=:id; 
                                   LIMIT 1;");
                $stmt->execute(
                          array(  
                        ':username'  =>$username,
                         ':id'       =>$id
                        ));
                $count =$stmt->rowCount();
                if($count==1){
                  $theMsg= '<div class="alert alert-danger"> Sorry, This Username Is Exist </div> ';
                  redirectHome($theMsg,'back',$seconds=6);
                } 
                else{
                   $stmt = $conn->prepare("UPDATE users
                                       SET
                                             username =:username 
                                         ,
                                             password =:password 
                                         ,
                                             email    =:email
                                         ,
                                             fullname =:fullname
                                         WHERE 
                                             id       =:id
                                          LIMIT 1
                                             ;");
                          $stmt->execute(
                          array(  
                        ':username'  =>$username,
                        ':password'  =>$pass,
                        ':email'     =>$email,
                        ':fullname'  =>$fullname,
                         'id'        =>$id
                        ));
                          // echo success message

  $theMsg= '<div class="alert alert-success">'.$stmt->rowCount().'records Updated</div>'; 
  redirectHome($theMsg,'back');
                }
             
        }
  }
  else{
    /*  i create function  redirectHome 
      to check if did any error get away from that account 
      this function is in (includes/functions/functions.php)
       */
      $theMsg= 'class="alert alert-danger"> Sorry, you canot get redirectly</div> ';
      redirectHome($theMsg,'back',$seconds=6);
  }

   }
   //Delete Member page
   elseif ($do=="Delete") {
    $userId = 
	 //check if id is numeric and get the integer value of it
		isset($_GET['UserID']) && is_numeric($_GET['UserID'])? 
		intval($_GET['UserID']): 0;
		// select data by PDO
    $check =checkItems("id","users",$userId);
		  if($check >0){
          $users = getAllFrom("*","users","WHERE id ={$_GET['UserID']}",
                "","id");
          foreach ($users as $user) {
            $file=$user['profile_pic'];
            if(!empty($file)){
                @unlink($file);
            }
        }
       $stmt = $conn->prepare("DELETE FROM users WHERE id=:id LIMIT 1 ;");
       $stmt->execute(
        array(
        	':id'  =>$_GET['UserID']
	    ));
      $theMsg= '<div class="alert alert-success">'.$stmt->rowCount().'records Deleted </div>';	
       redirectHome($theMsg,'back');
		     }
		  else{
		  $theMsg= '<div class="alert alert-danger">no such this id</div>';
      redirectHome($theMsg,'back');
		  }
		  }
      //End Delete
      // Activate users
      elseif ($do =="Activate") {
    $userId = 
   //check if id is numeric and get the integer value of it
    isset($_GET['UserID']) && is_numeric($_GET['UserID'])? 
    intval($_GET['UserID']): 0;
    // select data by PDO
    $check =checkItems("id","users",$userId);
      if($check >0){
       $stmt = $conn->prepare("UPDATE users SET regstatus =1 WHERE id=:id  LIMIT 1 ;");
       $stmt->execute(
        array(
          ':id'  =>$_GET['UserID']
            ));
      $theMsg= '<div class="alert alert-success">'.$stmt->rowCount().'records Updated </div>'; 
       redirectHome($theMsg,'back');
         }
      else{
      $theMsg= '<div class="alert alert-danger">no such this id</div>';
      redirectHome($theMsg,'back');
      }

      }

   }
else{
     header("Location: index.php"); // redirect to dashboard page 
     exit();
}

?>