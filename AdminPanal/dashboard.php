<?php 
// to solve problem in headers olready sent
@session_start();
$pageTitle = "Dashboard Page";
if (isset($_SESSION['username'])){
include 'init.php';	
/* Start dashboard Page */
  // code to get 5 Latest registered users 
      $NumUsers =5;
      $latestUsers =getLatest("*" ,"users","id",$NumUsers);
          // code to get 5 Latest registered users 
      $NumItems =6;
      $latestItems =getLatest("*" ,"items","id",$NumItems);
      // code to get 5 Latest registered comments 
      $NumComments =4;
      $latestComments =getLatest("*" ,"comments","id",$NumComments);


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

                                    ORDER BY
                                           id
                                    DESC 
                                    LIMIT 
                                           $NumComments                
                                      ;");
        $stmt->execute(array(
          ));
        $comments =$stmt->fetchAll();

include'views/dashboard.php';
}
else{
	
header("Location: index.php"); // redirect to dashboard page 
   exit();
}
?>











