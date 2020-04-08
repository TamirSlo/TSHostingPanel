<?php


$fname = $_SESSION['FName'];
$lname = $_SESSION['LName'];
$admin = $_SESSION['Admin'];
$reseller = $_SESSION['Reseller'];


?>

<nav class="navbar navbar-default navbar-expand-md navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="/user">
        <img src="/assets/images/icon-md.gif" width="30" height="30" class="d-inline-block align-top" alt="">
        <span>Web Hosting Panel</span>
    </a>

    <?php if($admin){ ?>
    <a class="btn p-0 px-2 text-warning d-md-block d-none" href="/admin/">Admin</a>
    <a class="btn p-0 px-2 text-warning d-md-block d-none" href="/reseller/">Reseller</a>
    <a class="btn p-0 px-2 text-warning d-md-block d-none" href="/user/"><u>User</u></a>
    <?php } ?>

    <?php if($reseller){ ?>
    <a class="btn p-0 px-2 text-warning d-md-block d-none" href="/reseller/">Reseller</a>
    <a class="btn p-0 px-2 text-warning d-md-block d-none" href="/user/"><u>User</u></a>
    <?php } ?>

    <button class="navbar-toggler" type="button">
        <i class="fas fa-bars fa-lg"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav text-center">
            <?php if($admin){ ?><div class="text-center">
            <a class="btn p-0 px-2 text-warning d-md-none" href="/admin/">Admin</a>
            <a class="btn p-0 px-2 text-warning d-md-none" href="/reseller/">Reseller</a>
            <a class="btn p-0 px-2 text-warning d-md-none" href="/user/"><u>User</u></a>
            </div><?php } ?>

            <?php if($reseller){ ?><div class="text-center">
            <a class="btn p-0 px-2 text-warning d-md-none" href="/admin/">Admin</a>
            <a class="btn p-0 px-2 text-warning d-md-none" href="/reseller/">Reseller</a>
            <a class="btn p-0 px-2 text-warning d-md-none" href="/user/"><u>User</u></a>
            </div><?php } ?>
            <a class="nav-link d-sm-block d-md-none MenuDashboardBtn" href="/user">Dashboard</a>
            <a class="nav-link d-sm-block d-md-none MenuDomainsBtn" href="/user/domains">Domains</a>
            <a class="nav-link d-sm-block d-md-none MenuFTPsBtn" href="/user/ftps">FTP Accounts</a>
            <a class="nav-link d-sm-block d-md-none MenuDBsBtn" href="/user/dbs">Databases</a>

            <!-- This menu is hidden in bigger devices with d-sm-none. 
    The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
            <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#accountm">
                    Account
                </a>
                <div id="accountm" class="dropdown-menu text-center">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Password</a>
                    <a class="dropdown-item" href="#">Messages <span
                            class="badge badge-pill badge-primary ml-2">5</span></a>
                </div>
            </li><!-- Smaller devices menu END -->
            <a class="nav-link d-sm-block d-md-none" href="/user">Help</a>
            <a class="nav-link d-sm-block d-md-none text-danger font-weight-bolder logoutBtn" href="/user/logout">Logout</a>

        </ul>
    </div>
    <a class="text-right text-white font-italic d-md-block d-none">Hello, <?php echo "$fname $lname"; ?></a>
</nav>