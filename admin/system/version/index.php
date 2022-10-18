<?php 
namespace API;

if(!@include("../../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

$ui = new UI();

$ui->headerAdmin();

?>

<h1 class="h2 m-2">Panel Information</h1>
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
                <th>Name</th>
                <th>Version</th>
                <th>License</th>
                <th>Last Updated</th>
            </tr>
            <tr>
                <td>TSHP</td>
                <td>0.1.1</td>
                <td>Verified by TSHP</td>
                <td>18/12/2021</td>
            </tr>
        </table>
    </div>
</div>

<?php
$ui->footer();
?>
