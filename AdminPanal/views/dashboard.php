<?php include_once 'dashboard.php';
?>
<div class="container home-stats text-center" >
  <h1>Dashboard Page</h1>
  <div class="row">
    <div class="col-md-3">
     <div class="stat st-members">
      <i class="fa fa-users"></i>
      <div class="info">
          Total Users
          <span><a href="users.php"><?php echo countItems('id','users')?></a></span>
          </div>
      </div>
   </div>
    <!-- Pending Members that waiting aprove her request-->
     <div class="col-md-3">
       <div class="stat st-pending">
        <i class="fa fa-plus"></i>
        <div class="info">
              Pending Users
    <span><a href="users.php?d=Manage&page=Pending"><?php 
      echo checkItems("regstatus","users",0);?></a></span>
        </div>
       </div>
     </div>
    <div class="col-md-3">
     <div class="stat st-items">
      <div class="info">
        <i class="fa fa-tag"></i>
        Total Items
      <span><a href="items.php?do=Manage"><?php 
      echo countItems('id','items')?></a></span>
      </div>
     </div>
    </div>
    <div class="col-md-3 ">
     <div class="stat st-comments">
      <i class="fa fa-comments"></i>
      <div class="info">
          Total Comments
      <span><a href="comments.php?do=Manage"><?php 
      echo countItems('id','comments')?></a></span>
      </div>
     </div>
   </div>
  </div>
</div>
<!--Start First Panal -->
			<div class="container latest">
				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-users"></i> Latest <?php echo $NumUsers;?> Registered Users
                <span class="toggle-info pull-right">
                <i class="fa fa-plus fa-lg"></i>
                </span>
							</div>
							<div class="panel-body">
                <ul class="list-unstyled latest-all">
                 <?php 
                 if(!empty($latestUsers)){
                  foreach ($latestUsers as $user) {
                  echo '<li>'.$user['username'];
                   echo '<a href="users.php?do=Edit&UserID='.$user['id'].'">';
                        echo '<span class="btn btn-success pull-right">';
                             echo  '<i class="fa fa-edit"></i>Edit'; 
                             if($user['regstatus'] == 0){
                             echo "<a href='users.php?do=Activate&UserID=".$user['id'].
                             "' class='btn btn-info activate pull-right'><i class='fa fa-check'></i> Activate </a>";
                             }  
                        echo '</span>';
                        echo "</a>"; 
                  echo '</li>';
               }
             }
             else {
              echo "There is no Data To Show";
             }
              ?>
                </ul>
							</div>
						</div>
					</div>
 <!-- End First Panal-->
 <!-- Start Second Panal-->         
				<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-tag"></i> Latest <?php echo $NumItems;?>  Items Added
                  <span class="toggle-info pull-right">
                <i class="fa fa-plus fa-lg"></i>
                </span>
							</div>
							<div class="panel-body">
               <ul class="list-unstyled latest-all">
								<?php 
                if(!empty($latestItems)){
                  foreach ($latestItems as $item) {
                  echo '<li>'.$item['name'];
                   echo '<a href="items.php?do=Edit&ItemID='.$item['id'].'">';
                        echo '<span class="btn btn-success pull-right">';
                             echo  '<i class="fa fa-edit"></i>Edit'; 
                             if($item['approve'] == 0){
                             echo "<a href='items.php?do=Approve&ItemID=".$item['id'].
                             "' class='btn btn-info activate pull-right'><i class='fa fa-check'></i> Activate </a>";
                             }  
                        echo '</span>';
                        echo "</a>"; 
                  echo '</li>';
               }
             }
             else {
              echo "There is no Data To Show";
             }
              ?>
            </ul>
							</div>
						</div>
					</div>
				</div>
         <!-- Start latest Comments Panal-->         

            <div class="row">
          <div class="col-sm-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <i class="fa fa-comments"></i> Latest <?php echo $NumComments;?> Comments
                <span class="toggle-info pull-right">
                <i class="fa fa-plus fa-lg"></i>
                </span>
              </div>
              <div class="panel-body">
            <?php
            if(!empty($comments)){
                 foreach ($comments as $comment) {
                 echo '<div class="comment-box">';
                 echo '<span class="member-comment">'.$comment['username'].'</span>';
                 echo '<p class="comment">'.$comment['comment'].'</p>';
                 echo '</div>';
                 }
               }
           else{
                  echo "There is no Data To Show";
               }
            ?>
           </div>
          </div>
        </div>
			</div>
   <!-- End second Panal-->