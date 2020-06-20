<div id="sidebar-container" class="sidebar-expanded d-none d-md-block sidebarc">
    <ul class="list-group">

        <a href="/reseller" class="bg-dark list-group-item list-group-item-action MenuRDashboardBtn">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-tachometer-alt fa-fw mr-3"></span>
                <span class="menu-collapsed">Dashboard</span>
            </div>
        </a>

        <a href="#users" class="bg-dark list-group-item list-group-item-action flex-column align-items-start text-muted" style="cursor:default !important;">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-users-cog fa-fw mr-3"></span>
                <span class="menu-collapsed">Users</span>
                <span class="fas fa-caret-right submenu-icon ml-auto iconRotate" style="transition: 0.6s;"></span>
            </div>
        </a>

        <div id='users' class="collapse sidebar-submenu">
            <a href="/reseller/users" class="list-group-item list-group-item-action bg-dark text-white MenuRUsersBtn text-muted" style="cursor:default !important;">
                <span class="menu-collapsed">View All</span>
            </a>
            <a href="/reseller/users/messages" class="list-group-item list-group-item-action bg-dark text-white MenuRUsersMessagesBtn text-muted" style="cursor:default !important;">
                <span class="menu-collapsed">User Messages</span>
            </a>
            <a href="/reseller/users/backups" class="list-group-item list-group-item-action bg-dark text-white MenuRUsersBackupsBtn text-muted" style="cursor:default !important;">
                <span class="menu-collapsed">Manage Backups</span>
            </a>
        </div>

        <a href="/reseller/packs" class="bg-dark list-group-item list-group-item-action MenuRPacksBtn text-muted" style="cursor:default !important;">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-box-open fa-fw mr-3"></span>
                <span class="menu-collapsed">Packages</span>
            </div>
        </a>

        <a href="#system" class="bg-dark list-group-item list-group-item-action flex-column align-items-start text-muted" style="cursor:default !important;">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fab fa-raspberry-pi fa-fw mr-3"></span>
                <span class="menu-collapsed">System</span>
                <span class="fas fa-caret-right submenu-icon ml-auto iconRotate" style="transition: 0.6s;"></span>
            </div>
        </a>
        <div id='system' class="collapse sidebar-submenu">
            <a href="/reseller/system" class="list-group-item list-group-item-action bg-dark text-white MenuRSystemBtn text-muted" style="cursor:default !important;">
                <span class="menu-collapsed">Information</span>
            </a>
            <a href="/reseller/system/logs" class="list-group-item list-group-item-action bg-dark text-white MenuRSystemLogsBtn text-muted" style="cursor:default !important;">
                <span class="menu-collapsed">View Logs</span>
            </a>
            <a href="/reseller/system/settings" class="list-group-item list-group-item-action bg-dark text-white MenuRSystemSettingsBtn text-muted" style="cursor:default !important;">
                <span class="menu-collapsed">Reseller Settings</span>
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

        <a href="/reseller/help" class="bg-dark list-group-item list-group-item-action MenuRHelpBtn text-muted" style="cursor:default !important;">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-question fa-fw mr-3"></span>
                <span class="menu-collapsed">Help</span>
            </div>
        </a>

        <a href="/reseller/logout" class="bg-dark list-group-item list-group-item-action logoutBtn">
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
    </ul>
</div>