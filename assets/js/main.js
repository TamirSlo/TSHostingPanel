$(document).ready(function() {
    $('#main').removeClass('fadeout');
    if (getCookie("error")) {
        var refferalURI = getCookie("eRefferal");
        var refferalURI_Check = document.cookie.indexOf("eRefferal");
        var temp_id = generateErrorToast();
        $('#errortoast' + temp_id).toast('show');
        $('#errortoast' + temp_id + ' .toast-body').html(getCookie("error"));
        document.cookie = 'error=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        document.cookie = 'eRefferal=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    } else {
        var refferalURI = "";
        var refferalURI_Check = document.cookie.indexOf("eRefferal");
    }

    // ================================================================L O G I N   P A G E ===================
    $("#LoginForm").submit(function(e) {
        e.preventDefault();
        // Activate Loading State
        $("button", this).prop("disabled", true);
        $("button", this).html(
            `<span class="spinner-border spinner-border-sm mb-1" 
            role="status" aria-hidden="true"></span> Checking details...`
        );

        // Perform API request
        $.post("/api/login/", $(this).serialize())
            .done(function(data) {
                var results = JSON.parse(data);
                if (!results.success) {
                    var temp_id = generateErrorToast();
                    $('#errortoast' + temp_id).toast('show');
                    $('#errortoast' + temp_id + ' .toast-body').html(results.error);
                } else {
                    $('#main').addClass('fadeout');
                    var temp_id = generateSuccessToast();
                    if (refferalURI_Check < 0) refferalURI = results.redirect;
                    setTimeout(function() {
                        window.location.href = refferalURI;
                    }, 1500);
                    $('#successtoast' + temp_id).toast('show');
                    $('#successtoast' + temp_id + ' .toast-body').html("Logged in! Redirecting to the Panel...");
                }
            })
            .fail(function() {
                var temp_id = generateErrorToast();
                $('#errortoast' + temp_id).toast('show');
                $('#errortoast' + temp_id + ' .toast-body').html("Could not connect to server. Please try again later...");
            })
            .always(function() {
                $("button", "#LoginForm").prop("disabled", false);
                $("button", "#LoginForm").html("Sign in");
            });
    });

    // ================================================================P A N E L   P A G E ===================

    $('#body-row .collapse').collapse('hide');

    // Collapse/Expand icon
    $('#collapse-icon').addClass('fa-angle-double-left');

    var collapsed = true;
    var accountCollapsed = false;
    var usersCollapsed = false;
    var backupsCollapsed = false;
    var systemCollapsed = false;

    // Collapse click
    $('[data-toggle=sidebar-colapse]').click(function(e) {
        e.preventDefault();
        SidebarCollapse();
    });

    function SidebarCollapse() {
        if (collapsed) {
            //console.log("Menu is collapsing");
            $('.menu-collapsed').stop().fadeToggle(600);
            $('#sidebar-container').stop().animate({ width: '60px' }, 600);
            $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
            $('.submenu-icon').css("opacity", 0);
            $('.mcontent').stop().animate({ "margin-left": '60px' }, 600);
            collapsed = false;
        } else {
            //console.log("Menu is expanding");
            clearTimeout(timeoutId);
            $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
            $('#sidebar-container').stop().animate({ width: '230px' }, 600);
            var timeoutId = setTimeout(function() {
                $('.menu-collapsed').stop().fadeToggle(600);
                $('.submenu-icon').css("opacity", 1);
            }, 1200);
            $('.mcontent').stop().animate({ "margin-left": '230px' }, 600);
            collapsed = true;

        }
        if ($('#account').is(":visible") == true) {
            $('#account').stop().slideToggle(1400);
            var arrow = $("a[href='#account'] .submenu-icon");
            arrow.toggleClass("iconRotate iconRotated");
        }
        //$('.sidebar-submenu').toggleClass('d-none');

        // Treating d-flex/d-none on separators with title
        var SeparatorTitle = $('.sidebar-separator-title');
        if (SeparatorTitle.hasClass('d-flex')) {
            SeparatorTitle.removeClass('d-flex');
        } else {
            SeparatorTitle.addClass('d-flex');
        }
    }

    $(".logoutBtn").click(function(e) {
        e.preventDefault();
        $.get("/api/logout.php")
            .done(function(data) {
                var results = JSON.parse(data);
                if (!results.success) {
                    var temp_id = generateErrorToast();
                    $('#errortoast' + temp_id).toast('show');
                    $('#errortoast' + temp_id + ' .toast-body').html("An error has occurred, please try again later...");
                } else {
                    $('#main').addClass('fadeout');
                    var temp_id = generateSuccessToast();
                    setTimeout(function() {
                        window.location.href = "/";
                    }, 1500);
                    $('#successtoast' + temp_id).toast('show');
                    $('#successtoast' + temp_id + ' .toast-body').html("Session has successfully ended!");
                }
            })
            .fail(function() {
                var temp_id = generateErrorToast();
                $('#errortoast' + temp_id).toast('show');
                $('#errortoast' + temp_id + ' .toast-body').html("Could not connect to server. Please try again later...");
            });
    });

    // ================================================ S I D E B A R   U S E R   L I N K S =======================

    $(".MenuDashboardBtn").click(function(e) {
        $('#main').addClass('fadeout');
        e.preventDefault();
        setTimeout(function() {
            window.location.href = "/user";
        }, 500);
    });

    $(".MenuDomainsBtn").click(function(e) {
        $('#main').addClass('fadeout');
        e.preventDefault();
        setTimeout(function() {
            window.location.href = "/user/domains";
        }, 500);
    });

    $(".MenuFTPsBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/user/ftps";
        }, 500);*/
    });

    $(".MenuDBsBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/user/dbs";
        }, 500);*/
    });

    $(".MenuHelpBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/user/help";
        }, 500);*/
    });

    $(".MenuSettingsBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/user/help";
        }, 500);*/
    });

    $(".MenuPassBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/user/help";
        }, 500);*/
    });

    $(".MenuMessagesBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/user/help";
        }, 500);*/
    });

    // ========================================= S I D E B A R   R E S E L L E R   L I N K S =======================

    $(".MenuRDashboardBtn").click(function(e) {
        $('#main').addClass('fadeout');
        e.preventDefault();
        setTimeout(function() {
            window.location.href = "/reseller";
        }, 500);
    });

    $(".MenuRUsersBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/reseller/users";
        }, 500);*/
    });

    $(".MenuRUsersMessagesBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/reseller/users/messages";
        }, 500);*/
    });

    $(".MenuRUsersBackupsBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/reseller/users/backups";
        }, 500);*/
    });

    $(".MenuRPacksBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/reseller/packs";
        }, 500);*/
    });

    $(".MenuRSystemBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/reseller/system";
        }, 500);*/
    });

    $(".MenuRSystemLogsBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/reseller/system/logs";
        }, 500);*/
    });

    $(".MenuRSystemSettingsBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/reseller/system/settings";
        }, 500);*/
    });

    $(".MenuRHelpBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/reseller/help";
        }, 500);*/
    });

    // ================================================ S I D E B A R   A D M I N   L I N K S =======================

    $(".MenuADashboardBtn").click(function(e) {
        $('#main').addClass('fadeout');
        e.preventDefault();
        setTimeout(function() {
            window.location.href = "/admin";
        }, 500);
    });

    $(".MenuAUsersBtn").click(function(e) {
        $('#main').addClass('fadeout');
        e.preventDefault();
        setTimeout(function() {
            window.location.href = "/admin/users";
        }, 500);
    });

    $(".MenuAUsersCronBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/admin/users/cron";
        }, 500);*/
    });

    $(".MenuAUsersBackupsBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/admin/users/backups";
        }, 500);*/
    });

    $(".MenuAPacksBtn").click(function(e) {
        $('#main').addClass('fadeout');
        e.preventDefault();
        setTimeout(function() {
            window.location.href = "/admin/packages";
        }, 500);
    });

    $(".MenuABackupsBtn").click(function(e) {
        $('#main').addClass('fadeout');
        e.preventDefault();
        setTimeout(function() {
            window.location.href = "/admin/backups";
        }, 500);
    });

    $(".MenuABackupsSysBtn").click(function(e) {
        $('#main').addClass('fadeout');
        e.preventDefault();
        setTimeout(function() {
            window.location.href = "/admin/backups/system";
        }, 500);
    });

    $(".MenuABackupsSettingsBtn").click(function(e) {
        $('#main').addClass('fadeout');
        e.preventDefault();
        setTimeout(function() {
            window.location.href = "/admin/backups/settings";
        }, 500);
    });

    $(".MenuASystemBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/admin/system";
        }, 500);*/
    });

    $(".MenuASystemSnPBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/admin/system/snp";
        }, 500);*/
    });

    $(".MenuASystemPHPBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/admin/system/php";
        }, 500);*/
    });

    $(".MenuASystemAdminBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/admin/system/admin";
        }, 500);*/
    });

    $(".MenuASystemLogsBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/admin/system/logs";
        }, 500);*/
    });

    $(".MenuASystemPanelBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/admin/system/version";
        }, 500);*/
    });

    $(".MenuAHelpBtn").click(function(e) {
        //$('#main').addClass('fadeout');
        e.preventDefault();
        /*setTimeout(function() {
            window.location.href = "/reseller/help";
        }, 500);*/
    });

    $("a[href='#users']").click(function(e) {
        e.preventDefault();
        if (!collapsed) SidebarCollapse();
        if (accountCollapsed) $("a[href='#account']").click();
        if (backupsCollapsed) $("a[href='#backups']").click();
        if (systemCollapsed) $("a[href='#system']").click();
        $("#users").stop().slideToggle(600);
        var arrow = $("a[href='#users'] .submenu-icon");
        arrow.toggleClass("iconRotate iconRotated");
        usersCollapsed = !usersCollapsed;
    });

    $("a[href='#usersm']").click(function(e) {
        e.preventDefault();
        if (accountCollapsed) $("a[href='#accountm']").click();
        if (backupsCollapsed) $("a[href='#backupsm']").click();
        if (systemCollapsed) $("a[href='#systemm']").click();
        $("#usersm").stop().slideToggle(600);
        usersCollapsed = !usersCollapsed;
    });

    $("a[href='#backups']").click(function(e) {
        e.preventDefault();
        if (!collapsed) SidebarCollapse();
        if (accountCollapsed) $("a[href='#account']").click();
        if (usersCollapsed) $("a[href='#users']").click();
        if (systemCollapsed) $("a[href='#system']").click();
        $("#backups").stop().slideToggle(600);
        var arrow = $("a[href='#backups'] .submenu-icon");
        arrow.toggleClass("iconRotate iconRotated");
        backupsCollapsed = !backupsCollapsed;
    });

    $("a[href='#backupsm']").click(function(e) {
        e.preventDefault();
        if (accountCollapsed) $("a[href='#accountm']").click();
        if (usersCollapsed) $("a[href='#usersm']").click();
        if (systemCollapsed) $("a[href='#systemm']").click();
        $("#backupsm").stop().slideToggle(600);
        backupsCollapsed = !backupsCollapsed;
    });

    $("a[href='#system']").click(function(e) {
        e.preventDefault();
        if (!collapsed) SidebarCollapse();
        if (accountCollapsed) $("a[href='#account']").click();
        if (usersCollapsed) $("a[href='#users']").click();
        if (backupsCollapsed) $("a[href='#backups']").click();
        $("#system").stop().slideToggle(600);
        var arrow = $("a[href='#system'] .submenu-icon");
        arrow.toggleClass("iconRotate iconRotated");
        systemCollapsed = !systemCollapsed;
    });

    $("a[href='#systemm']").click(function(e) {
        e.preventDefault();
        if (accountCollapsed) $("a[href='#accountm']").click();
        if (usersCollapsed) $("a[href='#usersm']").click();
        if (backupsCollapsed) $("a[href='#backupsm']").click();
        $("#systemm").stop().slideToggle(600);
        systemCollapsed = !systemCollapsed;
    });

    $("a[href='#account']").click(function(e) {
        e.preventDefault();
        if (!collapsed) SidebarCollapse();
        if (usersCollapsed) $("a[href='#users']").click();
        if (backupsCollapsed) $("a[href='#backups']").click();
        if (systemCollapsed) $("a[href='#system']").click();
        $("#account").stop().slideToggle(600);
        var arrow = $("a[href='#account'] .submenu-icon");
        arrow.toggleClass("iconRotate iconRotated");
        accountCollapsed = !accountCollapsed;
    });

    $("a[href='#accountm']").click(function(e) {
        e.preventDefault();
        if (usersCollapsed) $("a[href='#usersm']").click();
        if (backupsCollapsed) $("a[href='#backupsm']").click();
        if (systemCollapsed) $("a[href='#systemm']").click();
        $("#accountm").stop().slideToggle(600);
        accountCollapsed = !accountCollapsed;
    });

    $(".navbar-toggler").click(function(e) {
        e.preventDefault();
        $("#navbarNavDropdown").stop().slideToggle(600);
    })

    $('.show-tooltip').each(function(e) {
        var p = $(this).parent();
        if(p.is('td')) {
            /* if your tooltip is on a <td>, transfer <td>'s padding to wrapper */
            $(this).css('padding', p.css('padding'));
            p.css('padding', '0 0');
        }
        $(this).tooltip({
            toggle: 'toolip',
            placement: 'bottom',
            delay: {"show":"600"}//, "hide":"3000"}
        });
    });

    $(".show-tooltip").on('shown.bs.tooltip', function(e){
        var ttid = $(this).data('bs.tooltip').tip.id;//.attr('aris-described-by');
        if($(this).hasClass("tooltipRed")){
            $('#'+ttid).append('<style>.tooltip * {transition:0.25s;}.arrow::before{ \
                transition:0.25s !important; \
                border-top-color:#f55 !important; \
                border-bottom-color:#f55 !important; \
            }.tooltip-inner{ \
                background-color: #f55; \
                font-weight: bold; \
            }</style>')
            //$('.tooltip-inner','#'+ttid).css({"background-color": "#f55","font-weight": "bold"});
            //console.log($('#'+ttid).children()[1]);
            
        }
    });

    $('#adminModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');
        var modal = $(this);

        if(action == "add"){
            modal.find('.modal-title').text('Add a new Admin');
        }else if(action == "edit"){
            var id = button.data('id');
        }else{
            modal.find('.modal-title').text('Error');
            $(".modal-body").html("No action has been defined. Please refresh the page");
            $(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>');
        }
    });

    $("button[type='submit']","#AdminModalForm").click(function(e) {
        e.preventDefault();
        var form = $("#AdminModalForm");
        var data = $("#AdminModalForm").serialize();
        var me = $("button[type='submit']","#AdminModalForm");

        me.prop("disabled", true);
        me.html('<span class="spinner-border spinner-border-sm mb-1 role="status" aria-hidden="true"></span> Checking details...');

        $.post("/api/admin/users/admin.php", data)
            .done(function(data) {
                data = JSON.parse(data);
                if(data.success){
                    var temp_id = generateSuccessToast();
                    $('#successtoast' + temp_id).toast('show');
                    $('#successtoast' + temp_id + ' .toast-body').html("Admin was added successfully");
                    let fName = $("#AdminModalForm #aFNameInput").val();
                    let lName = $("#AdminModalForm #aLNameInput").val();
                    $("#adminTable tr:last").after('<tr> <th>'+data.id+'</th> <td>'+fName+'</td> <td>'+lName+'</td> <td>0</td> <td>0.00MB</td> <td><button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button><button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button></td> </tr>');
                }else{
                    var temp_id = generateErrorToast();
                    $('#errortoast' + temp_id).toast('show');
                    $('#errortoast' + temp_id + ' .toast-body').html(data.error);
                }
            }).fail(function(){
                var temp_id = generateErrorToast();
                $('#errortoast' + temp_id).toast('show');
                $('#errortoast' + temp_id + ' .toast-body').html("Could not connect to server. Please try again later...");
            }).always(function(){
                me.prop("disabled", false);
                me.html("Save Changes");
            })
    });

    $('#resellerModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');
        var modal = $(this);
    
        if(action == "add"){
            modal.find('.modal-title').text('Add a new Reseller');
        }else if(action == "edit"){
            var id = button.data('id');
        }else{
            modal.find('.modal-title').text('Error');
            $(".modal-body").html("No action has been defined. Please refresh the page");
            $(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>');
        }
    });

    $("button[type='submit']","#ResellerModalForm").click(function(e) {
        e.preventDefault();
        var form = $("#ResellerModalForm");
        var data = $("#ResellerModalForm").serialize();
        var me = $("button[type='submit']","#ResellerModalForm");

        me.prop("disabled", true);
        me.html('<span class="spinner-border spinner-border-sm mb-1 role="status" aria-hidden="true"></span> Checking details...');

        $.post("/api/admin/users/reseller.php", data)
            .done(function(data) {
                data = JSON.parse(data);
                if(data.success){
                    var temp_id = generateSuccessToast();
                    $('#successtoast' + temp_id).toast('show');
                    $('#successtoast' + temp_id + ' .toast-body').html("Reseller was added successfully");
                    let fName = $("#ResellerModalForm #rFNameInput").val();
                    let lName = $("#ResellerModalForm #rLNameInput").val();
                    $("#resellerTable tr:last").after('<tr> <th>'+data.id+'</th> <td>'+fName+'</td> <td>'+lName+'</td> <td>0</td> <td>0.00MB</td> <td><button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button><button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button></td> </tr>');
                }else{
                    var temp_id = generateErrorToast();
                    $('#errortoast' + temp_id).toast('show');
                    $('#errortoast' + temp_id + ' .toast-body').html(data.error);
                }
            }).fail(function(){
                var temp_id = generateErrorToast();
                $('#errortoast' + temp_id).toast('show');
                $('#errortoast' + temp_id + ' .toast-body').html("Could not connect to server. Please try again later...");
            }).always(function(){
                me.prop("disabled", false);
                me.html("Save Changes");
            })
    });

    $('#packageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');
        var modal = $(this);

        if(action == "add"){
            modal.find('.modal-title').text('Add a new Package');
        }else if(action == "edit"){
            var id = button.data('id');
        }else{
            modal.find('.modal-title').text('Error');
            $(".modal-body").html("No action has been defined. Please refresh the page");
            $(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>');
        }
    });

    $("button[type='submit']","#PackageModalForm").click(function(e) {
        e.preventDefault();
        var form = $("#PackageModalForm");
        var data = $("#PackageModalForm").serialize();
        var me = $("button[type='submit']","#PackageModalForm");

        me.prop("disabled", true);
        me.html('<span class="spinner-border spinner-border-sm mb-1 role="status" aria-hidden="true"></span> Checking details...');

        $.post("/api/admin/packages/reseller.php", data)
            .done(function(data) {
                data = JSON.parse(data);
                if(data.success){
                    var temp_id = generateSuccessToast();
                    $('#successtoast' + temp_id).toast('show');
                    $('#successtoast' + temp_id + ' .toast-body').html("Reseller Package was added successfully");
                    //let fName = $("#PackageModalForm #pFNameInput").val();
                    //let lName = $("#PackageModalForm #pLNameInput").val();
                    //$("#resellerTable tr:last").after('<tr> <th>'+data.id+'</th> <td>'+fName+'</td> <td>'+lName+'</td> <td>0</td> <td>0.00MB</td> <td><button class="btn btn-info px-1 py-0 mx-1" disabled>Edit</button><button class="btn btn-danger px-1 py-0 mx-1" disabled>Delete</button></td> </tr>');
                }else{
                    var temp_id = generateErrorToast();
                    $('#errortoast' + temp_id).toast('show');
                    $('#errortoast' + temp_id + ' .toast-body').html(data.error);
                }
            }).fail(function(){
                var temp_id = generateErrorToast();
                $('#errortoast' + temp_id).toast('show');
                $('#errortoast' + temp_id + ' .toast-body').html("Could not connect to server. Please try again later...");
            }).always(function(){
                me.prop("disabled", false);
                me.html("Save Changes");
            })
    });
});

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return decodeURI(c.substring(name.length, c.length));
        }
    }
    return "";
}