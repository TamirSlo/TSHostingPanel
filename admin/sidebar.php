<div id="sidebar-container" class="sidebar-expanded d-none d-md-block sidebarc">
    <ul class="list-group">

        <a href="/admin" class="bg-dark list-group-item list-group-item-action MenuADashboardBtn">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-tachometer-alt fa-fw mr-3"></span>
                <span class="menu-collapsed">Dashboard</span>
            </div>
        </a>

        <a href="#users" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-users-cog fa-fw mr-3"></span>
                <span class="menu-collapsed">Users</span>
                <span class="fas fa-caret-right submenu-icon ml-auto iconRotate" style="transition: 0.6s;"></span>
            </div>
        </a>

        <div id='users' class="collapse sidebar-submenu">
            <a href="/admin/users" class="list-group-item list-group-item-action bg-dark text-white MenuAUsersBtn">
                <span class="menu-collapsed">View All</span>
            </a>
            <a href="/admin/users/cron" class="list-group-item list-group-item-action bg-dark text-white MenuAUsersCronBtn text-muted">
                <span class="menu-collapsed">Manage Cron Jobs</span>
            </a>
            <a href="/admin/users/backups" class="list-group-item list-group-item-action bg-dark text-white MenuAUsersBackupsBtn text-muted">
                <span class="menu-collapsed">Manage Backups</span>
            </a>
        </div>

        <a href="/admin/packages" class="bg-dark list-group-item list-group-item-action text-white MenuAPacksBtn">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-box-open fa-fw mr-3"></span>
                <span class="menu-collapsed">Packages</span>
            </div>
        </a>

        <a href="#backups" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-download fa-fw mr-3"></span>
                <span class="menu-collapsed">Backups</span>
                <span class="fas fa-caret-right submenu-icon ml-auto iconRotate" style="transition: 0.6s;"></span>
            </div>
        </a>

        <div id='backups' class="collapse sidebar-submenu">
            <a href="/admin/backups" class="list-group-item list-group-item-action bg-dark text-white MenuABackupsBtn">
                <span class="menu-collapsed">All Backups</span>
            </a>
            <a href="/admin/backups/system" class="list-group-item list-group-item-action bg-dark text-white MenuABackupsSysBtn">
                <span class="menu-collapsed">System Backups</span>
            </a>
            <a href="/admin/backups/settings" class="list-group-item list-group-item-action bg-dark text-white MenuABackupsSettingsBtn">
                <span class="menu-collapsed">Default Settings</span>
            </a>
        </div>

        <a href="#system" class="bg-dark list-group-item list-group-item-action flex-column align-items-start text-muted">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fab fa-raspberry-pi fa-fw mr-3"></span>
                <span class="menu-collapsed">System</span>
                <span class="fas fa-caret-right submenu-icon ml-auto iconRotate" style="transition: 0.6s;"></span>
            </div>
        </a>

        <div id='system' class="collapse sidebar-submenu">
            <a href="/admin/system" class="list-group-item list-group-item-action bg-dark text-white MenuASystemBtn text-muted">
                <span class="menu-collapsed">Information</span>
            </a>
            <a href="/admin/system/snp" class="list-group-item list-group-item-action bg-dark text-white MenuASystemSnPBtn text-muted">
                <span class="menu-collapsed">Services/Processes</span>
            </a>
            <a href="/admin/system/php" class="list-group-item list-group-item-action bg-dark text-white MenuASystemPHPBtn text-muted">
                <span class="menu-collapsed">PHP Settings</span>
            </a>
            <a href="/admin/system/admin" class="list-group-item list-group-item-action bg-dark text-white MenuASystemAdminBtn text-muted">
                <span class="menu-collapsed">Admin Settings</span>
            </a>
            <a href="/admin/system/logs" class="list-group-item list-group-item-action bg-dark text-white MenuASystemLogsBtn text-muted">
                <span class="menu-collapsed">View Logs</span>
            </a>
            <a href="/admin/system/version" class="list-group-item list-group-item-action bg-dark text-white MenuASystemPanelBtn text-muted">
                <span class="menu-collapsed">Panel Version</span>
            </a>
        </div>

        <li class="list-group-item sidebar-separator"></li>
        
        <a href="#account" class="bg-dark list-group-item list-group-item-action flex-column align-items-start text-muted" style="cursor:default !important;">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-user fa-fw mr-3"></span>
                <span class="menu-collapsed">Account</span>
                <span class="fas fa-caret-right submenu-icon ml-auto iconRotate" style="transition: 0.6s;"></span>
            </div>
        </a>

        <div id='account' class="collapse sidebar-submenu">
            <a href="/user/settings" class="list-group-item list-group-item-action bg-dark text-white MenuSettingsBtn text-muted" style="cursor:default !important;">
                <span class="menu-collapsed">Settings</span>
            </a>
            <a href="/user/pass" class="list-group-item list-group-item-action bg-dark text-white MenuPassBtn text-muted" style="cursor:default !important;">
                <span class="menu-collapsed">Password</span>
            </a>
            <a href="/user/messages" class="list-group-item list-group-item-action bg-dark text-white MenuMessagesBtn text-muted" style="cursor:default !important;">
                <span class="menu-collapsed">Messages <span class="badge badge-pill badge-primary badge-secondary ml-2">5</span></span>
            </a>
        </div>

        <a href="/admin/help" class="bg-dark list-group-item list-group-item-action MenuAHelpBtn text-muted" style="cursor:default !important;">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-question fa-fw mr-3"></span>
                <span class="menu-collapsed">Help</span>
            </div>
        </a>

        <a href="/admin/logout" class="bg-dark list-group-item list-group-item-action logoutBtn">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-sign-out-alt fa-fw mr-3"></span>
                <span class="menu-collapsed">Logout</span>
            </div>
        </a>

        <a href="/reseller/collapse" data-toggle="sidebar-colapse"
            class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span id="collapse-icon" class="fas ml-1 mr-3"></span>
                <span id="collapse-text" class="menu-collapsed">Collapse</span>
            </div>
        </a>
        
        <!-- Logo -->
        <li class="list-group-item logo-separator">
            <?php $this->copyright(); ?>
            <img src='/assets/images/icon-md.gif' width="30" height="30" style="margin:auto;display: block;"/>
        </li>
    </ul><!-- List Group END-->
</div>