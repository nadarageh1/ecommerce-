<div class="container">
<div class="row">
      <?php 
      if(isset($_GET['name'])){
          echo '<h1 class="text-center">'.$_GET['name'].'</h1>';
          $tag=$_GET['name'];
     // {} to identife that is variable
      $tagItems =getAllFrom("*","items","WHERE tags like '%$tag%'","AND approve=1","id");
      foreach ($tagItems as $item) {
        echo '<div class="col-sm-6 col-md-3">';
           echo '<div class="thumbnail item-box">';
            echo '<span class="price-tag">$'.$item['price'].'</span>';
                 if($item['image']==''){
                echo '<img class="img-responsive" src="AdminPanal/images/1.jpg" alt="">';
            }
            else { 
               echo '<img class="img-responsive" src="AdminPanal/'.$item['image'].'" alt="">';
                }
              echo '<div class="caption">';
                 echo '<h3><a href="items.php?itemid='.$item['id'].'">'.$item['name'].'</a></h3>';
                 echo '<p>'.$item['description'].'</p>';
                 echo '<p class="date">'.$item['add_date'].'</p>';
              echo '</div>';
              echo '</div>';
        echo '</div>';
      }
      }
      else{
         echo '<div class="container">';
              echo '<div class="alert alert-danger">
              You Must Enter Tag Name</div>';
          echo '</div>';
      }

      ?>
</div>
</div>