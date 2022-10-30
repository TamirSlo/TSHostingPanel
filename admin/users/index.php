<?php
namespace API;

use API\Models\UserType;

if(!@include("../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$tshp = TSHP::getInstance();

$ui = new UI();
$ui->headerAdmin();

$allUsers = $tshp->users->selectAll();
$adminList = $allUsers->filterByType(UserType::Admin());
$resellerList = $allUsers->filterByType(UserType::Reseller());
$userList = $allUsers->filterByType(UserType::User());

$resellerPackages = $tshp->resellerPackages->selectAll();
$userPackages = []; //TODO: implement user packages
?>

<h1 class="h2 m-2">Users</h1>
<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Admin List</h4>
        <div class="float-right d-none d-md-block">
            <small class="text-muted mr-2 mt-2">Showing <?php echo count($adminList); ?> admins</small>
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#adminModal" data-action="add"><span class="fas fa-plus mr-2"></span>Add Admin</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
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
                foreach ($adminList as $admin) {
                    ?>
                    <tr id="admin<?php echo $admin->UserID; ?>">
                        <th><?php echo $admin->UserID; ?></th>
                        <td><?php echo $admin->FName; ?></td>
                        <td><?php echo $admin->LName; ?></td>
                        <td><div class="show-tooltip" title="<?php echo $admin->UserCount; ?>/&infin;"><?php echo $admin->UserCount; ?></div></td>
                        <td><div class="show-tooltip" title="0.00MB/3.60GB">0.00MB</div></td>
                        <td>
                            <button class="btn btn-info px-1 py-0 mx-1" data-toggle="modal" data-target="#adminModal" data-action="edit" data-id="<?php echo $admin->UserID; ?>">Edit</button>
                            <button class="btn btn-danger px-1 py-0 mx-1 deleteAdmin" data-id="<?php echo $admin->UserID; ?>" <?php if($tshp->user->UserID == $admin->UserID) echo "disabled"; ?>>Delete</button>
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
            <small class="text-muted mr-2 mt-2">Showing <?php echo count($resellerList); ?> resellers</small>
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#resellerModal" data-action="add"><span class="fas fa-plus mr-2"></span>Add Reseller</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#resellerModal" data-action="add"><span class="fas fa-plus mr-2"></span>Add Reseller</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <?php if(count($resellerList) > 0) { ?>
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
                    foreach ($resellerList as $reseller) {
                        ?>
                        <tr id="reseller<?php echo $reseller->UserID; ?>">
                            <th><?php echo $reseller->UserID; ?></th>
                            <td><?php echo $reseller->FName; ?></td>
                            <td><?php echo $reseller->LName; ?></td>
                            <td><div class="show-tooltip <?php if($reseller->ResellerPackage->MaxUsers != 0 && $reseller->ResellerPackage->MaxUsers == $reseller->UserCount) echo 'tooltipRed' ; ?>" title="<?php echo $reseller->UserCount . '/' . ($reseller->ResellerPackage->MaxUsers == 0 ? '&infin;' : $reseller->ResellerPackage->MaxUsers); ?>"><?php echo $reseller->UserCount; ?></div></td>
                            <td><div class="show-tooltip <?php if($reseller->ResellerPackage->MaxDiskUsage != 0 && $reseller->ResellerPackage->MaxDiskUsage == -1/** TODO: get actual disk usage for user */) echo 'tooltipRed' ; ?>" title="<?php echo '-1MB'/**TODO Same as before in line <-- */ . '/' . ($reseller->ResellerPackage->MaxDiskUsage == 0 ? '&infin;' : '-1' /**TODO Same as before in line <-- */) . 'MB' ; ?>">-1MB<?php /**TODO Same as before in line <-- */ ?></div></td>
                            <td>
                                <button class="btn btn-info px-1 py-0 mx-1" data-toggle="modal" data-target="#resellerModal" data-action="edit" data-id="<?php echo $reseller->UserID; ?>">Edit</button>
                                <button class="btn btn-danger px-1 py-0 mx-1 deleteReseller" data-id="<?php echo $reseller->UserID; ?>">Delete</button>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        <?php } else { ?>
            <span class="text-center text-info d-block">There are no resellers within this Web Hosting Panel yet... <a class="text-primary" style="cursor:pointer;text-decoration:underline;"  data-toggle="modal" data-target="#resellerModal" data-action="add">Add a reseller here</a></span>
        <?php } ?>
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">User List</h4>
        <div class="float-right d-none d-md-block">
        <small class="text-muted mr-2 mt-2">Showing <?php echo count($userList); ?> users</small>
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#userModal" data-action="add"><span class="fas fa-plus mr-2"></span>Add User</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#userModal" data-action="add"><span class="fas fa-plus mr-2"></span>Add User</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <?php if(count($userList) > 0){ ?>
            <table id="userTable" class="table table-hover table-sm text-center" style="margin:0;">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last name</th>
                    <th># of domains</th>
                    <th>Disk Usage</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($userList as $user) { ?>
                    <tr>
                        <th><?php echo $user->UserID; ?></th>
                        <td><?php echo $user->FName; ?></td>
                        <td><?php echo $user->LName; ?></td>
                        <td><!--TODO: Add domains info -->-1</td>
                        <td><!--TODO: Add disk usage info -->-1</td>
                        <td>
                            <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                            <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <span class="text-center text-info d-block">There are no users within this Web Hosting Panel yet... <a class="text-primary" style="cursor:pointer;text-decoration:underline;" disabled>Add a user here</a></span>
        <?php } ?>
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
                    <input type="hidden" name="UserID" id="aIDInput">
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
                            <input type="text" name="Username" class="w-100 form-control mb-2 mr-sm-2" id="aUserInput" placeholder="Username" required autocomplete="new-username">
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
                    <input type="hidden" name="UserID" id="rIDInput">
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
                            <input type="text" name="Username" class="w-100 form-control mb-2 mr-sm-2" id="rUserInput" placeholder="Username" required autocomplete="new-username">
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
                                <?php foreach ($resellerPackages as $package) { ?>
                                    <option value="<?php echo $package->ResellerPackageID; ?>"><?php echo $package->Name; ?></option>
                                <?php } ?>
                                <?php if(count($resellerPackages) == 0){ ?>
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

<!-- User modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" autocomplete="off" id="UserModalForm">
                    <span class="h5 w-100">User Details</span><br/>
                    <input type="hidden" name="id" id="uIDInput">
                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="uFNameInput">First Name :</label>
                        <div class="col-8 col-lg-4">
                            <input type="text" name="FName" class="w-100 form-control mb-2 mr-sm-2" id="uFNameInput" placeholder="First Name" required>
                        </div>

                        <label class="col-4 col-lg-2 col-form-label" for="uLNameInput">Last Name :</label>
                        <div class="col-8 col-lg-4 pr-lg-5">
                            <input type="text" name="LName" class="w-100 form-control mb-2 mr-sm-2" id="uLNameInput" placeholder="Last Name" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="uEmailInput">Email :</label>
                        <div class="col-8 col-lg-10 pr-1 pr-lg-5">
                            <input type="email" name="Email" class="w-100 form-control mb-2 mr-sm-2 w-100" id="uEmailInput" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="uUserInput">Username :</label>
                        <div class="col-8 col-lg-4">
                            <input type="text" hidden autocomplete="username"/>
                            <input type="text" name="Username" class="w-100 form-control mb-2 mr-sm-2" id="uUserInput" placeholder="Username" required autocomplete="new-username">
                        </div>

                        <label class="col-4 col-lg-2 col-form-label" for="uPassInput">Password :</label>
                        <div class="col-8 col-lg-4 pr-lg-5">
                            <input type="password" style="display:none;" autocomplete="new-password" />
                            <input type="password" name="Password" autocomplete="new-password" class="w-100 form-control mb-2 mr-sm-2" id="uPassInput" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="uPackageInput">Package :</label>
                        <div class="col-8 col-lg-10 pr-1 pr-lg-5">
                            <select name="Package" class="w-100 form-control mb-2 mr-sm-2 w-100" id="uPackageInput" value="0" required>
                                <option value="0" disabled selected>Select a package from the list</option>
                                <?php foreach ($userPackages as $package) { ?>
                                    <option value="<?php echo $package->UserPackageID; ?>"><?php echo $package->Name; ?></option>
                                <?php } ?>
                                <?php if(count($userPackages) == 0){ ?>
                                    <option value="0" disabled>There are no user packages. Please add one first.</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row w-100">
                        <label class="col-4 col-lg-2 col-form-label" for="uResellerInput">Reseller :</label>
                        <div class="col-8 col-lg-10 pr-1 pr-lg-5">
                            <select name="Reseller" class="w-100 form-control mb-2 mr-sm-2 w-100" id="uResellerInput" value="0" required>
                                <option value="0" disabled>Select a reseller from the list</option>
                                <optgroup label="Admins">
                                    <?php foreach ($adminList as $admin) { ?>
                                        <option value="<?php echo $admin->UserID; ?>" <?php if($reseller->UserID == $tshp->user->UserID) echo "selected"; ?>><?php echo $admin->fullName(); ?></option>
                                    <?php } ?>
                                </optgroup>
                                <optgroup label="Resellers">
                                    <?php foreach ($resellerList as $reseller) { ?>
                                        <option value="<?php echo $reseller->UserID; ?> <?php if($reseller->UserID == $tshp->user->UserID) echo "selected"; ?>"><?php echo $reseller->fullName(); ?></option>
                                    <?php } ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="row w-100 m-0 mt-3">
                        <div class="col p-0 text-right">
                            <div class="custom-control custom-switch mx-1 pl-5" style="border: 2px solid #ff2277;border-radius: 6px;background: #ffff2222;display: inline-block;">
                                <input type="checkbox" class="custom-control-input" id="uWelcomeInput" checked>
                                <label class="custom-control-label orange center pt-1 pb-2 pr-2" for="uWelcomeInput">Send Welcome Message</label>
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
