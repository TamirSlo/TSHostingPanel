var eToastNum = 0
var sToastNum = 0

function generateErrorToast() {
    eToastNum = eToastNum + 1;
    $("#toasts").append('<div class="toast fade" role="alert" aria-live="assertive" aria-atomix="true" data-delay=3500 id="errortoast' + eToastNum + '"> \
        <div class="toast-header"> \
        <svg xmlns="http://www.w3.org/2000/svg" class="bd-placeholder-img rounded mr-2" width="20" height="20" \
        viewBox="0 0 50 50"><circle cx="25" cy="25" r="25" fill="#d75a4a" /> \
        <path fill="none" stroke="#fff" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" \
        d="M16 34l9-9 9-9M16 16l9 9 9 9" /> \
        </svg><strong class="mr-auto">Error!</strong> \
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"> \
        <span aria-hidden="true">&times;</span> \
        </button> \
        </div><div class="toast-body"></div></div>');
    return eToastNum;
}

function generateSuccessToast() {
    sToastNum = sToastNum + 1;
    $("#toasts").append('<div class="toast fade" role="alert" aria-live="assertive" aria-atomix="true" data-delay=3500 id="successtoast' + sToastNum + '"> \
        <div class="toast-header"> \
        <svg xmlns="http://www.w3.org/2000/svg" class="bd-placeholder-img rounded mr-2" x="0px" y="0px" \
            viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve" width="20" height="20"> \
        <circle style="fill:#25AE88;" cx="25" cy="25" r="25"/> \
        <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points=" \
            38,15 22,33 12,25 "/> \
        </svg><strong class="mr-auto">Success!</strong> \
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"> \
        <span aria-hidden="true">&times;</span> \
        </button> \
        </div><div class="toast-body"></div></div>');
    return sToastNum;
}