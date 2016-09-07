       <?php include 'categories.php';?>
           <!-- form to add-->
          <h1 class="text-center" > Manage Categories</h1>
        <div class="container categories">
        	<div class="panel panel-default">
           <div class="panel-heading">
            <i class="fa fa-edit"></i>Manage Categories
            <div class="option pull-right">
             <i class="fa fa-sort"></i> Ordering:[
             <a  class="<?php if($sort =='ASC'){echo 'active';}?>"href="?sort=ASC" >Asc</a>
             <a  class="<?php if($sort =='DESC'){echo 'active';}?>"href="?sort=DESC"> |Desc</a>]
             <i class="fa fa-eye"></i>View:[
             <span data-view="full" class="active">Full</span>
             <span data-view="classic"> | Classic </span>]
            </div>
           </div>
           <div class="panel-body">
           <?php
            foreach ($cats as $cat) {
              echo "<div class='cat'>";
              echo "<div class='hidden-buttons'>";
              echo "<a href='categories.php?do=Edit&CatID=".$cat['id']."'class='btn btn-primary btn btn-xs'>Edit
              <i class='fa fa-edit'></i></a>";
              echo "<a href='categories.php?do=Delete&CatID=".$cat['id']."'class='btn btn-danger btn btn-xs confirm'>Delete
              <i class='fa fa-close'></i></a>";
              echo "</div>";
             echo '<h3>'                .$cat['name'].'</h3>';
             echo "<div class='full-view'>";
             echo '<p>';  if($cat['description'] ==""){echo "This category has no Description";} 
             else{echo $cat['description'];}            ;  
             echo'</p>';
             if($cat['visibility']==1){
              echo '<span class="visibility"><i class="fa fa-eye"></i>Hidden</span>';
             }
             if($cat['allowcomment']==1){
              echo '<span class="commenting"><i class="fa fa-close"></i>Comment Disabled</span>';
             }
             if($cat['allowadvertisement']==1){
              echo '<span class="advirteses"><i class="fa fa-close"></i>advirtesement Disabled</span>';
             }
                   // Get Child Category
             //{} to Identify that is variable
            $categories =getAllFrom("*","categories","WHERE parent={$cat['id']}","","id","ASC");
            if(!empty($categories)){
            echo '<h4 class="head-cats"> Child Category</h3>';
              echo "<ul class='list-unstyled child-cats'>";
              foreach ($categories as $category) {
                echo "<li class='child-link'>
                <a href='categories.php?do=Edit&CatID="
                .$category['id']."'>".$category['name']."</a>";
               echo "<a href='categories.php?do=Delete&CatID="
               .$category['id']."'class='confirm show-delete'>Delete</a>
               </li>";
            }
            echo "</ul>";
          
          }
          echo "</div>";
          echo "<hr>";
          echo "</div>";
          }
             
       
           ?>
           </div>
        	</div>
             <div>
                <a href='categories.php?do=Add' class="btn btn-primary">
            <i class="fa fa-plus"></i>New Category </a>
          </div>
          </div>

        </div>
           



