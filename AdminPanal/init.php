<?php
// this file to make easy to 
//change the name of the the files 
//for example templates to tmps soo easy 
//change in that file only
//////////////////////////// 



// rout
// template directory

$tmp  ='includes/templates/';
$css  ='views/layout/css/';     // css directory
$js   ='views/layout/js/';       // js directory
$lang ='includes/languages/';    //language directory
$func ='includes/functions/'; 


 //include the important files
//include function Directory
include $func .'functions.php';
include 'connect.php';
include $tmp.'header.php';
include $tmp.'footer.php';
include $lang.'english.php';
include $lang.'arabic.php';


// include navebar in all pages  Except that 
//the one has the variable $noNavebar it make easy more
if(!isset($noNavebar)){
 include $tmp .'navbar.php';
}








?>