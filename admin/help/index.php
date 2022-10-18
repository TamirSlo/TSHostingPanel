<?php 
namespace API;

if(!@include("../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

$ui = new UI();

$ui->headerAdmin();
?>

<h1 class="h2 m-2">Help</h1>

<div class="card my-2">
    <div class="card-header">
        How can I create a new user?
    </div>
    <div class="card-body">
        <p class="card-text">Example</p>
        <a href="/admin/users" class="btn btn-primary MenuUsersBtn">Users</a>
    </div>
</div>

<?php
$ui->footer();
?>

</div>