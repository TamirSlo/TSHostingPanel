<?php

class DB
{
    private $db = "";

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

        if ($sql == "INS"){
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

    public function getIDDetails($id){
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

    public function lastInsertId(){
        $id = $this->db->lastInsertId();
        return $id;
    }

}

?>