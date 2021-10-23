<?php 

if(!@include("../../../api/main.php")) die("Error 1 -> Couldn't require Main Class.");

$da = new DA();

$ui = new UI();

$ui->headerAdmin();
?>

<h1 class="h2 m-2">Backup Settings</h1>

<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Who to backup?</h4>
        <div class="float-right d-none d-md-block">
            <button class="btn btn-success mx-1"><span class="fas fa-save mr-2"></span>Save Settings</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-success mx-1"><span class="fas fa-save mr-2"></span>Save Settings</button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-row m-auto">
        <div class="col">
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
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">When to backup?</h4>
        <div class="float-right d-none d-md-block">
            <button class="btn btn-success mx-1"><span class="fas fa-save mr-2"></span>Save Settings</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-success mx-1"><span class="fas fa-save mr-2"></span>Save Settings</button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-row m-auto">
            <div class="col">
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
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">Where to backup?</h4>
        <div class="float-right d-none d-md-block">
            <button class="btn btn-success mx-1"><span class="fas fa-save mr-2"></span>Save Settings</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-success mx-1"><span class="fas fa-save mr-2"></span>Save Settings</button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-row m-auto">
            <div class="col">
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
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
        <h4 class="float-left align-middle mt-1 m-0">What to backup?</h4>
        <div class="float-right d-none d-md-block">
            <button class="btn btn-success mx-1"><span class="fas fa-save mr-2"></span>Save Settings</button>
        </div>
        <div class="float-right d-block d-md-none"><br>
            <button class="btn btn-success mx-1"><span class="fas fa-save mr-2"></span>Save Settings</button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-row m-auto">
            <div class="col">
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
    </div>
</div>

<?php
$ui->footer();
?>
