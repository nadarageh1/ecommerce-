<?php  
include_once 'init.php'; 
?>
<html>
<head>
	<title><?php getTitle();?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $css;?>bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $css;?>font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $css;?>jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $css;?>jquery.selectBoxIt.css">
<link rel="stylesheet" type="text/css" href="<?php echo $css;?>/front.css">
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $css;?>jquery.tagit.css">
</head>
<body>
<div class="upper-bar ">
	<div class="container text-left">
    <?php 
    if(isset($_SESSION['user'])) {?>
        <?php
        $informations = getAllFrom("*","users","WHERE username='{$_SESSION['user']}'","","id","ASC");
        foreach ($informations as $info) {
           if($info['profile_pic']==''){
                echo '<img class=" my-image img-circle img-thumbnail" src="AdminPanal/images/1.jpg" alt="">';
            }
            else { 
               echo '<img class=" my-image img-circle img-thumbnail"  src="AdminPanal/'.$info['profile_pic'].'" alt="">';
                }
        }
         // echo '<img class=" my-image img-circle img-thumbnail"  src="AdminPanal/profiles/5eb24622-5525-45b2-8bf7-b8000d4475ac-original.jpeg"';
        ?>
    <div class="btn-group my-info">
      <span class="btn dropdown-toggle" data-toggle="dropdown" class="pull-right">
        <?php echo $sessionUser; ?>
        <!-- caret to make Arrow in page -->
        <span class="caret"> </span>
      </span>
          <ul class="dropdown-menu">
            <li><a href="profile.php"> MyProfile</a></li>
            <li><a href="newitem.php"> New Item</a></li>
            <li><a href="profile.php#my-ads"> My Items</a></li>
            <li><a href="logout.php"> LogOut</a></li>
          </ul>
    </div>
    <?php
    }
    else {
    echo '<a href="login.php" class="pull-right">SignIn/Login</a>';
     }
    ?>
	</div>
</div>
<nav class="navbar navbar-default" >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php" style="margin-left:50px">HomePage</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <!--getAllFrom Ultimate Function  in functions.php  -->
       <?php 
        // category And Subcategory
       $categories =getAllFrom("*","categories","WHERE parent=0","","id","ASC");
      foreach ($categories as $category) {
        echo '<li class="dropdown">';
       echo '<a class="dropdown-toggle" data-toggle="dropdown" href="categories.php?pageid='.$category['id'].'">'.$category['name'];
       echo  '<span class="caret"></span></a>';
       $catChild =getAllFrom("*","categories","WHERE parent={$category['id']}","","id","ASC");
             echo '<ul class="dropdown-menu">';
                echo '<a  class="main-category" href="categories.php?pageid='.$category['id'].'">'.$category['name'];
              echo  '<span class="caret"></span></a>';
               foreach ($catChild as $child) {
               echo'<li><a href="categories.php?pageid='.$child['id'].'">'.$child['name'].'</a></li>';
             }
        echo '</ul>';
       echo '</li>';
             } ?>
   
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="header">
</div>