<?php

if(!@include("../../main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

if(isset($_POST['Name'])){
	$name = $_POST['Name'];
	$users = $_POST['Users'];
	$bandwidth = $_POST['Bandwidth'];
	$diskSpace = $_POST['DiskSpace'];
	$domains = $_POST['Domains'];
	$subDomains = $_POST['SubDomains'];
	$databases = $_POST['Databases'];
	$ftpAccounts = $_POST['FTPAccounts'];
	$r = $da->addResellerPackage($name,$users,$bandwidth,$diskSpace,$domains,$subDomains,$databases,$ftpAccounts);
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