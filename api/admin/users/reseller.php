<?php

if(!@include("../../main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

if(isset($_POST['Username'])){
	$user = $_POST['Username'];
	$pass = $_POST['Password'];
	$email = $_POST['Email'];
	$fname = $_POST['FName'];
	$lname = $_POST['LName'];
	$welcomemail = false;
	$r = $da->addReseller($user,$pass,$email,$fname,$lname,$welcomemail);
	if($r['success']){
		echo json_encode($r);
	}else{
		echo json_encode($r);
	}
}else{
    http_response_code(405); // METHOD NOT ALLOWED
    echo json_encode(array("success"=>false,"error"=>"Method not allowed"));
}
?>