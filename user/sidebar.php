<div id="sidebar-container" class="sidebar-expanded d-none d-md-block sidebarc">
    <ul class="list-group">

        <a href="/user" class="bg-dark list-group-item list-group-item-action MenuDashboardBtn">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-tachometer-alt fa-fw mr-3"></span>
                <span class="menu-collapsed">Dashboard</span>
            </div>
        </a>

        <a href="/user/domains" class="bg-dark list-group-item list-group-item-action MenuDomainsBtn">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-link fa-fw mr-3"></span>
                <span class="menu-collapsed">Domains</span>
            </div>
        </a>

        <a href="/user/ftps" class="bg-dark list-group-item list-group-item-action MenuFTPsBtn text-muted" style="cursor:default !important;">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-folder-open fa-fw mr-3"></span>
                <span class="menu-collapsed">FTP Accounts</span>
            </div>
        </a>

        <a href="/user/dbs" class="bg-dark list-group-item list-group-item-action MenuDBsBtn text-muted" style="cursor:default !important;">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-database fa-fw mr-3"></span>
                <span class="menu-collapsed">Databases</span>
            </div>
        </a>

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

        <a href="/user/help" class="bg-dark list-group-item list-group-item-action MenuHelpBtn text-muted" style="cursor:default !important;">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-question fa-fw mr-3"></span>
                <span class="menu-collapsed">Help</span>
            </div>
        </a>

        <a href="/user/logout" class="bg-dark list-group-item list-group-item-action logoutBtn">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fas fa-sign-out-alt fa-fw mr-3"></span>
                <span class="menu-collapsed">Logout</span>
            </div>
        </a>

        <a href="/user/collapse" data-toggle="sidebar-colapse"
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