<?php 
ob_start();
$pageTitle = "Items Page";
include 'init.php';
	           $itemId = 
       //check if id is numeric and get the integer value of it
        isset($_GET['itemid']) && is_numeric($_GET['itemid'])? 
        intval($_GET['itemid']): 0;
        // select data by PDO
          $stmt = $conn->prepare("SELECT 
                                            items.* ,
                                            categories.name 
                                  AS 

                                            category_name,
                                            users.username 
                                  AS
                                            username
                                  FROM 
                                            items 
                                  INNER JOIN 
                                            categories
                                  ON 
                                            categories.id =items.cat_id
                                  INNER JOIN 
                                            users
                                  ON 
                                            users.id =items.user_id
                                  WHERE 
                                             items.id=:id 
                                  AND
                                             approve=1
                                 ;");
            $stmt->execute(
            array(
             ':id'  =>$_GET['itemid']
             ));
         
      // to take  all data from database to work with them 
      $item  = $stmt->fetch();
      $count = $stmt->rowCount();
      if($count >0){
             // select comments by PDO
          $stmt = $conn->prepare("SELECT 
                                            comments.* ,
                                            users.username 
                                 AS
                                            username,
                                            users.profile_pic
                                 AS
                                            image
                                 FROM 
                                            comments
                                 INNER JOIN 
                                            users
                                 ON 
                                            users.id =comments.user_id
                                 WHERE 
                                            item_id =:item_id
                                 AND 
                                            status =1
                                 ORDER BY 
                                            id 
                                 DESC
                                     ");
          $stmt->execute(
          array(
          'item_id'=>$item['id']
              ));
          $comments  = $stmt->fetchAll();
        include 'views/items/items.php';

      }
          //End Select comments
       if(isset($_POST['addcomment'])){
       if($_SERVER['REQUEST_METHOD']=='POST'){
       
          $comment =filter_var($_POST['comment'],FILTER_SANITIZE_STRING) ;
         $userid  = $_SESSION['user_id'];
         $itemid  =$item['id'];
         if(!empty($comment)){
         $stmt = $conn->prepare("INSERT INTO 
                                        comments 
                                        (comment,status,comment_date,item_id,user_id)
                             VALUES 
                                        (:comment,0,now(),:item_id,:user_id)");
        $stmt->execute(array(
         ':comment'=>$comment,
         ':item_id'=>$itemid,
         ':user_id'=>$userid
        
          ));
        } 
        }
        else{
            echo '<div class="container">';
              echo '<div class="alert alert-danger">
              There is No Such Id </div>';
          echo '</div>';
        }
         }
          elseif($item['approve'] ==0){
          echo '<div class="container">';
              echo '<div class="alert alert-danger">
              This Item Is Waiting Approval</div>';
          echo '</div>';
      }
         
     
ob_end_flush();
?>
