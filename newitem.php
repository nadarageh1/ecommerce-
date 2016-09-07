<?php 
$pageTitle = "New Item Page";
include 'init.php';
if(isset($_SESSION['user'])){
     if($_SERVER['REQUEST_METHOD'] =='POST'){
     $title       =filter_var($_POST['name'],FILTER_SANITIZE_STRING);
     $description =filter_var($_POST['description'],FILTER_SANITIZE_STRING);
     $price       =filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
     $country     =filter_var($_POST['country'],FILTER_SANITIZE_STRING);
     $category    =filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
     $status      =filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
     $tags        =filter_var($_POST['tags'],FILTER_SANITIZE_STRING);
      // to upload file
     // to Taking the file name and storing in variable $file_name 
    $image       =$_FILES['image']['name']; 
     // THis is Temporary Variable 
     $file_tmp    =$_FILES['image']['tmp_name'];
   //  validate the form 
     $formErrors =array();
         if(strlen($title)<4){
      $formErrors[] ='Name Must Be At Least  <strong> 4 Characters</strong>';
        }
        if(strlen($description)<10){
      $formErrors[] ='Description Must Be At Least  <strong> 10 Characters</strong>';
        }
        if(strlen($country)<2){
      $formErrors[] ='Country Must Be At Least  <strong> 2 Characters</strong>';
        }
        if(empty($description)){
      $formErrors[] ='Description  cannot be <strong> Empty </strong>';
        }
        if (empty($price)) {
      $formErrors[] ='Price cannot b e<strong> Empty </strong> ';
        }
        if ($status == 0) {
      $formErrors[]= 'You Must Choose The <strong> Status </strong> ';
        }
       if ($category == 0) {
      $formErrors[]= 'You Must Choose The <strong> Category </strong> ';
        }
        if(empty($image)){
       $formErrors[]= 'You Must Choose The <strong> Image </strong> ';
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
         move_uploaded_file($file_tmp,'AdminPanal/images/'.$image);
         }
         else{
       $formErrors[] ='That Is Not <strong> Image </strong>';
      }
    // /* Insert user info in database
    //  check if no errors in array errors 
    //  */
        if(empty($formErrors)){
          $img='images/'.$image;
                     $stmt = $conn->prepare("INSERT INTO
                             items(name,description,price,add_date,country_made,status,cat_id,user_id,tags,image)
                             VALUES
                             (:name,:description,:price,now(),:country,:status,:cat_id,:user_id,:tags,:image)
                             ;");
            $stmt->execute(
            array(  
          ':name'         =>$title,
          ':description'  =>$description,
          ':price'        =>$price,
          ':country'      =>$country,
          ':status'       =>$status,
          ':cat_id'       =>$category,
          ':tags'         =>$tags,
          ':image'        =>$img,
          ':user_id'      =>$_SESSION['user_id']
          ));
            // echo success message
        $suceesMSG= 'Congeratulation, Now You Are Insert Item '; 
        }  
      }
     }
else{
	header("Location: login.php");
}
 include_once 'views/items/newitem.php';
?>
