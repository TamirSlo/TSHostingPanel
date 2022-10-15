<?php

class DB
{
    private $db = null;

    private $host = "";
    private $username = "";
    private $password = "";
    private $dbname = "";

    public function __construct($h, $u, $p, $d)
    {
        $this->host = $h;
        $this->username = $u;
        $this->password = $p;
        $this->dbname = $d;
    }

    public function connect()
    {
        try {
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(500);
            die('Error establishing connection with database');
        }
        /*$this->db = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
        if ($this->db) {
            return true;
        } else {
            return false;
        }*/
    }

    private function checkResponse($r, $sql = "SEL", $s = true){ // $r = a PDOStatement Object, $sql = type of statement [SEL,INS,UPD,DEL];
        if ($sql == "SEL"){
            $r->setFetchMode(PDO::FETCH_ASSOC);
            $success = $r->execute();
            $arr = $r->fetchAll();
            if(!$success) {
                return array("success" => false, "error" => "Error in SQL Response");
            }else{
                return array("success" => true, "results" => $arr);
            }
        }

        if ($sql == "INS" || $sql == "UPD" || $sql == "DEL"){
            if($s){
                return array("success" => true);
            }else{
                try {
                    $r->setFetchMode(PDO::FETCH_ASSOC);
                    $s = $r->execute();
                } catch (PDOException $e) {
                    error_log('PDOException - ' . $e->getMessage(), 0);
                }
            }
            if(!$s) {
                return array("success" => false, "error" => "Error in SQL Response");
            }else{
                return array("success" => true);
            }
        }
    }

    public function Login($user){
        try {
            $query = "SELECT * FROM users WHERE Username = ?";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $st->execute(array($user));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st);
    }

    public function addAdmin($user,$hpass,$salt,$email,$fname,$lname){
        try {
            $query = "INSERT INTO users (Username, Password, Salt, Email, FName, LName, Admin) VALUES (?, ?, ?, ?, ?, ?, 1)";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $s = $st->execute(array($user,$hpass,$salt,$email,$fname,$lname));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st, "INS", $s);
    }

    public function editUser($id,$user,$email,$fname,$lname){
        try {
            $query = "UPDATE users SET Username = ?, Email = ?, FName = ?, LName = ? WHERE UserID = ?";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $s = $st->execute(array($user,$email,$fname,$lname,$id));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st, "UPD", $s);
    }

    public function addReseller($user,$hpass,$salt,$email,$fname,$lname,$package){
        try {
            $query = "INSERT INTO users (Username, Password, Salt, Email, FName, LName, Reseller, ResellerPackageID) VALUES (?, ?, ?, ?, ?, ?, 1, ?)";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $s = $st->execute(array($user,$hpass,$salt,$email,$fname,$lname,$package));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st, "INS", $s);
    }

    public function changeUserPass($id,$hpass,$salt){
        try {
            $query = "UPDATE users SET Password = ?, Salt = ? WHERE UserID = ?";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $s = $st->execute(array($hpass,$salt,$id));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st, "UPD", $s);
    }

    public function addResellerPackage($name,$users,$bandwidth,$diskSpace,$domains,$subDomains,$databases,$ftpAccounts){
        try {
            $query = "INSERT INTO packages_reseller (Name, MaxUsers, MaxBandwidth, MaxDiskUsage, MaxDomains, MaxSubDomains, MaxDatabases, MaxFTPAccounts) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $s = $st->execute(array($name,$users,$bandwidth,$diskSpace,$domains,$subDomains,$databases,$ftpAccounts));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st, "INS", $s);
    }

    public function getUserByID($id){
        try {
            $query = "SELECT * FROM users WHERE UserID = ?";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $st->execute(array($id));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st);
    }

    public function deleteUserByID($id){
        try {
            $query = "DELETE FROM users WHERE UserID = ?";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $s = $st->execute(array($id));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st, "DEL", $s);
    }

    public function getUserDetails($user){
        try {
            $query = "SELECT * FROM users WHERE Username = ?";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $st->execute(array($user));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st);
    }
    
    public function getEmailDetails($email){
        try {
            $query = "SELECT * FROM users WHERE Email = ?";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $st->execute(array($email));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st);
    }
    
    public function getAdmins(){
        try {
            $query = "SELECT a.UserID, a.Username, a.Email, a.FName, a.LName, a.Suspended, a.ResellerID, (SELECT COUNT(*) FROM users b WHERE a.UserID=b.ResellerID) as UserCount FROM users a WHERE Admin = 1 ORDER BY a.UserID ASC";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $st->execute();
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st);
    }
    
    public function getResellers(){
        try {
            $query = "SELECT a.UserID, a.Username, a.Email, a.FName, a.LName, a.Suspended, a.ResellerID, a.ResellerPackageID, (SELECT COUNT(*) FROM users b WHERE a.UserID=b.ResellerID) as UserCount, c.MaxUsers, c.MaxDiskUsage FROM users a INNER JOIN packages_reseller c WHERE a.Reseller = 1 AND a.ResellerPackageID=c.ResellerPackageID ORDER BY a.UserID ASC;";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $st->execute();
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st);
    }
    
    public function getResellerPackages(){
        try {
            $query = "SELECT * FROM packages_reseller";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $st->execute();
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st);
    }

    public function getResellerPackageByID($id){
        try {
            $query = "SELECT * FROM packages_reseller WHERE PackageID = ?";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $st->execute(array($id));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st);
    }

    public function deleteResellerPackageById($id){
        try {
            $query = "DELETE FROM packages_reseller WHERE ResellerPackageID = ?";
            $st = $this->db->prepare($query);
            //$st->bindParam('?', $user);
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $s = $st->execute(array($id));
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
        }
        return $this->checkResponse($st, "DEL", $s);
    }

    public function lastInsertId(){
        $id = $this->db->lastInsertId();
        return $id;
    }

}

?>