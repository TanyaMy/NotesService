<?php
if(isset($_POST['login']))
$login = $_POST['login']; 
if(isset($_POST['password'])){ $password = $_POST['password']; }
$con = new MongoClient();
$collection= $con-> notes-> users;
$user = $collection -> findOne(array('login' => $login));
if (!empty($user)){
if ($user['password'] == md5($password)) 
    { 
    session_start(); 
    $_SESSION["session_login"] = $login; 
    
    header('Refresh:0;URL=tabl_cal.php'); 
    $con -> close();  
    }
 else {
     echo "Wrong password";
    }
}
else {
    echo"Please, sign out";
      
}
   