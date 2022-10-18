<?php 
namespace API;

if(!@include("../../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

$ui = new UI();

$ui->headerAdmin();

?>

<h1 class="h2 m-2">Manage Backups</h1>
<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Users</h4>
        <div class="float-right d-none d-md-block">
            <button class="btn btn-info mx-1" disabled><span class="fas fa-redo-alt mr-2"></span>Refresh</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-info mx-1" disabled><span class="fas fa-redo-alt mr-2"></span>Refresh</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table id="adminTable" class="table table-hover table-sm text-center" style="margin:0;">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Date</th>
                <th>Location</th>
                <th>Options</th>
            </tr>
            <tr>
                <th>2</th>
                <td>Example</td>
                <td>27/05/2018</td>
                <td>home/backups</td>
                <td></td>
            </tr>
        </table>
    </div>
</div>

<?php
$ui->footer();
?>
