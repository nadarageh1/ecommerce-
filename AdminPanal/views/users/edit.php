            <!-- form to edit-->
          <?php include 'users.php';?>
     
          <h1 class="text-center" > Edit Member</h1>
        <div class="container">
        <form class ="form-horizontal" action="?do=Update" method="POST">
          <input type="hidden" name="id" value="<?php echo  $userId;?>">
          <!-- Start username-->
            <!-- auto comlete off make browser not remember the username-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Edit Username </label>
             <div class="col-sm-4 ">
            <input type="text" class="form-control" name="username"  
            placeholder="Edit Username" autocomplete="off" required="required"
             value="<?php echo $row['username'];?>">
          </div>
       </div>
            <!-- End username-->
             <!-- Start  Fullname-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Edit Fullname </label>
             <div class="col-sm-4 ">
            <input type="text" class="form-control" name="fullname"  required="required"
             placeholder="Edit Fullname" value="<?php echo $row['fullname'];?>">
          </div>
        </div>
            <!-- End Fullname -->
             <!-- Start Password -->
             <!-- auto comlete new password make browser not remember the password-->
           <div class="form-group">
            <label class="control-label col-sm-2">Edit Password </label>
             <div class="col-sm-4 ">
               <input type="hidden" class="form-control" name="oldpassword" 
          value="<?php echo $row['password'];?>">
            <input type="password" class="form-control" name="newpassword" 
            placeholder="Leave Blank If You Dont Want To Change" autocomplete="new-password">
          </div>
        </div>
           <!-- End Password -->
                  <!-- Start Email-->
           <div class="form-group">
            <label class=" col-sm-2 control-label">Edit Email </label>
             <div class="col-sm-4 ">
            <input type="email" class="form-control" name="email" required="required"
            placeholder="Edit Email" value="<?php echo $row['email'];?>">
          </div>
        </div>
            <!-- End Email -->
              <!-- Start Submit -->
             <div class="form-group">
            <div class=" col-sm-offset-2 ">
            <input type="submit" class="btn btn-primary" name="submit" value="Save">
            </div>
          </div>
             <!-- End Submit -->
        </form>
          </div>

