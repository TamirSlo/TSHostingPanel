<?php 
namespace API;

if(!@include("../../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

$ui = new UI();

$ui->headerAdmin();
?>

<h1 class="h2 m-2">Messages</h1>

<?php
$ui->footer();
?>
