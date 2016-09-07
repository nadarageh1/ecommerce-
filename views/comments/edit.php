            <!-- form to edit-->
          <?php include 'comments.php';?>
     
          <h1 class="text-center" > Edit Comment</h1>
        <div class="container">
        <form class ="form-horizontal" action="?do=Update" method="POST">
          <input type="hidden" name="id" value="<?php echo  $commentId;?>">
          <!-- Start comment-->
            <!-- auto comlete off make browser not remember the username-->
              <div class="form-group">
            <label class="col-sm-2 control-label">Edit Comment </label>
             <div class="col-sm-4 ">
                  <textarea  class="form-control" name="comment">
                    <?php echo $comment['comment'];?>
                  </textarea>
          </div>
       </div>
            <!-- End comment-->
              <!-- Start Submit -->
             <div class="form-group">
            <div class=" col-sm-offset-2 ">
            <input type="submit" class="btn btn-primary" name="submit" value="Save">
            </div>
          </div>
             <!-- End Submit -->
        </form>
          </div>

