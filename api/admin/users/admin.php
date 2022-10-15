<?php

if(!@include("../../main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$user = $da->getUserByID($id);
	echo json_encode($user);
}else if(isset($_POST['Username'])){
	$user = $_POST['Username'];
	$pass = $_POST['Password'];
	$email = $_POST['Email'];
	$fname = $_POST['FName'];
	$lname = $_POST['LName'];
	$welcomemail = false;
	if(isset($_POST['id']) && $_POST['id'] != ""){
		$userid = $_POST['id'];
		$r = $da->editUser($userid,$user,$pass,$email,$fname,$lname);
	}else{
		$r = $da->addAdmin($user,$pass,$email,$fname,$lname,$welcomemail);
	}
	if($r['success']){
		echo json_encode($r);
	}else{
		echo json_encode($r);
	}
}else if(isset($_POST['delete'])){
	$id = $_POST['delete'];
	$r = $da->deleteUserByID($id);
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