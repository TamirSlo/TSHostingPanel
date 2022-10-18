<?php 
namespace API;

if(!@include("../../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

$ui = new UI();

$ui->headerAdmin();

?>

<h1 class="h2 m-2">Logs</h1>
<div>
    <span>Please select a log file to view:</span>
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select log file
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item">Cron jobs</a>
            <a class="dropdown-item" href="#">Messages</a>
            <a class="dropdown-item" href="#">Error logs</a>
        </div>
    </div>
</div>

<div>
    <span>Options:</span>
    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
</div>

<?php
$ui->footer();
?>
