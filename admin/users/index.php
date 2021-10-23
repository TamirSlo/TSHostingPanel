<?php 

if(!@include("../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

$ui = new UI();

$ui->headerAdmin();

$adminList = $da->getAdmins();
$resellerList = $da->getResellers();
$resellerPackages = $da->getResellerPackages();
?>

<h1 class="h2 m-2">Users</h1>
<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Admin List</h4>
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
                <th>First Name</th>
                <th>Last name</th>
                <th># of Users</th>
                <th>Disk Usage</th>
                <th>Actions</th>
            </tr>
            <?php
                foreach ($adminList['results'] as $admin) {
                    ?>
                    <tr>
                        <th><?php echo $admin['UserID']; ?></th>
                        <td><?php echo $admin['FName']; ?></td>
                        <td><?php echo $admin['LName']; ?></td>
                        <td><div class="show-tooltip" title="<?php echo $admin['UserCount']; ?>/&infin;"><?php echo $admin['UserCount']; ?></div></td>
                        <td><div class="show-tooltip" title="0.00MB/3.60GB">0.00MB</div></td>
                        <td>
                            <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                            <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Reseller List</h4>
        <div class="float-right d-none d-md-block">
            <small class="text-muted mr-2 mt-2">Showing results 1-10 (11)</small>
            <button class="btn btn-info mx-1" disabled><span class="fas fa-redo-alt mr-2"></span>Refresh</button>
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#resellerModal" data-action="add"><span class="fas fa-plus mr-2"></span>Add Reseller</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-info mx-1" disabled><span class="fas fa-redo-alt mr-2"></span>Refresh</button>
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#resellerModal" data-action="add"><span class="fas fa-plus mr-2"></span>Add Reseller</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table id="resellerTable" class="table table-hover table-sm text-center" style="margin:0;">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last name</th>
                <th># of Users</th>
                <th>Disk Usage</th>
                <th>Actions</th>
            </tr>
            <?php
                foreach ($resellerList['results'] as $reseller) {
                    ?>
                    <tr>
                        <th><?php echo $reseller['UserID']; ?></th>
                        <td><?php echo $reseller['FName']; ?></td>
                        <td><?php echo $reseller['LName']; ?></td>
                        <td><div class="show-tooltip" title="<?php echo $reseller['UserCount']; ?>/&infin;"><?php echo $reseller['UserCount']; ?></div></td>
                        <td><div class="show-tooltip" title="0.00MB/3.60GB">0.00MB</div></td>
                        <td>
                            <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                            <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                        </td>
                    </tr>
                    <?php
                }
            ?>
            <tr>
                <th>2</th>
                <td>Tim</td>
                <td>Blackwater</td>
                <td><div class="show-tooltip tooltipRed" title="2/2">2</div></td>
                <td><div class="show-tooltip" title="7.01MB/50.0MB">7.01MB</div></td>
                <td>
                    <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                    <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                </td>
            </tr>
            <tr>
                <th>3</th>
                <td>Daniel</td>
                <td>Tzafrir</td>
                <td><div class="show-tooltip" title="4/15">4</div></td>
                <td><div class="show-tooltip" title="2.57MB/100.00MB">2.57MB</div></td>
                <td>
                    <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                    <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">User List</h4>
        <div class="float-right d-none d-md-block">
            <button class="btn btn-info mx-1" disabled><span class="fas fa-redo-alt mr-2"></span>Refresh</button>
            <button class="btn btn-success mx-1" disabled><span class="fas fa-plus mr-2"></span>Add User</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-info mx-1" disabled><span class="fas fa-redo-alt mr-2"></span>Refresh</button>
            <button class="btn btn-success mx-1" disabled><span class="fas fa-plus mr-2"></span>Add User</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <span class="text-center text-info d-block">There are no users within this Web Hosting Panel yet... <a class="text-primary" style="cursor:pointer;text-decoration:underline;">Add a user here</a></span>
    </div>
</div>

<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" autocomplete="off" id="AdminModalForm">
                    <span class="h5 w-100">User Details</span><br/>
                    <input type="hidden" name="id" id="aIDInput">
                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="aFNameInput">First Name :</label>
                        <div class="col-8 col-lg-4">
                            <input type="text" name="FName" class="w-100 form-control mb-2 mr-sm-2" id="aFNameInput" placeholder="First Name" required>
                        </div>

                        <label class="col-4 col-lg-2 col-form-label" for="aLNameInput">Last Name :</label>
                        <div class="col-8 col-lg-4 pr-lg-5">
                            <input type="text" name="LName" class="w-100 form-control mb-2 mr-sm-2" id="aLNameInput" placeholder="Last Name" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="aEmailInput">Email :</label>
                        <div class="col-8 col-lg-10 pr-1 pr-lg-5">
                            <input type="email" name="Email" class="w-100 form-control mb-2 mr-sm-2 w-100" id="aEmailInput" placeholder="username@gmail.com" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="aUserInput">Username :</label>
                        <div class="col-8 col-lg-4">
                            <input type="text" hidden autocomplete="username"/>
                            <input type="text" name="Username" class="w-100 form-control mb-2 mr-sm-2" id="aUserInput" placeholder="Username" required>
                        </div>

                        <label class="col-4 col-lg-2 col-form-label" for="aPassInput">Password :</label>
                        <div class="col-8 col-lg-4 pr-lg-5">
                            <input type="password" style="display: none;" autocomplete="admin-password" />
                            <input type="password" name="Password" autocomplete="admin-password" class="w-100 form-control mb-2 mr-sm-2" id="aPassInput" placeholder="Password" required>
                        </div>
                    </div>
                    

                    <div class="row w-100 m-0 mt-3">
                        <div class="col p-0 text-right">
                            <div class="custom-control custom-switch mx-1 pl-5" style="border: 2px solid #ff2277;border-radius: 6px;background: #ffff2222;display: inline-block;">
                                <input type="checkbox" class="custom-control-input" id="aWelcomeInput" checked>
                                <label class="custom-control-label orange center pt-1 pb-2 pr-2" for="aWelcomeInput">Send Welcome Message</label>
                            </div>
                            <button type="button" class="btn btn-secondary text-right mx-1" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success text-right mx-1" data-action="">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resellerModal" tabindex="-1" role="dialog" aria-labelledby="resellerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resellerModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" autocomplete="off" id="ResellerModalForm">
                    <span class="h5 w-100">User Details</span><br/>
                    <input type="hidden" name="id" id="rIDInput">
                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="rFNameInput">First Name :</label>
                        <div class="col-8 col-lg-4">
                            <input type="text" name="FName" class="w-100 form-control mb-2 mr-sm-2" id="rFNameInput" placeholder="First Name" required>
                        </div>

                        <label class="col-4 col-lg-2 col-form-label" for="rLNameInput">Last Name :</label>
                        <div class="col-8 col-lg-4 pr-lg-5">
                            <input type="text" name="LName" class="w-100 form-control mb-2 mr-sm-2" id="rLNameInput" placeholder="Last Name" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="rEmailInput">Email :</label>
                        <div class="col-8 col-lg-10 pr-1 pr-lg-5">
                            <input type="email" name="Email" class="w-100 form-control mb-2 mr-sm-2 w-100" id="rEmailInput" placeholder="username@gmail.com" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="rUserInput">Username :</label>
                        <div class="col-8 col-lg-4">
                            <input type="text" hidden autocomplete="username"/>
                            <input type="text" name="Username" class="w-100 form-control mb-2 mr-sm-2" id="rUserInput" placeholder="Username" required>
                        </div>

                        <label class="col-4 col-lg-2 col-form-label" for="rPassInput">Password :</label>
                        <div class="col-8 col-lg-4 pr-lg-5">
                            <input type="password" style="display:none;" autocomplete="reseller-password" />
                            <input type="password" name="Password" autocomplete="reseller-password" class="w-100 form-control mb-2 mr-sm-2" id="rPassInput" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="rPackageInput">Package :</label>
                        <div class="col-8 col-lg-10 pr-1 pr-lg-5">
                            <select name="Package" class="w-100 form-control mb-2 mr-sm-2 w-100" id="rPackageInput" value="0" required>
                                <option value="0" disabled selected>Select a package from the list</option>
                                <?php foreach ($resellerPackages['results'] as $package) { ?>
                                    <option value="<?php echo $package['ResellerPackageID']; ?>"><?php echo $package['Name']; ?></option>
                                <?php } ?>
                                <?php if(count($resellerPackages['results']) == 0){ ?>
                                    <option value="0" disabled>There are no reseller packages. Please add one first.</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    

                    <div class="row w-100 m-0 mt-3">
                        <div class="col p-0 text-right">
                            <div class="custom-control custom-switch mx-1 pl-5" style="border: 2px solid #ff2277;border-radius: 6px;background: #ffff2222;display: inline-block;">
                                <input type="checkbox" class="custom-control-input" id="rWelcomeInput" checked>
                                <label class="custom-control-label orange center pt-1 pb-2 pr-2" for="rWelcomeInput">Send Welcome Message</label>
                            </div>
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
