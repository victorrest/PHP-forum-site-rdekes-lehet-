<?php

class Signup extends Dbh {

    protected function setUser($name, $email, $pwd) {
        $stmt = $this->connect()->prepare('INSERT INTO users (name, email, password, login_status, last_login) 
        VALUES (?, ?, ?, ?, ?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        

        if(!$stmt->execute(array($name, $email, $hashedPwd, 1, date('Y-m-d h:i:s'))))  {
            $stmt = null;
            header("location: index.php?error=stmtfailed");
            exit();
        } 
  
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE name = ?;');
        $stmt->bindParam('?', $name);
        $stmt->execute(array($name));
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["userid"] = $user[0]["user_id"];
        $_SESSION["name"] = $user[0]["name"];
        $_SESSION["login"] = $user[0]["login_status"];
        $_SESSION["email"] = $user[0]["email"];
        $stmt = null;
    }


    protected function checkUser($name) {
        $stmt = $this->connect()->prepare('SELECT name FROM users WHERE name = ?;');

        if(!$stmt->execute(array($name)))  {
            $stmt = null;
            header("location: index.php?error=stmtfailed");
            exit();
        }     

        $resultCheck = 0;
        if($stmt->rowCount() > 0) {
            $resultCheck = false;
        }else {
            $resultCheck = true;
        }
        return $resultCheck;
    }

    protected function checkEmail($email) {
        $stmt = $this->connect()->prepare('SELECT email FROM users WHERE email = ?;');

        if(!$stmt->execute(array($email)))  {
            $stmt = null;
            header("location: index.php?error=stmtfailed");
            exit();
        }     

        $resultCheck = 0;
        if($stmt->rowCount() > 0) {
            $resultCheck = false;
        }else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}

?>