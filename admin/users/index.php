<?php 

if(!@include("../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

$ui = new UI();

$ui->headerAdmin();
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
        <table class="table table-hover table-sm text-center" style="margin:0;">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last name</th>
                <th># of Users</th>
                <th>Disk Usage</th>
                <th>Actions</th>
            </tr>
            <tr>
                <th>1</th>
                <td>Tamir</td>
                <td>Slobodskoy</td>
                <td><div class="show-tooltip" title="3/&infin;">3</div></td>
                <td><div class="show-tooltip" title="2.00KB/3.60GB">2.00KB</div></td>
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
        <h4 class="float-left align-middle mt-1 m-0">Reseller List</h4>
        <div class="float-right d-none d-md-block">
            <small class="text-muted mr-2 mt-2">Showing results 1-10 (11)</small>
            <button class="btn btn-info mx-1" disabled><span class="fas fa-redo-alt mr-2"></span>Refresh</button>
            <button class="btn btn-success mx-1" disabled><span class="fas fa-plus mr-2"></span>Add Reseller</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-info mx-1" disabled><span class="fas fa-redo-alt mr-2"></span>Refresh</button>
            <button class="btn btn-success mx-1" disabled><span class="fas fa-plus mr-2"></span>Add Reseller</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover table-sm text-center" style="margin:0;">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last name</th>
                <th># of Users</th>
                <th>Disk Usage</th>
                <th>Actions</th>
            </tr>
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
            <tr>
                <th>4</th>
                <td>Bill</td>
                <td>Clinton</td>
                <td><div class="show-tooltip" title="0/1">0</div></td>
                <td><div class="show-tooltip" title="0.00MB/5.00MB">0.00MB</div></td>
                <td>
                    <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                    <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                </td>
            </tr>
            <tr>
                <th>5</th>
                <td>James</td>
                <td>Lock</td>
                <td><div class="show-tooltip" title="0/1">0</div></td>
                <td><div class="show-tooltip" title="0.00MB/5.00MB">0.00MB</div></td>
                <td>
                    <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                    <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                </td>
            </tr>
            <tr>
                <th>6</th>
                <td>Elliot</td>
                <td>Shamrock</td>
                <td><div class="show-tooltip" title="0/1">0</div></td>
                <td><div class="show-tooltip" title="0.00MB/5.00MB">0.00MB</div></td>
                <td>
                    <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                    <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                </td>
            </tr>
            <tr>
                <th>7</th>
                <td>Mark</td>
                <td>Teague</td>
                <td><div class="show-tooltip" title="0/1">0</div></td>
                <td><div class="show-tooltip" title="0.00MB/5.00MB">0.00MB</div></td>
                <td>
                    <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                    <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                </td>
            </tr>
            <tr>
                <th>8</th>
                <td>Steve</td>
                <td>Forbes</td>
                <td><div class="show-tooltip" title="0/1">0</div></td>
                <td><div class="show-tooltip" title="0.00MB/5.00MB">0.00MB</div></td>
                <td>
                    <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                    <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                </td>
            </tr>
            <tr>
                <th>9</th>
                <td>Lee</td>
                <td>Smith</td>
                <td><div class="show-tooltip" title="0/1">0</div></td>
                <td><div class="show-tooltip" title="0.00MB/5.00MB">0.00MB</div></td>
                <td>
                    <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                    <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                </td>
            </tr>
            <tr>
                <th>10</th>
                <td>Edward</td>
                <td>Raynold</td>
                <td><div class="show-tooltip" title="0/1">0</div></td>
                <td><div class="show-tooltip" title="0.00MB/5.00MB">0.00MB</div></td>
                <td>
                    <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                    <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                </td>
            </tr>
            <tr>
                <th>11</th>
                <td>Patrick</td>
                <td>Cape</td>
                <td><div class="show-tooltip" title="0/1">0</div></td>
                <td><div class="show-tooltip" title="0.00MB/5.00MB">0.00MB</div></td>
                <td>
                    <button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button>
                    <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                </td>
            </tr>
            <tr>
                <th>12</th>
                <td>Anne</td>
                <td>Hicks</td>
                <td><div class="show-tooltip" title="0/1">0</div></td>
                <td><div class="show-tooltip" title="0.00MB/5.00MB">0.00MB</div></td>
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
                    <input type="hidden" name="id" id="eIDInput">
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
                            <input type="password" hidden />
                            <input type="password" name="Password" class="w-100 form-control mb-2 mr-sm-2" id="aPassInput" placeholder="Password" required>
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

<?php
$ui->footer();
?>
