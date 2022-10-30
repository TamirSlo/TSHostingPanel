<?php

namespace API\Auth;

class Session {
    public \API\Models\User $user;

    public function __construct(){
        session_start(); 
        try{
            $user = $this->Authenticate();
            $url = $_SERVER['REQUEST_URI'];

            if($user->Admin){
                if (!strpos($url,'admin') && !strpos($url,'reseller') && !strpos($url,'user') && !strpos($url,'api')) header("Location:/admin/");
            } else if($user->Reseller) {
                if (!strpos($url,'reseller') && !strpos($url,'user') && !strpos($url,'api')) header("Location:/reseller/");
            } else {
                if (!strpos($url,'user') && !strpos($url,'api')) header("Location:/user/");
            }

            $this->user = $user;
        }catch(\Exception $e){
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

    private function Authenticate(): \API\Models\User {
        if(isset($_SESSION['Username']) && isset($_SESSION['Password'])) {
            $db = \API\DB::getInstance();
            $username = $_SESSION['Username'];
            $pass = $_SESSION['Password'];
            
            $auth = $db->Login($username);
            if($auth['success'] && count($auth['results']) > 0){
                $dbpass = $auth["results"][0]['Password'];

                if($pass == $dbpass) {

                    $user = \API\Models\User::selectByUsername($username);
                    if($user->Suspended){
                        throw new \Exception("Your account has been suspended.");
                    }

                    return $user;
                }
            }
        }
        throw new \Exception("Session expired.");
    }

    public static function Login(\API\Models\Name $username, string $pass): string {
        $db = \API\DB::getInstance();
        $auth = $db->Login($username);

        if($auth['success'] && count($auth['results']) > 0){
            $dbpassword = $auth["results"][0]['Password'];
            $dbsalt = $auth["results"][0]['Salt'];

            $hpass = self::hashPass($pass,$dbsalt);

            if($dbpassword == $hpass){
                $user = \API\Models\User::selectByUsername($username);
                if($user->Suspended){
                    throw new \Exception("Your account has been suspended.");
                }

                $_SESSION['Username'] = $username;
                $_SESSION['Password'] = $dbpassword;

                return strtolower($user->UserType)."/";
            }
        }
        throw new \Exception("Invalid details. Please verify your Username and Password");
    }

    public static function generateSalt(): string{
        $bytes = random_bytes(16);
        $salt = bin2hex($bytes);
        return $salt;
    }

    public static function hashPass(string $password, string $salt): string{
        $p_md5 = hash("sha256", $password);
        $s_sha1 =  hash("sha256", $salt);
        $pns = $p_md5 . $s_sha1;
        $hashed = hash("sha256", $pns);
        return $hashed;
    }

    public static function Logout(){
        session_destroy();
    }
}


?>