          <?php include 'comments.php';?>
           <!-- form to add-->
          <h1 class="text-center" > Manage Comments</h1>
        <div class="container ">
        	<div class="table-responsive">
        	<table class="table table-bordered main-table text-center ">
        		<tr>
                 <td>ID</td>
                 <td>Comment</td>
                  <td>Item Name</td>
                  <td>Username</td>
                  <td>Added Date</td>
                  <td>Control</td>
        		</tr>
        		<?php
                 foreach ($comments as $comment) {
              
                 echo "<tr>";
                 echo "<td>".$comment['id']      ."</td>";
                 echo "<td>".$comment['comment']."</td>";
                 echo "<td>".$comment['item_name']."</td>";
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
          </div>



