<!-- Page Name: signup-classes.php -->
<!-- Description: This page contains a class which creates a new user and puts it into the database (if the username does not already exist) -->

<?php

class Signup extends Dbh {
    //This class is the child of the Dbh class. It uses it's parent to connect to the database. Once connected, this class creates a new user in the database
    
    protected function userExistance($username) {
        $stmt = $this->connect()->prepare('SELECT pwd FROM users WHERE username = ?;');

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header("location: ../adm-accounts.php?msg=stmtfailed");
            exit();
        }

        $userExist = false;
        if ($stmt->rowCount() > 0) {
            $userExist = true;
        }

        return $userExist;
    }

    protected function setUser($username, $password, $type) {
        $stmt = $this->connect()->prepare('INSERT INTO users (username, pwd, user_type) VALUES (?, ?, ?);');

        if (!$stmt->execute(array($username, $password, $type))) {
            $stmt = null;
            header("location: ../adm-accounts.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}

?>