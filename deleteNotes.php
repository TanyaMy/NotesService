<?php 
session_start(); 
$id = $_POST['noteToDelete']; 

$con = new MongoClient(); 

$collection = $con -> notes -> data; 
$collection -> remove(array('_id' => new MongoId($id)), array("justOne" => true)); 
header('location: /calendar.php');
$con -> close();
?>
