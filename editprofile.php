<?php 
ob_start();
$pageTitle="Edit Profile";
include 'init.php';
   $informations = getAllFrom("*","users","WHERE username='{$_SESSION['user']}'","","id","ASC");
   if(!empty($informations)){
   	include_once('views/users/editprofile.php');
   }
  if(isset($_SESSION['user'])){
     if($_SERVER['REQUEST_METHOD'] =='POST'){
     $id             =$_POST['id'];
     $username       =filter_var($_POST['username'],FILTER_SANITIZE_STRING);
     $email          =filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
     $fullname       =filter_var($_POST['fullname'],FILTER_SANITIZE_STRING);
     $password       =$_POST['password'];
     $hashedpass     =sha1($_POST['password']);
      // to upload file
     // to Taking the file name and storing in variable $file_name 
    $image       =$_FILES['image']['name']; 
     // THis is Temporary Variable 
     $file_tmp    =$_FILES['image']['tmp_name'];
   //  validate the form 
     $formErrors =array();
         if(strlen($username)<4){
      $formErrors[] ='UserName Must Be At Least  <strong> 4 Characters</strong>';
        }
        if(strlen($fullname)<2){
      $formErrors[] ='FullName Must Be At Least  <strong> 2 Characters</strong>';
        }
        if(empty($email)){
      $formErrors[] ='Email  cannot be <strong> Empty </strong>';
        }
        if (empty($password)) {
           $hashedpass  =$_SESSION['pass'];
       
        }
        //Validate Image
            $allowedExts = array("gif", "jpeg", "jpg", "png");
      $extension = end(explode(".", $image));
      if ((($_FILES["image"]["type"] == "image/gif")
      || ($_FILES["image"]["type"] == "image/jpeg")
      || ($_FILES["image"]["type"] == "image/jpg")
      || ($_FILES["image"]["type"] == "image/png"))
      && ($_FILES["image"]["size"] <  500000)
      && in_array($extension, $allowedExts)){
         move_uploaded_file($file_tmp,'AdminPanal/profiles/'.$image);
         $img ='profiles/'.$image;
         }
    // /* Update user info in database
    //  check if no errors in array errors 
    //  */
        if(empty($formErrors)){
            if(empty($img)){
            $users =getAllFrom("*","users","WHERE id={$id}","","id","");
             foreach ($users as $user) {
                 $img=$user['profile_pic'];
              }
          }
                  $stmt = $conn->prepare("UPDATE users
                                       SET
                                             username   =:username 
                                         ,
                                             email      =:email
                                         ,
                                             fullname   =:fullname
                                          ,
                                            password    =:password 
                                          ,
                                            profile_pic =:profile_pic
                                         WHERE 
                                             id         =:id
                                          LIMIT 1
                                             ;");
                          $stmt->execute(
                          array(  
                        ':username'   =>$username,
                        ':password'   =>$hashedpass,
                        ':email'      =>$email,
                        ':fullname'   =>$fullname,
                        ':profile_pic'=>$img,
                         'id'         =>$id
                        ));
            // echo success message
        $suceesMSG= 'Congeratulation, Now You Are Updated your information '; 
        }
           // Start Looping Through Errors
        if(!empty($formErrors)){
          foreach ($formErrors as $error) {
              echo "<div class='alert alert-danger'>$error</div>";
          }
        
        }
          if(isset($suceesMSG)){
          	header("Location: {$_SERVER['PHP_SELF']}");
              echo "<div class='alert alert-success'>$suceesMSG</div>";
            }
        //End Looping Through Errors
        //Refresh to reload the same page
          
     }

  
      }
else{
	header("Location: login.php");

}
ob_end_flush();
?>
