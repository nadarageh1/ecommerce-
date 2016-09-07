<?php
/*
==========================================
== manage items page
== you can Add | Edit | Delete items from here
==that is like ItemsController in laravel
========================================
*/
@session_start();
$pageTitle = "Items Page";
// start 
if (isset($_SESSION['username'])){
  include_once 'init.php';
	$do =isset($_GET['do'])? $_GET['do'] :"Manage";
	// start manage page
	//main page items
	if($do=="Manage"){
     $query ='';
    if(isset($_GET['page'])&& $_GET['page']=="Pending"){
      $query ="AND approve =0";
    }
    //select all users Except admins
    //   INNER JOIN to get name of the category and users from other tables
        $stmt = $conn->prepare("SELECT 
                                   items.* ,
                                   categories.name AS cat_name ,
                                   users.username AS user_name 
                                FROM 
                                   items 
                                INNER JOIN 
                                   categories 
                                ON 
                                   categories.id = items.cat_id 
                                INNER JOIN 
                                   users 
                                ON 
                                   users.id =items.user_id 
                                ORDER BY 
                                    id 
                                DESC");
        $stmt->execute();
        $items =$stmt->fetchAll();
        if(!empty($items)){
             include_once 'views/items/manage.php';
        }
  else{
          echo '<div class="container">';
          echo '<div class="nice-message">There Is No Items To Show</div>';
          echo '<a href="items.php?do=Add" class="btn btn-primary">
            <i class="fa fa-plus"></i>New Item </a>';
          echo '</div>';
        }
     
    }
	// link page add item 
	elseif ($do=="Add") {        
    include_once 'views/items/add.php';
	}
	// post submit add items
	elseif ($do == "Insert") {
    if($_SERVER['REQUEST_METHOD'] =='POST'){
     $name        =$_POST['name'];
     $description =$_POST['description'];
     $price       =$_POST['price'];
     $country     =$_POST['country'];
     $status      =$_POST['status'];
     $member      =$_POST['member'];
     $category    =$_POST['category'];
     $tags        =$_POST['tags'];
     // to upload file
     // to Taking the file name and storing in variable $file_name 
     $image       =$_FILES['image']['name']; 
     // THis is Temporary Variable 
     $file_tmp    =$_FILES['image']['tmp_name'];
     // validate the form 
     $formErrors =array();
         if(empty($name)){
      $formErrors[] ='Name cannot be <strong> Empty</strong></div>';
        }
        if(empty($description)){
      $formErrors[] ='Description  cannot be <strong> Empty </strong>';
        }
        if (empty($price)) {
      $formErrors[] ='Price cannot b e<strong> Empty </strong> ';
        }
        if(empty($country)){
        $formErrors[] ='Country cannot be <strong> Empty </strong> ';
        }
        if ($status == 0) {
      $formErrors[]= 'You Must Choose The <strong> Status </strong> ';
        }
       if ($member == 0) {
      $formErrors[]= 'You Must Choose The <strong> Member </strong> ';
        }
       if ($category == 0) {
      $formErrors[]= 'You Must Choose The <strong> Category </strong> ';
        }
        if(empty($image)){
      $formErrors[]= 'You Must Choose The <strong> Image </strong> ';
        }
      
        foreach ($formErrors as $error) {
          $theMsg= '<div class="alert alert-danger">'.$error."</div>";
          redirectHome($theMsg,'back');
        }
        // Validation Of Upload
            $allowedExts = array("gif", "jpeg", "jpg", "png");
      $extension = end(explode(".", $image));
      if ((($_FILES["image"]["type"] == "image/gif")
      || ($_FILES["image"]["type"] == "image/jpeg")
      || ($_FILES["image"]["type"] == "image/jpg")
      || ($_FILES["image"]["type"] == "image/png"))
      && ($_FILES["image"]["size"] <  500000)
      && in_array($extension, $allowedExts)){
         move_uploaded_file($file_tmp,'images/'.$image);
         chmod('images/'.$image, 777);
         }
         else{
       $theMsg= '<div class="alert alert-danger">That Is Not Image</div>';
       redirectHome($theMsg,'back');
      }
        /* Insert item info in database
     check if no errors in array errors 
     */
     if(empty($formErrors)){
      $img='images/'.$image;
      $stmt = $conn->prepare("INSERT INTO
                             items(name,description,price,add_date,country_made,status,cat_id,user_id,tags,image)
                             VALUES
                             (:name,:description,:price,now(),:country,:status,:cat_id,:user_id,:tags,:image)
                             ;");
            $stmt->execute(
            array(  
          ':name'         =>$name,
          ':description'  =>$description,
          ':price'        =>$price,
          ':country'      =>$country,
          ':status'       =>$status,
          ':cat_id'       =>$category,
          ':user_id'      =>$member,
          ':tags'         =>$tags,
          ':image'        =>$img,
          ));
            // echo success message
        $theMsg= '<div class="alert alert-success">'.$stmt->rowCount().'records Inserted </div>'; 
        redirectHome($theMsg,'back');
      }
      }
  else{
        /*  i create function  redirectHome 
      to check if did any error get away from that page
      this function is in (includes/functions/functions.php)
       */
      $theMsg= '<div class="alert alert-danger">Sorry, you canot get this page redirectly</div>';
      redirectHome($theMsg,'back');
  }
  }
	// start control edit page
	  elseif ($do =="Edit") {
         //to organize the page the views in folder views
          // intval that mean return integer value
          $itemId = 
       //check if id is numeric and get the integer value of it
        isset($_GET['ItemID']) && is_numeric($_GET['ItemID'])? 
        intval($_GET['ItemID']): 0;
        // select data by PDO
        $items =getAllFrom("*","items","WHERE id={$_GET['ItemID']}"
          ,"","id","");
        if(!empty($items)){
            include_once ("views/items/edit.php"); 
        }
      
      else{
          $theMsg=" <div class='alert alert-danger'>There is no such id</div>";
          redirectHome($theMsg,'back');
        }
  }
    // submit form edit 
    // post edit
    elseif ($do =="Update") {
    if($_SERVER['REQUEST_METHOD'] =='POST'){
     $id          =$_POST['id'];    
     $name        =$_POST['name'];
     $description =$_POST['description'];
     $price       =$_POST['price'];
     $country     =$_POST['country'];
     $status      =$_POST['status'];
     $member      =$_POST['member'];
     $category    =$_POST['category'];
     $tags        =$_POST['tags'];
         // to upload file
     // to Taking the file name and storing in variable $file_name 
    $image       =$_FILES['image']['name']; 
     // THis is Temporary Variable 
     $file_tmp    =$_FILES['image']['tmp_name'];
     // validate the form 
     $formErrors =array();
         if(empty($name)){
      $formErrors[] ='Name cannot be <strong> Empty</strong></div>';
        }
        if(empty($description)){
      $formErrors[] ='Description  cannot be <strong> Empty </strong>';
        }
        if (empty($price)) {
      $formErrors[] ='Price cannot b e<strong> Empty </strong> ';
        }
        if(empty($country)){
        $formErrors[] ='Country cannot be <strong> Empty </strong> ';
        }
        if ($status == 0) {
      $formErrors[]= 'You Must Choose The <strong> Status </strong> ';
        }
       if ($member == 0) {
      $formErrors[]= 'You Must Choose The <strong> Member </strong> ';
        }
       if ($category == 0) {
      $formErrors[]= 'You Must Choose The <strong> Category </strong> ';
        }
        foreach ($formErrors as $error) {
          $theMsg= '<div class="alert alert-danger">'.$error."</div><br>";
          redirectHome($theMsg,'back');
        }
            // Validation Of Upload
            $allowedExts = array("gif", "jpeg", "jpg", "png");
      $extension = end(explode(".", $image));
      if ((($_FILES["image"]["type"] == "image/gif")
      || ($_FILES["image"]["type"] == "image/jpeg")
      || ($_FILES["image"]["type"] == "image/jpg")
      || ($_FILES["image"]["type"] == "image/png"))
      && ($_FILES["image"]["size"] <  500000)
      && in_array($extension, $allowedExts)){
         move_uploaded_file($file_tmp,'images/'.$image);
         chmod('images/'.$image, 777);
         $img ='images/'.$image;
         }
      // update the data with this info
        // check if no errors in array errors 
        if(empty($formErrors)){
          if(empty($img)){
            $items =getAllFrom("*","items","WHERE id={$id}","","id","");
             foreach ($items as $item) {
                 $img=$item['image'];
              }
          }
              $stmt = $conn->prepare("UPDATE items
                                       SET
                                             name        =:name 
                                         ,
                                             description =:description 
                                         ,
                                             price       =:price
                                         ,
                                             country_made =:country
                                         ,
                                             status      =:status
                                         ,
                                             user_id     =:member
                                         ,
                                             cat_id      =:category  
                                         ,
                                             tags        =:tags
                                         ,
                                             image       =:image
                                               
                                         WHERE 
                                             id       =:id
                                          LIMIT 1
                                             ;");
                          $stmt->execute(
                          array(  
                        ':name'        =>$name,
                        ':description' =>$description,
                        ':price'       =>$price,
                        ':country'     =>$country,
                        ':status'      =>$status,
                        ':member'      =>$member,
                        ':category'    =>$category,
                        ':tags'        =>$tags,
                        ':image'       =>$img,
                         ':id'         =>$id
                        ));
                          // echo success message

  $theMsg= '<div class="alert alert-success">'.$stmt->rowCount().'records Updated</div>'; 
  redirectHome($theMsg,'back');
        }
  else{
    /*  i create function  redirectHome 
      to check if did any error get away from that account 
      this function is in (includes/functions/functions.php)
       */
      $theMsg= 'class="alert alert-danger"> Sorry, you canot get redirectly</div> ';
      redirectHome($theMsg,'back',$seconds=6);
  }
}
  
}
   //Delete Member page
    elseif ($do=="Delete") {
    $itemId = 
   //check if id is numeric and get the integer value of it
    isset($_GET['ItemID']) && is_numeric($_GET['ItemID'])? 
    intval($_GET['ItemID']): 0;
    // select data by PDO
    $check =checkItems("id","items",$itemId);
       if($check >0){
          $items = getAllFrom("*","items","WHERE id ={$_GET['ItemID']}",
                "","id");
          foreach ($items as $item) {
            $file=$item['image'];
            if(!empty($file)){
                @unlink($file);
            }
        }
       $stmt = $conn->prepare("DELETE FROM items WHERE id=:id LIMIT 1 ;");
       $stmt->execute(
        array(
          ':id'  =>$_GET['ItemID']
      ));
      $theMsg= '<div class="alert alert-success">'.$stmt->rowCount().'records Deleted </div>';  
       redirectHome($theMsg,'back');
         }
      else{
      $theMsg= '<div class="alert alert-danger">no such this id</div>';
      redirectHome($theMsg,'back');
      }
      }
      //End Delete
     //Aprove of that item 
    elseif ($do =="Approve") {
    $itemId =
          //check if id is numeric and get the integer value of it
    isset($_GET['ItemID']) && is_numeric($_GET['ItemID'])? 
    intval($_GET['ItemID']): 0;
    // select data by PDO
    $check =checkItems("id","items",$itemId);
      if($check >0){
       $stmt = $conn->prepare("UPDATE items SET approve =1 WHERE id=:id  LIMIT 1 ;");
       $stmt->execute(
        array(
          ':id'  =>$_GET['ItemID']
            ));
      $theMsg= '<div class="alert alert-success">'.$stmt->rowCount().'records Updated </div>'; 
       redirectHome($theMsg,'back');
         }
      else{
      $theMsg= '<div class="alert alert-danger">no such this id</div>';
      redirectHome($theMsg,'back');
      }
    }
  }
  else{
     header("Location: index.php"); // redirect to dashboard page 
     exit();
    }
?>