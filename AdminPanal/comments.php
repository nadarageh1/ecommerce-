<?php
/*
==========================================
== manage comments page
== you can Add | Edit | Delete comments from here
==that is like CommentsController in laravel
========================================
*/
@session_start();
$pageTitle = "Comments Page";
// start 
if (isset($_SESSION['username'])){
include_once 'init.php';
	$do =isset($_GET['do'])? $_GET['do'] :"Manage";
	// start manage page
	//main page members
	if($do=="Manage"){
  //select all users Except admins
        $stmt     = $conn->prepare("SELECT 
                                          comments.*,
                                          items.name 
                                    AS
                                          item_name,
                                          users.username
                                    AS
                                          username

                                    FROM 
                                          comments
                                    INNER JOIN 
                                           items
                                    ON
                                           items.id =comments.item_id
                                    INNER JOIN 
                                           users

                                    ON
                                           users.id =comments.user_id  
                                    ORDER BY 
                                           id
                                    DESC            
                                      ;");
        $stmt->execute();
        $comments =$stmt->fetchAll();
        if(!empty($comments)){
            include_once 'views/comments/manage.php';

        }
          else{
          echo '<div class="container">';
          echo '<div class="nice-message">There Is No Comments To Show</div>';
          echo '</div>';
        }
	}
	// start control edit page
	elseif ($do =="Edit") {
	//to organize the page the views in folder views
  // intval that mean return integer value
   $commentId = 
   //check if id is numeric and get the integer value of it
    isset($_GET['CommentID']) && is_numeric($_GET['CommentID'])? 
    intval($_GET['CommentID']): 0;
    // select data by PDO
      $stmt = $conn->prepare("SELECT * FROM comments WHERE id=:id; LIMIT 1;");
  $stmt->execute(
  array(
':id'  =>$_GET['CommentID']
));
  // to take  all data from database to work with them 
  $comment = $stmt->fetch();
  $count =$stmt->rowCount();
  if($count >0){
    // if there is such id 
    include_once ("views/comments/edit.php");
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
    $id      =$_POST['id'];
    $comment =$_POST['comment'];
     // validate the form 
          if(empty($comment)){
           echo '<div class="alert alert-danger">Comment Cannot be <strong>Empty</strong></div>';
          }
     // update the data with this info
        else{
              $stmt = $conn->prepare("UPDATE 
                                            comments
                                      SET
                                             comment =:comment 
                                      WHERE 
                                             id       =:id
                                      LIMIT 1
                                             ;");
                          $stmt->execute(
                          array(  
                        ':comment'  =>$comment,
                        ':id'       =>$id
                        ));
                          // echo success message

  $theMsg= '<div class="alert alert-success">'.$stmt->rowCount().'records Updated</div>'; 
  redirectHome($theMsg,'back');
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
    $commentId = 
   //check if id is numeric and get the integer value of it
    isset($_GET['CommentID']) && is_numeric($_GET['CommentID'])? 
    intval($_GET['CommentID']): 0;
    // select data by PDO
    $check =checkItems("id","comments",$commentId);
      if($check >0){
       $stmt = $conn->prepare("DELETE FROM comments WHERE id=:id LIMIT 1 ;");
       $stmt->execute(
        array(
          ':id'  =>$_GET['CommentID']
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
  elseif ($do =="Approve") {
      $commentId = 
   //check if id is numeric and get the integer value of it
    isset($_GET['CommentID']) && is_numeric($_GET['CommentID'])? 
    intval($_GET['CommentID']): 0;
    // select data by PDO
    $check =checkItems("id","comments",$commentId);
      if($check >0){
       $stmt = $conn->prepare("UPDATE comments SET status =1 WHERE id=:id  LIMIT 1 ;");
       $stmt->execute(
        array(
          ':id'  =>$_GET['CommentID']
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