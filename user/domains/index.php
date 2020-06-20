<?php 

if(!@include("../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

$ui = new UI();

$ui->header();
?>

<h1 class="h2 m-2">Domains</h1>
<div class="card disabled">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Active domains</h4>
        <button class="btn btn-success float-right" disabled>Add domain</button>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover table-sm text-center" style="margin:0;">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Domain</th>
                    <th scope="col">SSL</th>
                    <th scope="col">FTP accounts</th>
                    <th scope="col">Databases</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
        </table>
        <table class="table table-hover table-sm text-center" style="margin:0;">
            <tbody>
                <tr>
                    <th width="5%">1</th>
                    <td width="30%">demo.com</td>
                    <td width="5%">&#10003;</td>
                    <td width="15%">1/10</td>
                    <td width="15%">1/&infin;</td>
                    <td width="30%">
                        <button id="dom1subsbtn" class="btn btn-warning px-1 py-0 mx-1" disabled>
                            <i id="dom1arrow" class="fa fa-caret-right iconRotate mr-1"
                                style="transition: 0.6s;">
                            </i>
                            Subdomains
                        </button>
                        <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                        <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="dom1s" style="display:none;">
            <table class="table table-hover table-sm text-center" style="margin:0;">
                <tr>
                    <td width="5%">
                        <a class="btn btn-success px-1 py-0 mx-1" href="#">New...</a>
                    </td>
                    <td width="30%">subdomain.demo.com</td>
                    <td width="5%"></td>
                    <td width="15%">
                        <a class="btn btn-info px-1 py-0 mx-1" href="#">Edit</a>
                        <a class="btn btn-danger px-1 py-0 mx-1" href="#">Delete</a>
                    </td>
                    <td width="15%"></td>
                    <td width="30%"></td>
                </tr>
            </table>
        </div>
        <table class="table table-hover table-sm text-center" style="margin:0;">
            <tbody>
                <tr>
                    <th width="5%">2</th>
                    <td width="30%">mysite.com</td>
                    <td width="5%">&#10007;</td>
                    <td width="15%">1/10</td>
                    <td width="15%">0/&infin;</td>
                    <td width="30%">
                        <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                        <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
$ui->footer();
?>
