     <!-- form to Edit-->
          <h1 class="text-center" > Edit Category</h1>
        <div class="container">
        <form class ="form-horizontal" action="?do=Update" method="POST">
        	<input type="hidden" name="id" value="<?php echo  $catId;?>">
          <!-- Start Name Field-->
            <!-- auto comlete off make browser not remember the username-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Enter Name </label>
             <div class="col-sm-4 ">
            <input 
                  type="text" 
                  class="form-control" 
                  name="name"  
                  placeholder="Enter Name Of The Category" 
                  value="<?php echo $cat['name'];?>" 
                  required="required">
          </div>
       </div>
            <!-- End name Field-->
             <!-- Start  Description-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Enter Description </label>
             <div class="col-sm-4 ">
            <input 
                  type="text" 
                  class="form-control" 
                  name="description" 
                  value="<?php echo $cat['description'];?>" 
                 placeholder="Enter Description Of The Category">
          </div>
        </div>
            <!-- End Description -->

             <!-- Start Ordering -->
           <div class="form-group">
            <label class="control-label col-sm-2">Enter Ordering </label>
             <div class="col-sm-4 ">
            <input 
                  type="text" 
                  class="form-control password" 
                  name="ordering"  
                  placeholder="Enter Number To Arrange Category" 
                  value="<?php echo $cat['ordering'];?>" >
          </div>
        </div>
           <!-- End Ordering -->

                 <!-- Start Category Type-->
           <div class="form-group">
            <label class="control-label col-sm-2">Parent? </label>
             <div class="col-sm-4 ">
             <select name="parent">
              <option >None</option>
               <?php
               $allCat =getAllFrom("*","categories","WHERE parent=0","","id","ASC");
               foreach ($allCat as $category) {
                 echo "<option value='".$category['id']."'";
                 if($cat['parent']== $category['id']){
                  echo "selected";
                 }
                 echo ">".$category['name']."</option>";
               }
             
              ?>
             </select>
          </div>
        </div> 
                  <!-- Start Visibility Field-->
           <div class="form-group">
            <label class=" col-sm-2 control-label">Visible </label>
             <div class="col-sm-4 ">
              <div>
                <!-- for tag label make when i click label check the radio -->
                <input id="vis-yes" type="radio" name="visibility" value="0" 
                <?Php if($cat['visibility']==0){echo "checked";}?> >
                <label for="vis-yes">Yes</label>
              </div>
               <div>
                <input id="vis-no"type="radio" name="visibility" value="1"
                <?Php if($cat['visibility']==1){echo "checked";}?> >
                <label for="vis-no">No</label>
              </div>
          </div>
        </div>
            <!-- End Visibility Field -->
        <!-- Start Allow Commenting Field-->
           <div class="form-group">
            <label class=" col-sm-2 control-label">Allow Commenting </label>
             <div class="col-sm-4 ">
              <div>
                <!-- for tag label make when i click label check the radio -->
                <input id="comm-yes" type="radio" name="commenting" value="0"
                <?Php if($cat['allowcomment']==0){echo "checked";}?> >
                <label for="comm-yes">Yes</label>
              </div>
               <div>
                <input id="comm-no"type="radio" name="commenting" value="1" 
                <?Php if($cat['allowcomment']==1){echo "checked";}?> >
                <label for="comm-no">No</label>
              </div>
          </div>
        </div>
            <!-- End Allow Commenting Field -->
         <!-- Start Allow Advistement Field-->
           <div class="form-group">
            <label class=" col-sm-2 control-label">Allow Advistement</label>
             <div class="col-sm-4 ">
              <div>
                <!-- for tag label make when i click label check the radio -->
                <input id="ads-yes" type="radio" name="ads" value="0" 
                 <?Php if($cat['allowadvertisement']==0){echo "checked";}?>>
                <label for="ads-yes">Yes</label>
              </div>
               <div>
                <input id="ads-no"type="radio" name="ads" value="1"
                 <?Php if($cat['allowadvertisement']==1){echo "checked";}?> >
                <label for="ads-no">No</label>
              </div>
          </div>
        </div>
            <!-- End Allow Advistement Field -->

              <!-- Start Submit -->
             <div class="form-group">
            <div class=" col-sm-offset-2 ">
            <input type="submit" class="btn btn-success" name="submit" value="Save">
            </div>
          </div>
             <!-- End Submit -->
        </form>
          </div>
         