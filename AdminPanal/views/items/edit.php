         <?php include_once('items.php');
                     $stmt     = $conn->prepare("SELECT 
                                          comments.*,
                                          users.username
                                    AS
                                          username

                                    FROM 
                                          comments
                                    INNER JOIN 
                                           users
                                    ON
                                           users.id =comments.user_id 
                                    WHERE 
                                            item_id =:item_id           
                                      ;");
        $stmt->execute(array(
         ':item_id'=>$itemId
          ));
        $comments =$stmt->fetchAll();
        foreach ($items as $item) {
       
         ?>

            <!-- form to add-->
          <h1 class="text-center" > Edit Item</h1>
        <div class="container">
        <form 
              class ="form-horizontal" 
              action="?do=Update" 
              method="POST"  
              enctype="multipart/form-data">
          <input 
                 type="hidden" 
                 name="id" 
                 value="<?php echo  $itemId;?>">
          <!-- Start Name Field-->
            <!-- auto comlete off make browser not remember the username-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Enter Name </label>
             <div class="col-sm-4 ">
                 <input type="text" 
                        class="form-control" 
                        name="name"  
                        value="<?php echo $item['name'];?>"
                        required="required">
          </div>
       </div>
            <!-- End name Field-->
          <!-- Start  Description-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Description </label>
             <div class="col-sm-4 ">
                  <input 
                      type="text" 
                      class="form-control" 
                      name="description" 
                      value="<?php echo $item['description'];?>"
                      required="required">
          </div>
        </div>
            <!-- End Description -->
                 <!-- Start  Price-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Enter Price </label>
             <div class="col-sm-4 ">
                  <input 
                      type="text" 
                      class="form-control" 
                      name="price" 
                       value="<?php echo $item['price'];?>"
                      required="required">
          </div>
        </div>
            <!-- End Price -->
                     <!-- Start  Country Made-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Country  </label>
           <div class="col-sm-4 ">
                  <input 
                      type="text" 
                      class="form-control" 
                      name="country" 
                      value="<?php echo $item['country_made'];?>"
                       required="required">
          </div>
        </div>
            <!-- End Country Made -->

        <!-- Start  Status Made-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Status  </label>
             <div class="col-sm-4 ">
                 <select name="status">
                   <option value="1" <?php if($item['status']==1){echo "selected";}?>>New</option>
                   <option value="2" <?php if($item['status']==2){echo "selected";}?>>Like New</option>
                   <option value="3" <?php if($item['status']==3){echo "selected";}?>>Used</option>
                   <option value="4" <?php if($item['status']==4){echo "selected";}?>>Very Old</option>
                 </select>
          </div>
        </div>
            <!-- End Status Made -->
        <!-- Start  members Field-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> User  </label>
             <div class="col-sm-4 ">
                 <select name="member">
                  <?php 
                   //getAllFrom Ultimate Function 
                  $users =getAllFrom("*","users","","","id");
                  foreach ($users as $user) {
                   echo "<option value='".$user['id']."'";
                    if($item['user_id']==$user['id']){echo 'selected';}
                    echo ">".$user['username']."</option>";
                    }?>
                 </select>
          </div>
        </div>
            <!-- End Members Field -->
               <!-- Start  Categories Field-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Category  </label>
             <div class="col-sm-4 ">
                 <select name="category">
                    <?php 
                      //getAllFrom Ultimate Function 
                    $cats =getAllFrom("*","categories","WHERE parent=0","","id");
                    foreach ($cats as $cat) {
                   echo "<option value='".$cat['id']."'";
                   if($item['cat_id'] == $cat['id']){echo 'selected';}
                   echo ">".$cat['name']."</option>";
                         //{} to identify that is avariable
                   $childCat =getAllFrom("*","categories","WHERE parent={$cat['id']}","","id");
                   foreach ($childCat as $child) {
                   echo "<option value='".$child['id']."'";
                   if($item['cat_id'] == $child['id']){echo 'selected';}
                   echo ">--".$child['name']."</option>";
                    }
                  }
                    ?>
                 </select>
          </div>
        </div>
            <!-- End Categories Field -->
           <!-- Start  Tags Made-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Tags  </label>
           <div class="col-sm-4 ">
                  <input 
                      id="myTags"
                      type="text" 
                      class="form-control" 
                      name="tags" 
                      placeholder="Seperate Tags By comma(,)"
                      value="<?php echo $item['tags'];?>"
                      >
          </div>
        </div>
            <!-- End Tags Made -->
       <!-- Start  old Image Made-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Image  </label>
           <div class="col-sm-4 ">
                 <?php
                      if($item['image']==''){
                        echo "<td>".'<img class="img-responsive" src="images/1.jpg" style="width:200px">'."</td>";
                    }
                    else { 
                       echo '<td><img class="img-responsive" src="'.$item['image'].'" style="width:200px"></td>';
                    }
                 ?>
                  <input type="file" name="image"> 
          </div>
        </div>
            <!-- End old Image Made -->
              <!-- Start Submit -->
             <div class="form-group">
            <div class=" col-sm-offset-2 ">
                  <input 
                      type="submit" 
                      class="btn btn-success" 
                      name="submit" 
                      value="Save">
            </div>
          </div>
             <!-- End Submit -->
        </form>
         <?php }
          if(!empty($comments)){?>
              <!--form to manage -->
          <h1 class="text-center" >  <?php echo $item['name'];?>  Comments</h1>
          <div class="table-responsive">
          <table class="table table-bordered main-table text-center ">
            <tr>
                 <td>Comment</td>
                  <td>Username</td>
                  <td>Added Date</td>
                  <td>Control</td>
            </tr>
            <?php
                 foreach ($comments as $comment) {
              
                 echo "<tr>";
                 echo "<td>".$comment['comment']."</td>";
                 echo "<td>".$comment['username']."</td>";
                 echo "<td>".$comment['comment_date']."</td>";
                 echo "<td>"."<a href='comments.php?do=Edit&CommentID=".$comment['id']."'class='btn btn-success '> <i class='fa fa-edit'></i> Edit </a>".
                             "<a href='comments.php?do=Delete&CommentID=".$comment['id']."' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
                              if($comment['status'] == 0){
                echo "<a href='comments.php?do=Approve&CommentID=".$comment['id']."' class='btn btn-info activate'><i class='fa fa-check'></i> Approve </a>";
                             }
                             echo "</td>";


                 echo "</tr>";
                 }
            ?>
          </table>
          </div>
         <?php } ?>
          </div>
            

