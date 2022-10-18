<?php
namespace API;
if(!@include("../../main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

if(isset($_POST['Name'])){
	$r = $tshp->resellerPackages->create($_POST);
	echo json_encode(array("success" => true, "message" => "Reseller Package created successfully!", "data" => $r));
}else{
    http_response_code(405); // METHOD NOT ALLOWED
    echo json_encode(array("success"=>false,"error"=>"Method not allowed"));
}
?>