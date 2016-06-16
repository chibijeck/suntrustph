<?php 
//include("includes/header.php");
include('class/database.php');
include('class/userClass.php');

$email = $_POST['email'];
//print_r($email);

$user = new user();
$user->selectName($email); 
$name = $user->getname();
if(!empty( $name )){
	echo 'user_id: '. $user->getid() ." | name: ". $user->getname() ." | email: ". $user->getemail(); 
}else{
	echo "no records founds!";
}

//print_r($user->getemail());
