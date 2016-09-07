<h1 class="text-center"><?php echo $sessionUser;
foreach ($informations as $info) {
?></h1>

<div  id="my-ads" class="information block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">My Information</div>
			<div class="panel-body">
				<ul class="list-unstyled">
                <li>
                	<i class="fa fa-unlock-alt fa-fw"></i>
                	<span>Login Name </span>             :<?php echo $info['username'];?>
                </li>
                <li>
                	<i class="fa fa-envelope-o fa-fw"></i>
                	<span>Email </span>            :<?php echo $info['email'];?>
                </li>
                <li>
                    <i class="fa fa-user fa-fw"></i>
                	<span>FullName </span>         :<?php echo $info['fullname'];?>
                </li>
                <li>
                    <i class="fa fa-calendar fa-fw"></i>
                	<span> Register Date</span>     :<?php echo $info['date'];?>
                </li>
              </ul>
          <a href="editprofile.php" class="btn btn-default"> Edit Information
          </a>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">My Items</div>
			<div class="panel-body">
    <?php 
    // $info['id'] that is id for the user
    // get items for this user
      $items = getAllFrom("*","items","WHERE user_id={$info['id']}","","id");
      if(!empty($items)){
      foreach ($items as $item) {
      	echo '<div class="col">';
      	echo '<div class="col-sm-6 col-md-3">';
      	   echo '<div class="thumbnail item-box">';
           if($item['approve']==0 )
            {echo '<span class="approve-status">Waiting Approval</span>';}
      	    echo '<span class="price-tag">$'.$item['price'].'</span>';
              if($item['image']==''){
                        echo "<td>".'<img class="img-responsive" src="AdminPanal/images/1.jpg" style="width:200px">'."</td>";
                    }
                    else { 
                       echo '<td><img class="img-responsive" src="AdminPanal/'.$item['image'].'" style="width:200px"></td>';
                    }
              echo '<div class="caption">';
                 echo '<h3><a href="items.php?itemid='.$item['id'].'">'.$item['name'].'</a></h3>';
                 echo '<p>'.$item['description'].'</p>';
                 echo '<p class="date">'.$item['add_date'].'</p>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
		    }
           echo '</div>';
		      }
		    else{
		    	echo 'There is No Ads you Choosed Create <a href="newad.php">New Ads</a>';
		       }
      ?> 
		 </div>
		</div>
	</div>
  
    <div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">Latest Comments</div>
      <div class="panel-body">
      <?php 
      //Ultimate Function 
      $myComments = getAllFrom("comment","comments","WHERE user_id={$info['id']}","","id");
      if(!empty($myComments)){
      foreach ($myComments as $comment) {                
              echo '<p>'.$comment['comment'].'</p>';
        } 
      }
      else{
        echo "There Is No comments To Show";
      }
      ?>
    </div>
  </div> 
</div>
</div>
<?php } ?>