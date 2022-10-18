<?php
namespace API;

if(!@include("../main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

if(isset($_POST['username'])){
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$r = $tshp->Login($user,$pass);
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