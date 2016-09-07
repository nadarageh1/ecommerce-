<div class="container">
<h1 class="text-center"> 
  <?php  
     if(isset($_GET['pageid']) && is_numeric($_GET['pageid'])){
          $pageID=  intval($_GET['pageid']);
          $cats=getAllFrom("name","categories","WHERE id={$_GET['pageid']}","","id");
        foreach ($cats as $cat) {
         echo $cat['name'];
        }
?></h1>
<div class="row">
	    <?php 
      // {} to identife that is variable
      $items =getAllFrom("*","items","WHERE cat_id =$pageID","AND approve=1","id");
      foreach ($items as $item) {
        echo '<div class="col-sm-6 col-md-3">';
           echo '<div class="thumbnail item-box">';
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
      }
      }
      else{
         echo '<div class="container">';
              echo '<div class="alert alert-danger">
              There Is No Id</div>';
          echo '</div>';
      }
      ?>
</div>
</div>