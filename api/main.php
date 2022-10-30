<?php
namespace API;

use API\Auth\Session;
use API\Controllers\ResellerPackagesController;
use API\DB;
use API\Controllers\UserController;
use API\Models\User;

class TSHP {

    public static self $instance;

    public ?User $user;
    public UserController $users;
    public ResellerPackagesController $resellerPackages;
    

    public function __construct(){
        self::$instance = $this;
        spl_autoload_register(function ($class) {
            // if string ends with Controller
            if( substr($class, -10) === 'Controller' ){
                $path = str_replace('\\', '/', substr(strtolower($class), 0, -10)) . '.controller.php';
            } else {
                $path = str_replace('\\', '/', strtolower($class)) . '.php';
            }
            include $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
        });

        set_exception_handler(function($e){
            // http_response_code(500);
            echo json_encode([
                "success" => false,
                "error" => $e->getMessage()
            ]);
        });

        $this->db = DB::getInstance();
        
        $session = new Session();
        $this->user = $session->user ?? null;

        $this->users = new UserController();
        $this->resellerPackages = new ResellerPackagesController();

    }

    public static function getInstance(): self{
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}





// ======================= U S E R    I N T E R F A C E     C L A S S ======================= \\

class UI{

    public function header(){
        echo '<html>
    <head>
        <title>TS Hosting Panel</title>
        <link rel="shortcut icon" type="image/gif" href="/assets/images/icon-lg.gif" />
        <script src="/assets/js/jquery.js"></script>
        <script src="/assets/js/popper.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        
        <script src="/assets/js/main.js"></script>
        <script src="/assets/js/toasts.js"></script>
    </head>
    <body>

    <div id="main">
        
        <script>document.getElementById("main").className += " fadeout";</script>
        <link rel="stylesheet" href="/assets/css/panel.css">';
        if(!@include(dirname(__FILE__)."/../user/menu.php")) die("Error 5 -> Couldn't require menu.");
        echo '<div class="row" id="body-row" style="margin-top: 56px;">';
        if(!@include(dirname(__FILE__)."/../user/sidebar.php")) die("Error 6 -> Couldn't require sidebar.");
        echo '<div class="mcontent d-md-block d-none"></div><div class="col">';
    }

    public function headerReseller(){
        echo '<html>
    <head>
        <title>TS Hosting Panel</title>
        <link rel="shortcut icon" type="image/gif" href="/assets/images/icon-lg.gif" />
        <script src="/assets/js/jquery.js"></script>
        <script src="/assets/js/popper.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        
        <script src="/assets/js/main.js"></script>
        <script src="/assets/js/toasts.js"></script>
    </head>
    <body>

    <div id="main">
        
        <script>document.getElementById("main").className += " fadeout";</script>
        <link rel="stylesheet" href="/assets/css/panel.css">';
        if(!@include(dirname(__FILE__)."/../reseller/menu.php")) die("Error 5 -> Couldn't require menu.");
        echo '<div class="row" id="body-row" style="margin-top: 56px;">';
        if(!@include(dirname(__FILE__)."/../reseller/sidebar.php")) die("Error 6 -> Couldn't require sidebar.");
        echo '<div class="mcontent d-md-block d-none"></div><div class="col">';
    }

    public function headerAdmin(){
        echo '<html>
    <head>
        <title>TS Hosting Panel</title>
        <link rel="shortcut icon" type="image/gif" href="/assets/images/icon-lg.gif" />
        <script src="/assets/js/jquery.js"></script>
        <script src="/assets/js/popper.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        
        <script src="/assets/js/main.js"></script>
        <script src="/assets/js/toasts.js"></script>
    </head>
    <body>

    <div id="main">
        
        <script>document.getElementById("main").className += " fadeout";</script>
        <link rel="stylesheet" href="/assets/css/panel.css">';
        if(!@include(dirname(__FILE__)."/../admin/menu.php")) die("Error 5 -> Couldn't require menu.");
        echo '<div class="row" id="body-row" style="margin-top: 56px;">';
        if(!@include(dirname(__FILE__)."/../admin/sidebar.php")) die("Error 6 -> Couldn't require sidebar.");
        echo '<div class="mcontent d-md-block d-none"></div><div class="col">';
    }

    public function footer(){
        echo '</div>';
        $this->copyright(false);
        echo '</div></div>';
        echo '
    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height:100%;">
		<div id="toasts">
		</div>
	</div></body></html>';
    }

    public function copyright($phone = true){
        $year = date('Y');
        $first = "© 2021 - " . $year ." Web Hosting Panel - Developed by ";
        $tamir = '<a href="https://tamirslo.dev" class="text-primary" target="_blank">TamirSlo</a>';
        if(!$phone){
            echo '<span class="col-12 text-info text-center small my-3 d-block d-md-none"><hr>
            '.$first.$tamir.'</span>';
        }else{
            echo '<span class="text-info text-center small my-3 menu-collapsed" style="display: inline-block;">
            '.$first.$tamir.'</span>';
        }
        
    }
    
}

?>