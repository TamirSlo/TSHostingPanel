<?php
namespace API;

if(!@include("../../main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$user = $tshp->users->getUserByID($id);
	echo json_encode(array("success"=>true,"data"=>$user));
}else if(isset($_POST['Username'])){
	$user = $_POST['Username'];
	$pass = $_POST['Password'];
	$email = $_POST['Email'];
	$fname = $_POST['FName'];
	$lname = $_POST['LName'];
	$welcomemail = false;
	if(isset($_POST['UserID']) && $_POST['UserID'] != ""){
		$userid = $_POST['UserID'];
		$r = $tshp->users->getUserByID($userid)->edit($user,$pass,$email,$fname,$lname, Models\UserType::Admin(), null);
	}else{
		$r = $tshp->users->create($_POST, Models\UserType::Admin());
	}
	echo json_encode($r);
}else if(isset($_POST['delete'])){
	$id = $_POST['delete'];
	$r = $tshp->users->deleteByID($id);
	echo json_encode(array("success"=>$r));
}else{
    http_response_code(405); // METHOD NOT ALLOWED
    echo json_encode(array("success"=>false,"error"=>"Method not allowed"));
}
?>