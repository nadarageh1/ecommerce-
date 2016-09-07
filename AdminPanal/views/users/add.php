            <!-- form to add-->
          <h1 class="text-center" > Add New Member</h1>
        <div class="container">
        <form class ="form-horizontal" action="?do=Insert" method="POST">
          <!-- Start username-->
            <!-- auto comlete off make browser not remember the username-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Enter Username </label>
             <div class="col-sm-4 ">
            <input type="text" class="form-control" name="username"  
            placeholder="Enter Username" autocomplete="off" required="required">
          </div>
       </div>
            <!-- End username-->
             <!-- Start  Fullname-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Enter Fullname </label>
             <div class="col-sm-4 ">
            <input type="text" class="form-control" name="fullname"  required="required"
             placeholder="Enter Fullname">
          </div>
        </div>
            <!-- End Fullname -->
             <!-- Start Password -->
             <!-- auto comlete new password make browser not remember the password-->
           <div class="form-group">
            <label class="control-label col-sm-2">Enter Password </label>
             <div class="col-sm-4 ">
            <input type="password" class="form-control password" name="password"  required="required"
            placeholder="Enter password" autocomplete="new-password">
            <i class="show-pass fa fa-eye fa-2px"></i>
          </div>
        </div>
           <!-- End Password -->
                  <!-- Start Email-->
           <div class="form-group">
            <label class=" col-sm-2 control-label">Enter Email </label>
             <div class="col-sm-4 ">
            <input type="email" class="form-control" name="email" required="required"
            placeholder="Enter Email" >
          </div>
        </div>
            <!-- End Email -->
              <!-- Start Submit -->
             <div class="form-group">
            <div class=" col-sm-offset-2 ">
            <input type="submit" class="btn btn-success" name="submit" value="Add Member">
            </div>
          </div>
             <!-- End Submit -->
        </form>
          </div>

