<?php 

if(!@include("../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

$ui = new UI();

$ui->headerAdmin();
$resellerPackages = $da->getResellerPackages();

?>

<h1 class="h2 m-2">Reseller Packages</h1>
<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Packages List</h4>
        <div class="float-right d-none d-md-block">
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#packageModal" data-action="add"><span class="fas fa-plus mr-2"></span>Add Package</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#packageModal" data-action="add"><span class="fas fa-plus mr-2"></span>Add Package</button>
        </div>
    </div>
    <div class="card-body table-responsive">
    <?php if(count($resellerPackages['results']) == 0){ ?>
        <span class="text-center text-info d-block" data-toggle="modal" data-target="#packageModal" data-action="add">There are no Reseller Packages within this Web Hosting Panel yet... <a class="text-primary" style="cursor:pointer;text-decoration:underline;">Add a package here</a></span>
    <?php }else{ ?>
        <table class="table table-hover table-sm text-center" style="margin:0;">
            <tr>
                <th>Package Name</th>
                <th>Bandwidth</th>
                <th>Disk Usage</th>
                <th>Users</th>
                <th>Domains</th>
                <th>Databases</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($resellerPackages['results'] as $package) { ?>
                <tr>
                    <th><?php echo $package['Name']; ?></th>
                    <td><?php echo $package['MaxBandwidth']; ?>MB</td>
                    <td><?php echo $package['MaxDiskUsage']; ?>MB</td>
                    <td><?php echo $package['MaxUsers']; ?></td>
                    <td><?php echo $package['MaxDomains']; ?></td>
                    <td><?php echo $package['MaxDatabases']; ?></td>
                    <td>
                        <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                        <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
    </div>
</div>





<div class="modal fade" id="packageModal" tabindex="-1" role="dialog" aria-labelledby="packageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="packageModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" autocomplete="off" id="PackageModalForm">
                    <span class="h5 w-100">Package Details</span><br/>
                    <input type="hidden" name="id" id="pIDInput">
                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="pNameInput">Package Name :</label>
                        <div class="col-8 col-lg-10 pr-1 pr-lg-5">
                            <input type="text" name="Name" class="w-100 form-control mb-2 mr-sm-2" id="pNameInput" placeholder="e.g. Basic Reseller" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="pUsersInput">Users:</label>
                        <div class="col-8 col-lg-10 pr-1 pr-lg-5">
                            <input type="number" name="Users" class="w-100 form-control mb-2 mr-sm-2" id="pUsersInput" placeholder="e.g. 5" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="pBandwidthInput">Bandwidth (MB):</label>
                        <div class="col-8 col-lg-4">
                            <input type="number" name="Bandwidth" class="w-100 form-control mb-2 mr-sm-2" id="pBandwidthInput" placeholder="e.g. 1024" required>
                        </div>
						
                        <label class="col-4 col-lg-2 col-form-label" for="pDiskSpaceInput">Disk Space (MB):</label>
                        <div class="col-8 col-lg-4 pr-lg-5">
                            <input type="number" name="DiskSpace" class="w-100 form-control mb-2 mr-sm-2 w-100" id="pDiskSpaceInput" placeholder="e.g. 30" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="pDomainsInput">Domains :</label>
                        <div class="col-8 col-lg-4">
                            <input type="number" maxlength="3" name="Domains" class="w-100 form-control mb-2 mr-sm-2" id="pDomainsInput" placeholder="e.g. 10" required>
                        </div>

                        <label class="col-4 col-lg-2 col-form-label" for="pSubDomainsInput">Sub-Domains :</label>
                        <div class="col-8 col-lg-4 pr-lg-5">
                            <input type="number" maxlength="3" name="SubDomains" class="w-100 form-control mb-2 mr-sm-2" id="pSubDomainsInput" placeholder="e.g. 10" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="pDatabasesInput">Databases :</label>
                        <div class="col-8 col-lg-4">
                            <input type="number" maxlength="3" name="Databases" class="w-100 form-control mb-2 mr-sm-2" id="pDatabasesInput" placeholder="e.g. 30" required>
                        </div>

                        <label class="col-4 col-lg-2 col-form-label" for="pFTPAccountsInput">FTP Accounts :</label>
                        <div class="col-8 col-lg-4 pr-lg-5">
                            <input type="number" maxlength="3" name="FTPAccounts" class="w-100 form-control mb-2 mr-sm-2" id="pFTPAccountsInput" placeholder="e.g. 20" required>
                        </div>
                    </div>
                    

                    <div class="row w-100 m-0 mt-3">
                        <div class="col p-0 text-right">
                            <button type="button" class="btn btn-secondary text-right mx-1" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success text-right mx-1" data-action="">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$ui->footer();
?>
