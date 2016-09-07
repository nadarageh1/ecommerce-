          <?php include 'users.php';?>
           <!-- form to add-->
          <h1 class="text-center" >Manage Users</h1>
        <div class="container ">
        	<div class="table-responsive">
        	<table class="table table-bordered main-table text-center ">
        		<tr>
                 <td>ID</td>
                 <td>Username</td>
                  <td>Email</td>
                  <td>Fullname</td>
                  <td>Registered Date</td>
                  <td>Control</td>
        		</tr>
        		<?php
                 foreach ($rows as $row) {
              
                 echo "<tr>";
                 echo "<td>".$row['id']      ."</td>";
                 echo "<td>".$row['username']."</td>";
                 echo "<td>".$row['email']."</td>";
                 echo "<td>".$row['fullname']."</td>";
                 echo "<td>".$row['date']."</td>";
                 echo "<td>"."<a href='users.php?do=Edit&UserID=".$row['id']."'class='btn btn-success '> <i class='fa fa-edit'></i> Edit </a>".
                             "<a href='users.php?do=Delete&UserID=".$row['id']."' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
                              if($row['regstatus'] == 0){
                echo "<a href='users.php?do=Activate&UserID=".$row['id']."' class='btn btn-info activate'><i class='fa fa-check'></i> Activate </a>";
                             }
                             echo "</td>";


                 echo "</tr>";
                 }
        		?>
        	</table>
        	</div>
          <a href='users.php?do=Add' class="btn btn-primary">
            <i class="fa fa-plus"></i>New User </a>
          </div>
         



