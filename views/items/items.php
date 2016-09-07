<?php include_once'init.php';?>
<h1 class="text-center"><?php echo $item['name']?></h1>
	<div class="container">
    <div class="row">
      <div class="col-md-3">
        <?php
           if($item['image']==''){
                echo '<img class="img-responsive" src="AdminPanal/images/1.jpg" alt="">';
            }
            else { 
               echo '<img class="img-responsive" src="AdminPanal/'.$item['image'].'" alt="">';
                }
        ?>
      </div>
      <div class="col-md-9 item-info">
        <h2><?php echo $item['name'];?></h2>
        <p><?php echo $item['description'];?></p>
        <ul class="list-unstyled">
        <li>
          <i class="fa fa-calendar fa-fw"></i>
          <span>Added Date:</span><?php echo $item['add_date'];?>
        </li>
         <li>
          <i class="fa fa-money fa-fw"></i>
          <span>Price:     </span>$<?php echo $item['price'];?>
        </li>
          <li>
            <i class="fa fa-building fa-fw"></i>
            <span>Made IN:</span><?php echo $item['country_made'];?>
          </li>
        <li> 
            <i class="fa fa-tag fa-fw"></i>
          <span>Category:</span><a href="categories.php?pageid=<?php echo $item['cat_id'];?>"><?php echo $item['category_name'];?></a>
        </li> 
        <li>
         <i class="fa fa-user fa-fw"></i>
         <span>Added By:</span><a href="useritem.php"><?php echo $_SESSION['prof_name'] = $item['username'];?></a>
       </li> 
        <li class='tags-item'>
         <i class="fa fa-tags fa-fw"></i>
         <span>Tags:</span>
         <?php 
         // put $item['tags'] in Array
         $allTags=explode(",", $item['tags']);
         foreach ($allTags as $tag) {
          $tag =str_replace(' ', '', $tag);
          $tag =strtolower($tag);
          if(!empty($tag)){
             echo "<a   href='tags.php?name={$tag}'>".$tag."</a>";

          }
         }
         ?>
       </li> 
      </ul>
      </div>
    </div>
    <hr class="custom-hr">
    <!-- Start Add Comment-->
    <?php if(isset($_SESSION['user'])){ ?>
    <div class="row">
      <div class="col-md-offset-3">
        <div class="add-comment">
        <h3> Add New Comment</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'].'?itemid='.$item['id']?>" method="post">
            <textarea name="comment" required></textarea>
            <input type="submit" value="Add Comment" name="addcomment" class="btn btn-primary">
        </form>
      </div>
      </div>
    </div>
      <!-- End Add Comment-->
         <?php } else{
          echo '<a href="login.php">Login</a>Or<a href="login.php">Register</a>To Add Comment';
         } ?>
    <hr class="custom-hr">
       <h1> Comments </h1> 
          <?php
        foreach ($comments as $comment) {
          ?>
          <!-- Get All Comment for this item and this person-->
     <div class="comment-box">
        <div class="row">
          <div class="col-sm-2 text-center">
            <?php
               if($comment['image']==''){
                 echo '<img class="img-responsive img-thumbnail img-circle center-block" src="AdminPanal/profiles/1.jpg" 
                  alt="" >';
            }
            else { 
               echo '<img  class="img-responsive img-thumbnail img-circle center-block" src="AdminPanal/'.$comment['image'].'" alt="">';
                }
            ?>
            
              <?php echo $comment['username'];  ?>
             </div>
             <div class="col-sm-10">
              <!-- lead class in bootstrap -->
             <p class="lead">
             <?php echo $comment['comment'];?>
             </p>
            </div>
         </div>
     </div>
        <hr class="custom-hr">
       <?php } ?>
		</div>