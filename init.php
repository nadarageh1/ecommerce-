<?php
// this file to make easy to 
//change the name of the the files 
//for example templates to tmps soo easy 
//change in that file only
//////////////////////////// 



// rout
// template directory
@session_start();
$tmp  ='includes/templates/';
$css  ='views/layout/css/';     // css directory
$js   ='views/layout/js/';       // js directory
$lang ='includes/languages/';    //language directory
$func ='includes/functions/'; 

$sessionUser ='';
if(isset($_SESSION['user'])){
	$sessionUser = $_SESSION['user'];
}
 //include the important files
//include function Directory
include $func .'functions.php';
include 'AdminPanal/connect.php';
include $tmp.'header.php';
include $tmp.'footer.php';
include $lang.'english.php';
include $lang.'arabic.php';
?>