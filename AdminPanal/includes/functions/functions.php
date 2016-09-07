<?php
/*
**Ultimat Function
** Get All Recordes function  v1.0
** Function to Get All Items from Any Database Table                
*/
function getAllFrom($field,$table,$where=NULL,$and=NULL,$orderBy,$ordering="DESC"){
	   global $conn;
	    $getAll = $conn->prepare("SELECT * FROM  $table $where $and ORDER BY $orderBy $ordering");
		$getAll->execute();
		$all=  $getAll->fetchAll();
		return $all;
}
/* getTitle function v1
** function title that Echo the page title in case 
** the page has the variable $pageTitle
** echo default title for other page 

*/
function getTitle(){
	global $pageTitle;
	if (isset($pageTitle)) {
			echo $pageTitle;
	}
	else {
		echo "Default";
	}


}
/* redirectHome function  v2.0
** Redirect function        [ This function accept parameters ]
** $theMsg = Echo  Message  [Error |Success | Warning]
** $url    =  Link you want to Redirect to
** $seconds  =seconds before Redirecting
*/
function redirectHome($theMsg,$url=null,$seconds=3){
	if($url === null){
		$url ='dashboard.php';

	}
	else{
		//$_SERVER['HTTP_REFERER'] redirect page that i stayed it
		if(isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER'] !==''){
			$url =$_SERVER['HTTP_REFERER'];
			$Link ="Previous Page";
		}else{
			$url  ='dashboard.php';
			$Link ='HomePage';
		}
		
	}
	echo $theMsg;
	echo "<div class='alert alert-info'> you will redirected to $Link after $seconds seconds </div>";
    header("refresh:$seconds;url=".$url);
    exit();
}
/* check Items function  v1.0
** Function to check Items in Database [Function Accept parameters]
** $select= the Item To Select         [Example  user   category item]
** $table  =the table to select from    [Example: users items categories]
**$value  the value Of Select          [Example:nada ]
*/
function checkItems($select,$table,$value){
	global $conn;
	$statement = $conn->prepare("SELECT $select FROM $table WHERE $select =:value");
	   $statement->execute(
        array(
        	':value'  =>$value
	    ));
	    $count =$statement->rowCount();
	    /*if write echo instead of return 
	    that function all print $count
        echo do not make function  flixable 
	    */ 
	    return  $count;
	  
}
/* 
**Count numbers of items function  v1.0
** Function count numbers of items of rows
** $item  =The Item To Count
** $table =The table To choose From
*/
function countItems($item ,$table){
	global $conn;
		$stmt =$conn->prepare("SELECT COUNT($item) FROM $table");
		$stmt->execute();
		return $stmt->fetchColumn();
}
/*
** Get Latest Recordes function  v1.0
** Function to Get Latest Items from Database [Users Items Comments ]
** $select= field To Select                   [Example  user   category item]
** $table  =the table to select from          [Example: users items categories]
** $order  =The DESCINDING Ordering
** $limit  =Numbers of records                
*/
function getLatest($select ,$table,$order,$limit =5){
	global $conn;
	    $getStmt = $conn->prepare("SELECT $select FROM  $table  ORDER BY $order DESC Limit $limit");
		$getStmt->execute();
		$rows=  $getStmt->fetchAll();
		return $rows;
}

?>