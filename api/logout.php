<?php

if(!@include("main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

$r = $da->Logout();
if($r){
    die(json_encode($r));
}


?>