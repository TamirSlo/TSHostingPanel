var eToastNum = 0
var sToastNum = 0
var cToastNum = 0

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

function generateConfirmToast() {
    cToastNum = cToastNum + 1;
    $("#toasts").append('<div class="toast fade" role="alert" aria-live="assertive" aria-atomix="true" data-autohide=false id="confirmtoast' + cToastNum + '"> \
        <div class="toast-header"> \
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="796 698.08 200 200" xml:space="preserve"> \
        <path style="fill: #ffc107;" d="M994.47 869.072 905.896 715.66a11.427 11.427 0 0 0-19.792 0l-88.573 153.412a11.428 11.428 0 0 0 9.896 17.141h177.147a11.427 11.427 0 0 0 9.896-17.141zM896 870.253c-7.22 0-13.072-5.852-13.072-13.071 0-7.221 5.852-13.072 13.072-13.072 7.221 0 13.072 5.852 13.072 13.072 0 7.22-5.851 13.071-13.072 13.071zm14.58-105.018-7.793 62.267a6.841 6.841 0 0 1-7.637 5.938c-3.168-.396-5.557-2.908-5.938-5.938l-7.793-62.267c-1.007-8.053 4.703-15.397 12.755-16.405 8.053-1.007 15.397 4.703 16.405 12.756.153 1.214.14 2.486.001 3.649z"/> \
        </svg><strong class="mr-auto">Warning!</strong> \
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"> \
        <span aria-hidden="true">&times;</span> \
        </button> \
        </div><div class="toast-body"></div><div class="toast-footer"></div></div>');
    return cToastNum;
}