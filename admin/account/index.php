<?php 

if(!@include("../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

$ui = new UI();

$ui->headerAdmin();
?>

<h1 class="h2 m-2">Settings</h1>

<?php
$ui->footer();
?>