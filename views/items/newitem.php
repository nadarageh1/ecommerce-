<h1 class="text-center">Create New Item</h1>
<div class="create-ad block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">Create New Item</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8">
						  <h1 class="text-center" > Add New Item</h1>
        <div class="container">
        <form class ="form-horizontal" action="newitem.php" method="POST"   
        enctype="multipart/form-data">
          <!-- Start Name Field-->
            <!-- auto comlete off make browser not remember the username-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Enter Name </label>
             <div class="col-sm-4 ">
                 <input 
                        pattern=".{4,}"
                        title="This Field Required At Least 4 Character" 
                        type="text"
                        class="form-control live" 
                        name="name"  
                        placeholder="Enter Name Of The Item"
                        required
                        data-class=".live-title">
          </div>
       </div>
            <!-- End name Field-->
          <!-- Start  Description-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Description </label>
             <div class="col-sm-4 ">
                  <input 
                      type="text" 
                      pattern=".{10,}"
                      title="This Field Required At Least 10 Character"
                      class="form-control live" 
                      name="description" 
                      placeholder="Enter Description Of The Item"
                      required
                      data-class=".live-desc">
          </div>
        </div>
            <!-- End Description -->
                 <!-- Start  Price-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Enter Price </label>
             <div class="col-sm-4 ">
                  <input 
                      type="text" 
                      pattern=".{1,}"
                      title="This Field Required At Least 1 Number"
                      class="form-control live" 
                      name="price" 
                      placeholder="Enter Price Of The Item"
                      required
                      data-class=".live-price">
          </div>
        </div>
            <!-- End Price -->
                     <!-- Start  Country Made-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Country  </label>
           <div class="col-sm-4 ">
                  <input 
                      type="text" 
                      pattern=".{4,}"
                      title="This Field Required At Least 4 Character"
                      class="form-control" 
                      name="country" 
                      placeholder="Enter Country Of The Item"
                      required
                       >
          </div>
        </div>
            <!-- End Country Made -->
               <!-- Start  Categories Field-->
        <div class="form-group">
            <label class="col-sm-2 control-label"> Category  </label>
             <div class="col-sm-4 ">
                 <select name="category">
                   <option value="0">...</option>
                    <?php 
                    // getAllFrom that is function in functions.php
                    $cats = getAllFrom('*','categories','WHERE parent=0','','id');
                    foreach ($cats as $cat) {
                   echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
                   //{} to identify that is avariable
                   $childCat =getAllFrom("*","categories","WHERE parent={$cat['id']}","","id");
                   foreach ($childCat as $child) {
                   echo "<option value='".$child['id']."'>--".$child['name']."</option>";
                   }
                    }?>
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
           <div class="col-sm-4 " >
                  <input 
                     id="myTags"
                      type="text" 
                      class="form-control" 
                      name="tags"
                      required
                      >
          </div>
        </div>
            <!-- End Tags Made -->
         <!-- Start  Image Made-->
        <div class="form-group">
            <label class="col-sm-2 control-label">Image</label>
           <div class="col-sm-4 " >
               <input 
                     type="file" 
                     id="file"
                     name="image"> 
          </div>
          <div id="message"></div>
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
					</div>
	<div class="col-md-4">
        <div class="thumbnail item-box live-preview">
      	    <span class="price-tag ">$<span class="live-price">0
      	    </span></span>
            <div id="image_preview"><img  
                                       id="previewing" 
                                       class="img-responsive" 
                                       src="AdminPanal/images/1.jpg" >
            </div>
              <div class="caption">
                    <h3 class="live-title">Title</h3>
                   <p class="live-desc">Description</p>
             </div>
           </div>
					</div>
				</div>
        <?php
          // Start Looping Through Errors
        if(!empty($formErrors)){
          foreach ($formErrors as $error) {
              echo "<div class='alert alert-danger'>$error</div>";
          }
        }
          if(isset($suceesMSG)){
              echo "<div class='alert alert-success'>$suceesMSG</div>";
            }
  //End Looping Through Errors
        ?>
			</div>
		</div>
	</div>
</div>

 
     
     








