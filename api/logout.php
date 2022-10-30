<?php
namespace API;

use API\Auth\Session;

if(!@include("main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

Session::logout();
die(json_encode(array("success" => true)));

?>