<?php
ob_start(); 
include_once'init.php';?>
<h1 class="text-center"><?php $username= $_SESSION['prof_name'];
echo $username;
?></h1>
	<div class="container">
    <div class="row">
      <div class="col-md-3">
        <?php
        $users = getAllFrom("*","users","WHERE username ='{$username}'","AND regstatus=1","id");
        foreach ($users as $user) {
            if($user['profile_pic']==''){
                echo '<img class="img-responsive" src="AdminPanal/profiles/1.jpg" alt="">';
            }
            else { 
               echo '<img class="img-responsive" src="AdminPanal/'.$user['profile_pic'].'" alt="">';
                }
        ?>
      </div>
      <div class="col-md-9 item-info">
        <h2></h2>
        <p></p>
        <ul class="list-unstyled">
        <li>
        <span>Name: </span> <?php echo $user['username'];?>
        </li>
         <li>
        <span>Email: </span> <?php echo $user['email'];?>
        </li>
          <li>
         <span>Date: </span> <?php echo $user['date'];?>
          </li>
      </ul>
       <hr class="custom-hr">
      </div>
      </div>
      <?php   $comments = getAllFrom("*","comments","WHERE user_id ={$user['id']}",
                "AND status=1","id");
   if(!empty($comments)){
                ?>
      <h1>Comments</h1>
            <!-- Get All Comment for this item and this person-->
     <div class="comment-box">
        <div class="row">
          <div class="col-sm-2 text-center">
            <?php
                 if($user['profile_pic']==''){
                echo '<img class="img-responsive img-thumbnail img-circle center-block" src="AdminPanal/profiles/1.jpg" alt="">';
            }
            else { 
               echo '<img class="img-responsive img-thumbnail img-circle center-block" src="AdminPanal/'.$user['profile_pic'].'" alt="">';
                }

            ?>
              <?php echo $user['username'];  ?>
             </div>
             <div class="col-sm-10">
              <!-- lead class in bootstrap -->
             <p class="lead">
             <?php 
            
              foreach ($comments as $comment) {
                 echo $comment['comment'];
              }
            ?>
             </p>
            </div>
         </div>
     </div>
     <?php } ?>
  </div>
 <?php 

} ob_end_flush();?>