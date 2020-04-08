<?php


$fname = $_SESSION['FName'];
$lname = $_SESSION['LName'];
$admin = $_SESSION['Admin'];
$reseller = $_SESSION['Reseller'];


?>

<nav class="navbar navbar-default navbar-expand-md navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="/admin">
        <img src="/assets/images/icon-md.gif" width="30" height="30" class="d-inline-block align-top" alt="">
        <span>Web Hosting Panel</span>
    </a>
    <a class="btn p-0 px-2 text-warning d-md-block d-none" href="/admin/"><u>Admin</u></a>
    <a class="btn p-0 px-2 text-warning d-md-block d-none" href="/reseller/">Reseller</a>
    <a class="btn p-0 px-2 text-warning d-md-block d-none" href="/user/">User</a>
    

    <button class="navbar-toggler" type="button">
        <i class="fas fa-bars fa-lg"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown" style="max-height: 70vh;overflow-y: overlay;">
        <ul class="navbar-nav text-center">
            <div class="text-center">
                <a class="btn p-0 px-2 text-warning d-md-none" href="/admin/"><u>Admin</u></a>
                <a class="btn p-0 px-2 text-warning d-md-none" href="/reseller/">Reseller</a>
                <a class="btn p-0 px-2 text-warning d-md-none" href="/user/">User</a>
            </div>
            
            <a class="nav-link d-sm-block d-md-none MenuADashboardBtn" href="/admin">Dashboard</a>
            
            <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#usersm">
                    Users
                </a>
                <div id="usersm" class="dropdown-menu text-center">
                    <a class="dropdown-item MenuAUsersBtn" href="/admin/users">View All</a>
                    <a class="dropdown-item MenuAUsersCronBtn" href="/admin/users/cron">Manage Cron Jobs</a>
                    <a class="dropdown-item MenuAUsersBackupsBtn" href="/admin/users/backups">Manage Backups</a>
                </div>
            </li>

            <a class="nav-link d-sm-block d-md-none MenuAPacksBtn" href="/admin/packs">Packages</a>
            
            <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#backupsm">
                    Backups
                </a>
                <div id="backupsm" class="dropdown-menu text-center">
                    <a class="dropdown-item MenuABackupsBtn" href="/admin/backups">All Backups</a>
                    <a class="dropdown-item MenuABackupsSysBtn" href="/admin/backups/system">System Backups</a>
                    <a class="dropdown-item MenuABackupsSettingsBtn" href="/admin/backups/settings">Default Settings</a>
                </div>
            </li>
            
            <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#systemm">
                    System
                </a>
                <div id="systemm" class="dropdown-menu text-center">
                    <a class="dropdown-item MenuASystemBtn" href="/admin/system">Information</a>
                    <a class="dropdown-item MenuASystemSnPBtn" href="/admin/system/snp">Services/Processes</a>
                    <a class="dropdown-item MenuASystemPHPBtn" href="/admin/system/php">PHP Settings</a>
                    <a class="dropdown-item MenuASystemAdminBtn" href="/admin/system/admin">Admin Settings</a>
                    <a class="dropdown-item MenuASystemLogsBtn" href="/admin/system/logs">View Logs</a>
                    <a class="dropdown-item MenuASystemPanelBtn" href="/admin/system/version">Panel Version</a>
                </div>
            </li>

            <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#accountm">
                    Account
                </a>
                <div id="accountm" class="dropdown-menu text-center">
                    <a class="dropdown-item MenuSettingsBtn" href="/user/settings">Settings</a>
                    <a class="dropdown-item MenuPassBtn" href="/user/pass">Password</a>
                    <a class="dropdown-item MenuMessagesBtn" href="/user/messages">Messages <span
                            class="badge badge-pill badge-primary ml-2">5</span></a>
                </div>
            </li>
            <a class="nav-link d-sm-block d-md-none MenuAHelpBtn" href="/admin/help">Help</a>
            <a class="nav-link d-sm-block d-md-none text-danger font-weight-bolder logoutBtn" href="/admin/logout">Logout</a>

        </ul>
    </div>
    <a class="text-right text-white font-italic d-md-block d-none">Hello, <?php echo "$fname $lname"; ?></a>
</nav>