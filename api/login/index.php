<?php
namespace API;

if(!@include("../main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

use API\Auth\Session;

if(isset($_POST['username'])){
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$r = Session::Login(new \API\Models\Name($user),$pass);
	echo json_encode(array("success"=>true,"redirect"=>$r));
}else{
    http_response_code(405); // METHOD NOT ALLOWED
    echo json_encode(array("success"=>false,"error"=>"Method not allowed"));
}
?>