<?php 

if(!@include("../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

$ui = new UI();

$ui->headerReseller();
?>
<h1 class="h2 m-2">Dashboard</h1>


<div class="card">
    <h4 class="card-header">Reseller Quota</h4>
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-md-4 p-3 text-center">
                <span class="font-weight-light">Users</span>
                <div class="progress text-danger" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 66%;" aria-valuenow="2" aria-valuemin="0" aria-valuemax="3">2 (3)</div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 p-3 text-center">
                <span class="font-weight-light">Domains</span>
                <div class="progress text-danger" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 20%;" aria-valuenow="2" aria-valuemin="0" aria-valuemax="10">2 (10)</div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 p-3 text-center">
                <span class="font-weight-light">Disk Space</span>
                <div class="progress text-danger" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">1 (&infin;)</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$ui->footer();
?>
