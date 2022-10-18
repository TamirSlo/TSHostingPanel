<?php 
namespace API;

if(!@include("../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

$ui = new UI();

$ui->headerAdmin();

?>

<h1 class="h2 m-2">System Information</h1>
<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">General</h4>
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
                <th>Uptime</th>
                <th>CPUs Count</th>
            </tr>
            <tr>
                <th>05:00:28</th>
                <td>2</td>
            </tr>
        </table>
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">CPUs Information</h4>
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
                <th>Processor Name</th>
                <th>Vendor ID</th>
                <th>Processor Speed (MHz)</th>
            </tr>
            <tr>
                <td>Example 2</td>
                <td>Try</td>
                <td>4</td>
            </tr>
        </table>
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Memory Information</h4>
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
                <th>Total Memory</th>
                <th>Free Memory</th>
                <th>Available Memory</th>
                <th>Total Swap Memory</th>
                <th>Free Swap Memory</th>
                <th>Cached Swap Memory</th>
            </tr>
            <tr>
                <td>640 KB</td>
                <td>12KB</td>
                <td>0 B</td>
                <td>0 B</td>
                <td>0 B</td>
                <td>0 B</td>
            </tr>
        </table>
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Load Average</h4>
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
                <th>1 minute</th>
                <th>10 minutes</th>
                <th>25 minutes</th>
            </tr>
            <tr>
                <td>0.9</td>
                <td>0.4</td>
                <td>0.25</td>
            </tr>
        </table>
    </div>
</div>

<?php
$ui->footer();
?>
