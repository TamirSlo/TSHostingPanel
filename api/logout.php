<?php
namespace API;

if(!@include("main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

$r = $tshp->Logout();
if($r){
    die(json_encode($r));
}


?>