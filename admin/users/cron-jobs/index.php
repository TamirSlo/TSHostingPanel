<?php 
namespace API;

if(!@include("../../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

$ui = new UI();

$ui->headerAdmin();

?>

<h1 class="h2 m-2">Manage Cron Jobs</h1>
<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Users</h4>
        <div class="float-right d-none d-md-block">
            <button class="btn btn-info mx-1" disabled><span class="fas fa-redo-alt mr-2"></span>Refresh</button>
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#adminModal" data-action="add"><span class="fas fa-plus mr-2"></span>Add Admin</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-info mx-1" disabled><span class="fas fa-redo-alt mr-2"></span>Refresh</button>
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#adminModal" data-action="add"><span class="fas fa-plus mr-2"></span>Add Admin</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table id="adminTable" class="table table-hover table-sm text-center" style="margin:0;">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Minute</th>
                <th>Hour</th>
                <th>Day of Month</th>
                <th>Month</th>
                <th>Day of Week</th>
                <th>Command</th>
            </tr>
            <tr>
                <th>1</th>
                <td>Example</td>
                <td>5</td>
                <td>10</td>
                <td>26</td>
                <td>5</td>
                <td>2</td>
                <td>home/demo/run</td>
            </tr>
        </table>
    </div>
</div>

<?php
$ui->footer();
?>
