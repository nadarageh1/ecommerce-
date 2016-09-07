<?php
/*
==========================================
== manage categories page
== you can Add | Edit | Delete categories from here
==that is like CategoryController in laravel
========================================
*/

@session_start();
$pageTitle = "Categories Page";
// start 
if (isset($_SESSION['username'])){
include_once 'init.php';
	$do =isset($_GET['do'])? $_GET['do'] :"Manage";
	// start manage page
	//main page categories
	if($do=="Manage"){
    $sort = "ASC";
    $sort_array =array("ASC","DESC");
    if(isset($_GET['sort'])&& in_array($_GET['sort'],$sort_array)){
     $sort = $_GET['sort'];
    }
    //select all categories 
        $stmt1 = $conn->prepare("SELECT * FROM categories WHERE parent=0 ORDER BY ordering $sort;");
        $stmt1->execute();
        $cats =$stmt1->fetchAll();
        if(!empty($cats)){
           include_once 'views/categories/manage.php';
        }
         else{
          echo '<div class="container">';
          echo '<div class="nice-message">There Is No Categories To Show</div>';
          echo '<a href="categories.php?do=Add" class="btn btn-primary">
            <i class="fa fa-plus"></i>New Category </a>';
          echo '</div>';
        }
    }
	// link page add category
	elseif ($do=="Add") {
	 include_once ("views/categories/add.php");
	}
	// post submit add category
	elseif ($do == "Insert") {
  if($_SERVER['REQUEST_METHOD'] =='POST'){
     $name        =$_POST['name'];
     $description =$_POST['description'];
     $ordering    =$_POST['ordering'];
     $parent      =$_POST['parent'];
     $visibility  =$_POST['visibility'];
     $commenting  =$_POST['commenting'];
     $ads         =$_POST['ads'];

      // check if Category  Exist in Database
       /*  i create function  checkItems  
      to check if that item or user or category there is in database or not
      this function is in (includes/functions/functions.php) *prevent dublicated*
       */
          $check =checkItems("name","categories",$name);
          if($check == 1){
              $theMsg= '<div class="alert alert-danger">Sorry, that category is exist </div>'; 
              redirectHome($theMsg,'back');
          }
          else{
                     $stmt = $conn->prepare("INSERT INTO
                             categories(name,description,parent,ordering,visibility,
                             allowcomment,allowadvertisement)
                             VALUES
                             (:name,:description,:parent,:ordering,:visibility,:commenting,:ads)
                             ;");
                    $stmt->execute(
                    array(  
                  ':name'         =>$name,
                  ':description'  =>$description,
                  ':parent'       =>$parent,
                  ':ordering'     =>$ordering,
                  ':visibility'   =>$visibility,
                  ':commenting'   =>$commenting,
                  ':ads'          =>$ads
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
       $catId = 
       //check if id is numeric and get the integer value of it
        isset($_GET['CatID']) && is_numeric($_GET['CatID'])? 
        intval($_GET['CatID']): 0;
        // select data by PDO
        //Uitimate Function in Functions.php
        $cats =getAllFrom("*","categories","WHERE id={$_GET['CatID']}","","id","ASC");
        if(!empty($cats)){
           foreach ($cats as $cat) {
            include ("views/categories/edit.php");
          }
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
     $id =$_POST['id'];
     $name        =$_POST['name'];
     $description =$_POST['description'];
     $parent      =$_POST['parent'];
     $ordering    =$_POST['ordering'];
     $visibility  =$_POST['visibility'];
     $commenting  =$_POST['commenting'];
     $ads         =$_POST['ads'];
       // update the data with this info
        // check if no errors in array errors 
      $stmt = $conn->prepare("UPDATE categories
                                       SET
                                             name              =:name 
                                         ,
                                             description       =:description 
                                         ,
                                             parent            =:parent
                                         ,
                                             ordering          =:ordering
                                         ,
                                             visibility        =:visibility
                                         ,  
                                             allowcomment      =:commenting
                                         ,
                                             allowadvertisement =:ads
                                         WHERE 
                                             id       =:id
                                          LIMIT 1
                                             ;");
                          $stmt->execute(
                          array(  
                          ':name'         =>$name,
                          ':description'  =>$description,
                          ':parent'       =>$parent,
                          ':ordering'     =>$ordering,
                          ':visibility'   =>$visibility,
                          ':commenting'   =>$commenting,
                          ':ads'          =>$ads      ,
                          ':id'           =>$id
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
   //Delete Member page
    elseif ($do=="Delete") {
      $catId = 
   //check if id is numeric and get the integer value of it
    isset($_GET['CatID']) && is_numeric($_GET['CatID'])? 
    intval($_GET['CatID']): 0;
    // select data by PDO
    $check =checkItems("id","categories",$catId);
      if($check >0){
       $stmt = $conn->prepare("DELETE FROM categories WHERE id=:id LIMIT 1 ;");
       $stmt->execute(
        array(
          ':id'  =>$_GET['CatID']
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
    }
  else{
     header("Location: index.php"); // redirect to dashboard page 
     exit();
}


?>