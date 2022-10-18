<?php 
namespace API;

if(!@include("../../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

$ui = new UI();

$ui->headerReseller();

?>

<h1 class="h2 m-2">Reseller Settings</h1>

<?php
$ui->footer();
?>
