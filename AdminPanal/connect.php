<?php
//connect to database
$dsn      ='mysql:host=localhost;dbname=shop';
$user     ='root';
$password ='nada123';
try{
	$conn =new PDO($dsn,$user,$password);
	
}
catch(PDOException $e){
echo $e->getMessage();
}
?>