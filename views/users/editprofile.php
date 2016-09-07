     <!-- form to Edit-->
     <?php foreach ($informations as $info) { ?>
          <h1 class="text-center" > Edit Profile</h1>
        <div class="container">
        <form class ="form-horizontal" action="editprofile.php" method="POST"  enctype="multipart/form-data">
        	<input type="hidden" name="id" value="<?php echo  $info['id'];?>">
          <!-- Start Name Field-->
           <div class="row">
            <!-- Start  Image Made-->
              <div class="col-md-3">
          <?php
           if($info['profile_pic']==''){
            echo '<div  id="image_preview">';
                echo '<img class="img-responsive"   id="previewing" src="AdminPanal/profiles/1.jpg" alt="">';
            echo '</div>';
            }
            else { 
            echo '<div  id="image_preview">';
               echo '<img class="img-responsive"  id="previewing"  src="AdminPanal/'.$info['profile_pic'].'" alt="">';
            echo '</div>';
                }
         ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Image</label>
           <div class="col-sm-4 " >
               <input 
                     type="file" 
                     id="file"
                     name="image"> 
          </div>
        </div>
         <div id="message"></div>
            <!-- End Image Made -->
      </div>
          <div class="col-md-9">
            <!-- auto comlete off make browser not remember the username-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Username </label>
             <div class="col-sm-4 ">
            <input 
                  type="text" 
                  class="form-control" 
                  name="username"  
                  value="<?php echo $info['username'];?>" >
          </div>
       </div>
            <!-- End name Field-->
               <!-- Start Email -->
           <div class="form-group">
            <label class="control-label col-sm-2">Email </label>
             <div class="col-sm-4 ">
            <input 
                  type="text" 
                  class="form-control" 
                  name="email"  
                  value="<?php echo $info['email'];?>" >
          </div>
        </div>
           <!-- End Email -->
             <!-- Start  fullname-->
              <div class="form-group">
            <label class="col-sm-2 control-label">FullName </label>
             <div class="col-sm-4 ">
            <input 
                  type="text" 
                  class="form-control" 
                  name="fullname" 
                  value="<?php echo $info['fullname'];?>" 
                 >
          </div>
        </div>
            <!-- End FullName -->
               <!-- Start  Password-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Password </label>
             <div class="col-sm-4 ">
            <input 
                  type="text" 
                  class="form-control" 
                  name="password" 
                  value="" 
                 >
                 <?php $_SESSION['pass'] = $info['password']; ?>
          </div>
        </div>
            <!-- End Password -->
              <!-- Start Submit -->
             <div class="form-group">
            <div class=" col-sm-offset-2 ">
            <input type="submit" class="btn btn-success" name="submit" value="Save">
            </div>
          </div>
        </div>
             <!-- End Submit -->
        </form>
          </div>
         <?php } ?>
