<?php

    class users {
        private $id;
        private $name;
        private $email;
        private $pwd;
        private $pwd2;
        private $loginStatus;
        private $lastLogin;
        private $dbConn;

        //GETTER JA SETTER FUNKTIOT

        function setId($id) { $this->id = $id; }
        function getId() { return $this->id; }

        function setName($name) { $this->name = ucfirst($name); }
        function getName(){ return $this->name; }

        function setEmail($email){ $this->email = $email; }
        function getEmail(){ return $this->email; }

        function setpwd($pwd){ $this->pwd = $pwd; }
        function getpwd(){ return $this->pwd; }

        function setpwd2($pwd2){ $this->pwd2 = $pwd2; }
        function getpwd2(){ return $this->pwd2; }
    
        function setLoginStatus($loginStatus){ $this->loginStatus = $loginStatus; }
        function getLoginStatus(){ return $this->loginStatus; }

        function setLastLogin($lastLogin){ $this->lastLogin = $lastLogin; }
        function getLastLogin(){ return $this->lastLogin; }


        public function __construct() {
            require_once("database.php");
            $db = new DbConnect();
            $this->dbConn = $db->connect();
        }

        public function save() { 
            $sql = "INSERT INTO `users` (`name`, `email`, `password`, `login_status`, 
            `last_login`) VALUES (:name, :email, :password, :loginStatus, :lastLogin)";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->pwd);
            $stmt->bindParam(":loginStatus", $this->loginStatus);
            $stmt->bindParam(":lastLogin", $this->lastLogin);
            try {
                if($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e ->getMessage();
            }
        }

    }
    

?>