<?php 

if(!@include("../../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

$ui = new UI();

$ui->headerReseller();
?>

<h1 class="h2 m-2">Messages</h1>

<?php
$ui->footer();
?>

</div>