<?php 

if(!@include("../../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

$ui = new UI();

$ui->headerReseller();

/*$adminList = $da->getAdmins();
$resellerList = $da->getResellers();
$resellerPackages = $da->getResellerPackages();*/
?>

<h1 class="h2 m-2">Reseller Settings</h1>

<?php
$ui->footer();
?>
