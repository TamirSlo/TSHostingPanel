<?php
namespace API;

use API\Controllers\ResellerPackagesController;
use API\DB;
use API\Controllers\UserController;

class TSHP {

    public static self $instance;

    public $db;
    public $reseller;
    public $admin;
    public $fname;
    public $lname;
    public $id;

    public UserController $users;
    public ResellerPackagesController $resellerPackages;
    

    public function __construct(){
        self::$instance = $this;
        session_start(); 
        spl_autoload_register(function ($class) {
            // if string ends with Controller
            if( substr($class, -10) === 'Controller' ){
                $path = str_replace('\\', '/', substr(strtolower($class), 0, -10)) . '.controller.php';
            } else {
                $path = str_replace('\\', '/', strtolower($class)) . '.php';
            }
            include $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
        });

        $this->db = DB::getInstance();

        //Check for existing session
        $auth = $this->Authenticate();
        if($auth){
            $url = $_SERVER['REQUEST_URI'];

            if($this->admin){
                if (!strpos($url,'admin') && !strpos($url,'reseller') && !strpos($url,'user') && !strpos($url,'api')) header("Location:/admin/");
            } else if($this->reseller) {
                if (!strpos($url,'reseller') && !strpos($url,'user') && !strpos($url,'api')) header("Location:/reseller/");
            } else {
                if (!strpos($url,'user') && !strpos($url,'api')) header("Location:/user/");
            }
        }else{
            //echo "Oops, seems like ur a guest, or ur password changed!";
            //echo $_SERVER['REQUEST_URI'];
            switch ($_SERVER['REQUEST_URI']) {
                case '/':
                    break;
                case '/api/login/':
                    break;
                default:
                    setcookie("error",str_replace(' ','%20',"You are not authorised to view this page... Please login."),0,"/");
                    setcookie("eRefferal",$_SERVER['REQUEST_URI'],0,"/");
                    header("Location:/");
                    
            }
        }

        $this->users = new UserController();
        $this->resellerPackages = new ResellerPackagesController();

    }

    public static function getInstance(): self{
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function Authenticate(){
        if(isset($_SESSION['Username'])){
            $user = $_SESSION['Username'];
            $pass = $_SESSION['Password'];
            
            $result = $this->db->Login($user);
            if($result['success']){
                $dbpass = $result["results"][0]['Password'];
                if($pass = $dbpass) {
                    $this->admin = $result["results"][0]['Admin'];
                    $this->reseller = $result["results"][0]['Reseller'];
                    $this->id = $result["results"][0]['UserID'];
                    $this->fname = $result["results"][0]['FName'];
                    $this->lname = $result["results"][0]['LName'];
                    $_SESSION['FName'] = $result["results"][0]['FName'];
                    $_SESSION['LName'] = $result["results"][0]['LName'];
                    $_SESSION['Admin'] = $result["results"][0]['Admin'];
                    $_SESSION['Reseller'] = $result["results"][0]['Reseller'];
                    $_SESSION['UserID'] = $result["results"][0]['UserID'];
                    $suspended = $result["results"][0]['Suspended'];
                    if($suspended){
                        return false;
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function Login($user,$pass){

        if(!$user || !$pass){
            $r['success'] = false;
            $r['error'] = "Please fill in all fields.";
            return $r;
        }
        
        if(!ctype_alnum(str_replace(".", "", $user))){
            $r['success'] = false;
            $r['error'] = "Username may only contain letters, numbers and dots.";
            return $r;
        }

        if(!ctype_alnum($pass)){
            $r['success'] = false;
            $r['error'] = "Password may only contain letters and numbers.";
            return $r;
        }

        $return = array();
        $result = $this->db->Login($user);
        if($result['success'] && count($result['results']) > 0){
            $dbpassword = $result["results"][0]['Password'];
            $dbsalt = $result["results"][0]['Salt'];

            $hpass = $this->hashPass($pass,$dbsalt);

            if($dbpassword == $hpass){
                $return["success"] = true;

                $id = $result["results"][0]['UserID'];
                $admin = $result["results"][0]['Admin'];
                $reseller = $result["results"][0]['Reseller'];
                $fname = $result["results"][0]['FName'];
                $lname = $result["results"][0]['LName'];
                $suspended = $result["results"][0]['Suspended'];

                $return['redirect'] = "user/";
                if($admin) $return['redirect'] = "admin/";
                if($reseller) $return['redirect'] = "reseller/";

                $_SESSION['Username'] = $user;
                $_SESSION['Password'] = $dbpassword;
                $_SESSION['Admin'] = $admin;
                $_SESSION['FName'] = $fname;
                $_SESSION['LName'] = $lname;
                $_SESSION['UserID'] = $id;
                $_SESSION['Reseller'] = $reseller;
                $_SESSION['Suspended'] = $suspended;

                if($suspended){
                    $return["success"] = false;
                    $return["error"] = "Your account has been suspended.";
                }
            } else {
                $return["success"] = false;
                $return["error"] = "Invalid login. Please verify your Username and Password";
            }

        } else {
            $return["success"] = false;
            $return["error"] = "Invalid login. Please verify your Username and Password";
        }
        return $return;
    }

    public function generateSalt(){
        $bytes = random_bytes(8);
        $salt = bin2hex($bytes);
        return $salt;
    }

    public function hashPass($password, $salt){
        $p_md5 = md5($password);
        $s_sha1 = sha1($salt);
        $pns = $p_md5 . $s_sha1;
        $hashed = md5($pns);
        return $hashed;
    }

    public function Logout(){
        session_destroy();
        return array("success"=>true);
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