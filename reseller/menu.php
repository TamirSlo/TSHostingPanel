<?php


$fname = $_SESSION['FName'];
$lname = $_SESSION['LName'];
$admin = $_SESSION['Admin'];
$reseller = $_SESSION['Reseller'];


?>

<nav class="navbar navbar-default navbar-expand-md navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="/reseller">
        <img src="/assets/images/icon-md.gif" width="30" height="30" class="d-inline-block align-top" alt="">
        <span>Web Hosting Panel</span>
    </a>

    <?php if($admin){ ?>
    <a class="btn p-0 px-2 text-warning d-md-block d-none" href="/admin/">Admin</a>
    <?php } ?>
    <a class="btn p-0 px-2 text-warning d-md-block d-none" href="/reseller/"><u>Reseller</u></a>
    <a class="btn p-0 px-2 text-warning d-md-block d-none" href="/user/">User</a>
    

    <button class="navbar-toggler" type="button">
        <i class="fas fa-bars fa-lg"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown" style="max-height: 70vh;overflow-y: overlay;">
        <ul class="navbar-nav text-center">
            <div class="text-center">
                <?php if($admin){ ?>
                <a class="btn p-0 px-2 text-warning d-md-none" href="/admin/">Admin</a>
                <?php } ?>
                <a class="btn p-0 px-2 text-warning d-md-none" href="/reseller/"><u>Reseller</u></a>
                <a class="btn p-0 px-2 text-warning d-md-none" href="/user/">User</a>
            </div>
            
            <a class="nav-link d-sm-block d-md-none MenuRDashboardBtn" href="/reseller">Dashboard</a>

            <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#usersm">
                    Users
                </a>
                <div id="usersm" class="dropdown-menu text-center">
                    <a class="dropdown-item MenuRUsersBtn" href="/reseller">View All</a>
                    <a class="dropdown-item MenuRUsersMessagesBtn" href="/reseller/messages">User Messages</a>
                    <a class="dropdown-item MenuRUsersBackupsBtn" href="/reseller/backups">Manage Backups</a>
                </div>
            </li>

            <a class="nav-link d-sm-block d-md-none MenuRPacksBtn" href="/reseller/packs">Packages</a>

            

            <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#systemm">
                    System
                </a>
                <div id="systemm" class="dropdown-menu text-center">
                    <a class="dropdown-item MenuRSystemBtn" href="/reseller/system">Information</a>
                    <a class="dropdown-item MenuRSystemLogsBtn" href="/reseller/system/logs">View Logs</a>
                    <a class="dropdown-item MenuRSystemSettingsBtn" href="/reseller/system/settings">Reseller Settings</a>
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
            <a class="nav-link d-sm-block d-md-none MenuRHelpBtn" href="/reseller/help">Help</a>
            <a class="nav-link d-sm-block d-md-none text-danger font-weight-bolder logoutBtn" href="/reseller/logout">Logout</a>

        </ul>
    </div>
    <a class="text-right text-white font-italic d-md-block d-none">Hello, <?php echo "$fname $lname"; ?></a>
</nav>