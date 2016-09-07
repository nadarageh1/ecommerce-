          <?php include 'items.php';?>
           <!-- form to add-->
          <h1 class="text-center" > Manage Items</h1>
        <div class="container ">
          <div class="table-responsive">
          <table class="table table-bordered main-table text-center ">
            <tr>
                 <td>ID</td>
                 <td>Name</td>
                 <td>Image</td>
                  <td>Description</td>
                  <td>Price</td>
                  <td>Adding Date</td>
                  <td>Category</td>
                  <td>Username</td>
                  <td>Control</td>
            </tr>
            <?php
                 foreach ($items as $item) {
                 echo "<tr>";
                 echo "<td>".$item['id']      ."</td>";
                 echo "<td>".$item['name']."</td>";
                    if($item['image']==''){
                        echo "<td>".'<img class="img-responsive" src="images/1.jpg" style="width:100px">'."</td>";
                    }
                    else { 
                       echo '<td><img class="img-responsive" src="'.$item['image'].'" style="width:100px"></td>';
                    }
                 echo "<td>".$item['description']."</td>";
                 echo "<td>".$item['price']."</td>";
                 echo "<td>".$item['add_date']."</td>";
                 echo "<td>".$item['cat_name']."</td>";
                 echo "<td>".$item['user_name']."</td>";
                 echo "<td>"."<a href='items.php?do=Edit&ItemID=".$item['id']."'class='btn btn-success '> <i class='fa fa-edit'></i> Edit </a>".
                             "<a href='items.php?do=Delete&ItemID=".$item['id']."' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
                 if($item['approve'] == 0){
                 echo "<a href='items.php?do=Approve&ItemID=".$item['id']."' class='btn btn-info activate'><i class='fa fa-check'></i> Approve </a>";
                             }
      
                echo "</td>";
                echo "</tr>";
                 }
            ?>
          </table>
          <div>
          <a href='items.php?do=Add' class="btn btn-primary">
            <i class="fa fa-plus"></i>New Item </a>
          </div>
          </div>
          </div>
             



