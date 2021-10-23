<?php


class DA extends Data{

    private $db;
    private $reseller;
    private $admin;
    public $fname;
    public $lname;
    public $id;

    public function __construct()
    {
        //Require necessary classes
        session_start(); 
        if(!@include("db.php")) die("Error 2 -> Couldn't require Database Class.");
        if(!@include("config.php")) die("Error 3 -> Couldn't require Configuration.");

        //Attempt a connection to the database
        $this->db = new DB($config['db_host'],$config['db_user'],$config['db_pass'],$config['db_name']);
        if (!($this->db->connect())) {
            session_destroy();
            die("Error 4 -> Database connection could not be established");
        }

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

    private function generateSalt()
    {
        $bytes = mcrypt_create_iv(8, MCRYPT_DEV_URANDOM);
        $salt = bin2hex($bytes);
        return $salt;
    }

    private function hashPass($password, $salt)
    {
        $p_md5 = md5($password);
        $s_sha1 = sha1($salt);
        $pns = $p_md5 . $s_sha1;
        $hashed = md5($pns);
        return $hashed;
    }

    private function validateEmail($email){
        $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        if(!preg_match($regex, $email)) {
            return false;
        }
        return true;
    }

    // public function addUser($user,$pass,$email,$fname,$lname,$welcomemail){
    //     $cuid = $this->id;
	
    //     if(!$user || !$pass || !$email || !$fname || !$lname){
    //         $r['success'] = false;
    //         $r['error'] = "Please fill in all fields.";
    //         return $r;
    //     }
	
    //     if(!ctype_alpha($fname)){
    //         $r['success'] = false;
    //         $r['error'] = "First Name may only contain letters.";
    //         return $r;
    //     }
        
    //     if(!ctype_alpha($lname)){
    //         $r['success'] = false;
    //         $r['error'] = "Last Name may only contain letters.";
    //         return $r;
    //     }
        
    //     if(!$this->validateEmail($email)){
    //         $r['success'] = false;
    //         $r['error'] = "Email address entered is not valid.";
    //         return $r;
    //     }
        
    //     // if(!ctype_alnum(str_replace(".", "", $user))){
    //     //     $r['success'] = false;
    //     //     $r['error'] = "Username may only contain letters, numbers and dots.";
    //     //     return $r;
    //     // }

    //     if(!preg_match_all('/^([a-zA-Z\s\d._-]+)$/', $user)){
    //         $r['success'] = false;
    //         $r['error'] = "The only characters allowed in Username are:<br><b>[A-Z0-9.-_].</b>";
    //         return $r;
    //     }

    //     if(!preg_match_all('/^([a-zA-Z\s\d.-_!?@$%^&*]+)$/', $pass)){
    //         $r['success'] = false;
    //         $r['error'] = "The only characters allowed in Password are:<br><b>[A-Z0-9.-_!?@$%^&*].</b>";
    //         return $r;
    //     }
        
    //     // if(!ctype_alnum($pass)){
    //     //     $r['success'] = false;
    //     //     $r['error'] = "Password may only contain letters and numbers.";
    //     //     return $r;
    //     // }
	
    //     if($pos != 1 && $pos != 2){
    //         $r['success'] = false;
    //         $r['error'] = "Position must be chosen.";
    //         return $r;
    //     }else{
    //         $pos--;
    //     }

    //     $s = $this->getUserDetails($user);
    //     if($s['success'] && count($s['results']) != 0){
    //         $r['success'] = false;
    //         $r['error'] = "Username already exists.";
    //         return $r;
    //     }

    //     $t = $this->getEmailDetails($email);
    //     if($t['success'] && count($t['results']) != 0){
    //         $r['success'] = false;
    //         $r['error'] = "Email already exists.";
    //         return $r;
    //     }

    //     // All good below...

    //     $salt = $this->generateSalt();
    //     $hpass = $this->hashPass($pass,$salt);

    //     $u = $this->db->addEmployee($user,$hpass,$salt,$email,$fname,$lname,$pos);
    //     $new_id = $this->db->lastInsertId();

    //     $r['success'] = true;
    //     $r['id'] = $new_id;

    //     $mail = new Mail();
    //     $admin_name = $this->fname." ".$this->lname;
    //     $mail->welcomeMessage($admin_name,$user,$pass);
    //     $mail->addEmployee($email);
    //     $mail->send();

        
    //     return $r;
    // }

    public function Logout(){
        session_destroy();
        return array("success"=>true);
    }

    public function getIDDetails($id){
        $v = $this->vID($id);
        if(!$v) return $v;

        $s = $this->db->getIDDetails($id);
        return $s;
    }

    public function getUserDetails($user){
        if(!ctype_alnum(str_replace(".", "", $user))){
            $r['success'] = false;
            $r['error'] = "Username may only contain letters, numbers and dots.";
            return $r;
        }

        $s = $this->db->getUserDetails($user);
        return $s;
    }

    public function getEmailDetails($email){
        if(!$this->validateEmail($email)){
            $r['success'] = false;
            $r['error'] = "Email is not valid.";
            return $r;
        }

        $s = $this->db->getEmailDetails($email);
        return $s;
    }

    public function addAdmin($user,$pass,$email,$fname,$lname,$welcomemail){
        if(!$this->admin){
            $r['success'] = false;
            $r['error'] = "You have no permissions to perform this request.";
            return $r;
        }
	
        if(!$user || !$pass || !$email || !$fname || !$lname){
            $r['success'] = false;
            $r['error'] = "Please fill in all fields.";
            return $r;
        }
	
        if(!ctype_alpha($fname)){
            $r['success'] = false;
            $r['error'] = "First Name may only contain letters.";
            return $r;
        }
        
        if(!ctype_alpha($lname)){
            $r['success'] = false;
            $r['error'] = "Last Name may only contain letters.";
            return $r;
        }
        
        if(!$this->validateEmail($email)){
            $r['success'] = false;
            $r['error'] = "Email address entered is not valid.";
            return $r;
        }

        if(!preg_match_all('/^([a-zA-Z\s\d._-]+)$/', $user)){
            $r['success'] = false;
            $r['error'] = "The only characters allowed in Username are:<br><b>[A-Z0-9.-_].</b>";
            return $r;
        }

        if(!preg_match_all('/^([a-zA-Z\s\d.-_!?@$%^&*]+)$/', $pass)){
            $r['success'] = false;
            $r['error'] = "The only characters allowed in Password are:<br><b>[A-Z0-9.-_!?@$%^&*].</b>";
            return $r;
        }

        $s = $this->getUserDetails($user);
        if($s['success'] && count($s['results']) != 0){
            $r['success'] = false;
            $r['error'] = "Username already exists.";
            return $r;
        }

        $t = $this->getEmailDetails($email);
        if($t['success'] && count($t['results']) != 0){
            $r['success'] = false;
            $r['error'] = "Email already exists.";
            return $r;
        }

        // All good below...

        $salt = $this->generateSalt();
        $hpass = $this->hashPass($pass,$salt);

        $u = $this->db->addAdmin($user,$hpass,$salt,$email,$fname,$lname);
        $new_id = $this->db->lastInsertId();

        $r['success'] = true;
        $r['id'] = $new_id;

        if($welcomemail){
            // $mail = new Mail();
            // $admin_name = $this->fname." ".$this->lname;
            // $mail->welcomeAdminMessage($admin_name,$user,$pass);
            // $mail->addRecipient($email);
            // $mail->send();
        }

        
        return $r;
    
    }

    public function addReseller($user,$pass,$email,$fname,$lname,$welcomemail){
        if(!$this->admin){
            $r['success'] = false;
            $r['error'] = "You have no permissions to perform this request.";
            return $r;
        }
	
        if(!$user || !$pass || !$email || !$fname || !$lname){
            $r['success'] = false;
            $r['error'] = "Please fill in all fields.";
            return $r;
        }
	
        if(!ctype_alpha($fname)){
            $r['success'] = false;
            $r['error'] = "First Name may only contain letters.";
            return $r;
        }
        
        if(!ctype_alpha($lname)){
            $r['success'] = false;
            $r['error'] = "Last Name may only contain letters.";
            return $r;
        }
        
        if(!$this->validateEmail($email)){
            $r['success'] = false;
            $r['error'] = "Email address entered is not valid.";
            return $r;
        }

        if(!preg_match_all('/^([a-zA-Z\s\d._-]+)$/', $user)){
            $r['success'] = false;
            $r['error'] = "The only characters allowed in Username are:<br><b>[A-Z0-9.-_].</b>";
            return $r;
        }

        if(!preg_match_all('/^([a-zA-Z\s\d.-_!?@$%^&*]+)$/', $pass)){
            $r['success'] = false;
            $r['error'] = "The only characters allowed in Password are:<br><b>[A-Z0-9.-_!?@$%^&*].</b>";
            return $r;
        }

        $s = $this->getUserDetails($user);
        if($s['success'] && count($s['results']) != 0){
            $r['success'] = false;
            $r['error'] = "Username already exists.";
            return $r;
        }

        $t = $this->getEmailDetails($email);
        if($t['success'] && count($t['results']) != 0){
            $r['success'] = false;
            $r['error'] = "Email already exists.";
            return $r;
        }

        // All good below...

        $salt = $this->generateSalt();
        $hpass = $this->hashPass($pass,$salt);

        $u = $this->db->addReseller($user,$hpass,$salt,$email,$fname,$lname);
        $new_id = $this->db->lastInsertId();

        $r['success'] = true;
        $r['id'] = $new_id;

        if($welcomemail){
            // $mail = new Mail();
            // $admin_name = $this->fname." ".$this->lname;
            // $mail->welcomeAdminMessage($admin_name,$user,$pass);
            // $mail->addRecipient($email);
            // $mail->send();
        }

        
        return $r;
    
    }

    public function getAdmins(){
        if(!$this->admin){
            $r['success'] = false;
            $r['error'] = "You have no permissions to perform this request.";
            return $r;
        }

        $list = $this->db->getAdmins();
        return $list;
    }

    public function getResellers(){
        if(!$this->admin){
            $r['success'] = false;
            $r['error'] = "You have no permissions to perform this request.";
            return $r;
        }

        $list = $this->db->getResellers();
        return $list;
    }

    public function addResellerPackage($name,$users,$bandwidth,$diskSpace,$domains,$subDomains,$databases,$ftpAccounts){
        if(!$this->admin){
            $r['success'] = false;
            $r['error'] = "You have no permissions to perform this request.";
            return $r;
        }
	
        if(!$name){
            $r['success'] = false;
            $r['error'] = "Please fill in all fields.";
            return $r;
        }
	
        if(!ctype_alpha(str_replace(" ","",$name))){
            $r['success'] = false;
            $r['error'] = "Package Name may only contain letters and spaces.";
            return $r;
        }

        if(!is_numeric($users) || $users < 0 || $users > 999){
            $r['success'] = false;
            $r['error'] = "Users amount must be between 0 and 999.";
            return $r;
        }

        if(!is_numeric($bandwidth) || $bandwidth < 0 || $bandwidth > 999999){
            $r['success'] = false;
            $r['error'] = "Max bandwidth must be between 0 and 999,999.";
            return $r;
        }

        if(!is_numeric($diskSpace) || $diskSpace < 0 || $diskSpace > 999999){
            $r['success'] = false;
            $r['error'] = "Max Disk Space must be between 0 and 999,999.";
            return $r;
        }

        if(!is_numeric($domains) || $domains < 0 || $domains > 999){
            $r['success'] = false;
            $r['error'] = "Domains amount must be between 0 and 999.";
            return $r;
        }

        if(!is_numeric($subDomains) || $subDomains < 0 || $subDomains > 999){
            $r['success'] = false;
            $r['error'] = "Sub Domains amount must be between 0 and 999.";
            return $r;
        }

        if(!is_numeric($databases) || $databases < 0 || $databases > 999){
            $r['success'] = false;
            $r['error'] = "Database amount must be between 0 and 999.";
            return $r;
        }

        if(!is_numeric($ftpAccounts) || $ftpAccounts < 0 || $ftpAccounts > 999){
            $r['success'] = false;
            $r['error'] = "FTP Accounts amount must be between 0 and 999.";
            return $r;
        }

        // All good below...
        
        $u = $this->db->addResellerPackage($name,$users,$bandwidth,$diskSpace,$domains,$subDomains,$databases,$ftpAccounts);
        $new_id = $this->db->lastInsertId();

        $r['success'] = true;
        $r['id'] = $new_id;
        
        return $r;
    
    }

    public function getResellerPackages(){
        if(!$this->admin){
            $r['success'] = false;
            $r['error'] = "You have no permissions to perform this request.";
            return $r;
        }

        $list = $this->db->getResellerPackages();
        return $list;
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
        $first = "© 2021 Web Hosting Panel - Developed by ";
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










// ======================= D A T A    H A N D L I N G    C L A S S ======================= \\

class Data{

    // DATA VERIFICATION METHODS
    public function vID($id){
        if(!is_numeric($id)){
            $r['success'] = false;
            $r['error'] = "User ID may only contain numbers.";
            return $r;
        }
    }
    
}
?>