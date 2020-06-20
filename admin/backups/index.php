<?php 

if(!@include("../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

$ui = new UI();

$ui->headerAdmin();
?>

<h1 class="h2 m-2">Backups</h1>
<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Backups List</h4>
        <div class="float-right d-none d-md-block">
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#backupModal" data-action="new"><span class="fas fa-plus mr-2"></span>New Backup</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-success mx-1" data-toggle="modal" data-target="#backupModal" data-action="new"><span class="fas fa-plus mr-2"></span>New Backup</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover table-sm text-center" style="margin:0;">
            <tr>
                <th>When</th>
                <th>Who</th>
                <th>Where</th>
                <th>What</th>
                <th>Actions</th>
            </tr>
            <tr>
                <th>20/06/2020</th>
                <td>All Users</td>
                <td>/usr/backups</td>
                <td>All Data</td>
                <td>
                    <button class="btn btn-info px-1 py-0 mx-1" disabled>Download</button>
                    <button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="modal fade" id="backupModal" tabindex="-1" role="dialog" aria-labelledby="backupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="backupModalLabel">Create a new Backup</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" autocomplete="off" id="BackupModalForm">
                    <br/>
                    <input type="hidden" name="id" id="eIDInput">

                    <div class="form-row w-100 align-items-center my-3 p-4" style="background-color: #95c8ff; border-radius: 10px;">
                        <div class="col-4">
                            <span class="h5 w-100">Who to backup:</span>
                        </div>
                        <div class="col-8">
                            <div class="custom-control custom-radio d-inline-block my-2">
                                <input type="radio" class="custom-control-input" id="whoToBackupOption1" name="whoToBackupOption" value="1" checked>
                                <label class="custom-control-label" for="whoToBackupOption1">All users</label>
                            </div> <br>
                            <div class="custom-control custom-radio d-inline-block my-2">
                                <input type="radio" class="custom-control-input" id="whoToBackupOption2" name="whoToBackupOption" value="2">
                                <label class="custom-control-label" for="whoToBackupOption2">All Users Except Selected</label>
                            </div> <br>
                            <div class="custom-control custom-radio d-inline-block my-2">
                                <input type="radio" class="custom-control-input" id="whoToBackupOption3" name="whoToBackupOption" value="3">
                                <label class="custom-control-label" for="whoToBackupOption3">Selected Users</label>
                            </div> <br>
                        </div>
                    </div>

                    <div class="form-row w-100 align-items-center my-3 p-4" style="background-color: #c895ff; border-radius: 10px;">
                        <div class="col-4">
                            <span class="h5 w-100">When to backup:</span>
                        </div>
                        <div class="col-8">
                            <div class="custom-control custom-radio d-inline-block my-2">
                                <input type="radio" class="custom-control-input" id="whenToBackupOption1" name="whenToBackupOption" value="1" checked>
                                <label class="custom-control-label" for="whenToBackupOption1">Now</label>
                            </div> <br>
                            <div class="custom-control custom-radio d-inline-block my-2">
                                <input type="radio" class="custom-control-input" id="whenToBackupOption2" name="whenToBackupOption" value="2">
                                <label class="custom-control-label" for="whenToBackupOption2">Cron Schedule</label>
                            </div> <br>
                        </div>
                    </div>

                    <div class="form-row w-100 align-items-center my-3 p-4" style="background-color: #c8ff95; border-radius: 10px;">
                        <div class="col-4">
                            <span class="h5 w-100">Where to save:</span>
                        </div>
                        <div class="col-8">
                            <div class="custom-control custom-radio d-inline-block my-2">
                                <input type="radio" class="custom-control-input" id="whereToSaveOption1" name="whereToSaveOption" value="1" checked>
                                <label class="custom-control-label" for="whereToSaveOption1">Local</label>
                            </div> <br>
                            <label class="col-form-label d-inline-block" for="bLocalPathInput">Local Path: </label>
                            <input type="text" name="LocalPath" class="form-control mb-2 mr-sm-2" id="bLocalPathInput" placeholder="e.g. /usr/backups" required>
                            <br>
                            <div class="custom-control custom-radio d-inline-block my-2">
                                <input type="radio" class="custom-control-input" id="whereToSaveOption2" name="whereToSaveOption" value="2">
                                <label class="custom-control-label" for="whereToSaveOption2">FTP</label>
                            </div> <br>
                            <div class="custom-control custom-checkbox d-inline-block">
                                <input type="checkbox" class="custom-control-input" id="whereToSaveEncryption" name="whereToSaveEncryption">
                                <label class="custom-control-label" for="whereToSaveEncryption">Encrypted Backup</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row w-100 align-items-center my-3 p-4" style="background-color: #ffc895; border-radius: 10px;">
                        <div class="col-4">
                            <span class="h5 w-100">What to backup:</span>
                        </div>
                        <div class="col-8">
                            <div class="custom-control custom-radio d-inline-block my-2">
                                <input type="radio" class="custom-control-input" id="whatToBackupOption1" name="whatToBackupOption" value="1" checked>
                                <label class="custom-control-label" for="whatToBackupOption1">All Data</label>
                            </div> <br>
                            <div class="custom-control custom-radio d-inline-block my-2">
                                <input type="radio" class="custom-control-input" id="whatToBackupOption2" name="whatToBackupOption" value="2">
                                <label class="custom-control-label" for="whatToBackupOption2">Selected Data</label>
                            </div> <br>
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
