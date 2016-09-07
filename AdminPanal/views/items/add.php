           <?php include_once('items.php');?>
            <!-- form to add-->
          <h1 class="text-center" > Add New Item</h1>
        <div class="container">
        <form class ="form-horizontal" action="?do=Insert" method="POST" 
        enctype="multipart/form-data">
          <!-- Start Name Field-->
            <!-- auto comlete off make browser not remember the username-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Enter Name </label>
             <div class="col-sm-4 ">
                 <input type="text" 
                        class="form-control" 
                        name="name"  
                        placeholder="Enter Name Of The Item"
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
                      placeholder="Enter Description Of The Item"
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
                      placeholder="Enter Price Of The Item"
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
                      placeholder="Enter Country Of The Item"
                        required="required">
          </div>
        </div>
            <!-- End Country Made -->
        <!-- Start  members Field-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Users  </label>
             <div class="col-sm-4 ">
                 <select name="member">
                   <option value="0">...</option>
                    <?php
                    //getAllFrom Ultimate Function  
                    $users =getAllFrom("*","users","","","id");
                    foreach ($users as $user) {
                   echo "<option value='".$user['id']."'>".$user['username']."</option>";
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
                   <option value="0">...</option>
                    <?php
                    //getAllFrom Ultimate Function 
                    $cats   =getAllFrom("*","categories","WHERE parent=0","","id");
                    foreach ($cats as $cat) {
                   echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
                   //{} to identify that is avariable
                   $childCat =getAllFrom("*","categories","WHERE parent={$cat['id']}","","id");
                   foreach ($childCat as $child) {
                   echo "<option value='".$child['id']."'>--".$child['name']."</option>";
                   }
                    }
                    ?>
                 </select>
          </div>
        </div>
            <!-- End Categories Field -->
          <!-- Start  Status Made-->
            <div class="form-group">
                <label class="col-sm-2 control-label"> Status  </label>
                 <div class="col-sm-4 ">
                     <select name="status">
                       <option value="0">...</option>
                       <option value="1">New</option>
                       <option value="2">Like New</option>
                       <option value="3">Used</option>
                       <option value="4">Very Old</option>
                     </select>
              </div>
            </div>
          <!-- End Status Made -->
         <!-- Start  Tags Made-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Tags  </label>
           <div class="col-sm-4 ">
                  <input 
                      id="myTags"
                      type="text" 
                      class="form-control" 
                      name="tags" 
                      >
          </div>
        </div>
            <!-- End Tags Made -->
              <!-- Start  Image Made-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Image  </label>
           <div class="col-sm-4 ">
              <input type="file" name="image"> 
          </div>
        </div>
            <!-- End Image Made -->

              <!-- Start Submit -->
             <div class="form-group">
            <div class=" col-sm-offset-2 ">
                  <input 
                      type="submit" 
                      class="btn btn-success" 
                      name="submit" 
                      value="Add Item">
            </div>
          </div>
             <!-- End Submit -->
        </form>
          </div>

