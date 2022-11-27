<!-- Page Name: login-classes.php -->
<!-- Description: This page contains a class that checks if the username and password provided exists and matches one in the database. -->

<?php

class Login extends Dbh {
    //This class is the child of the Dbh class. It uses it's parent to connect to the database. Once connected, this class matches the user given password with the password present in the database. If they match, the user is taken to their specific pages. If it does not match the user stays at the login screen.

    protected function getUser($username, $password) {
        $stmt = $this->connect()->prepare('SELECT pwd FROM users WHERE username = ? AND state = 1;');

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header("location: ../index.php?msg=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?msg=usernotfound");
            exit();
        }

        $pwd = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($password == $pwd[0]["pwd"]) {
            $nextstmt = $this->connect()->prepare('SELECT * FROM users WHERE username = ? AND pwd = ? AND state = 1;');

            if (!$nextstmt->execute(array($username, $password))) {
                $nextstmt = null;
                header("location: ../index.php?msg=stmtfailed");
                exit();
            }
    
            if ($nextstmt->rowCount() == 0) {
                $nextstmt = null;
                header("location: ../index.php?msg=usernotfound");
                exit();
            }

            $curruser = $nextstmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["username"] = $curruser[0]["username"];
            $_SESSION["usertype"] = $curruser[0]["user_type"];
            $_SESSION["active-timestamp"] = time();
            $_SESSION["timeout"] = 1800; //This determines the time (seconds) any user can stay logged in without activity

            if($_SESSION["usertype"] == "admin") {
                header("location: ../adm-home.php");
            }
            else if ($_SESSION["usertype"] == "demander") {
                header("location: ../demander.php");
            }
            else if ($_SESSION["usertype"] == "supplier") {
                header("location: ../supplier.php");
            }
            else {
                header("location: ../index.php?invalidtype");
            }
        }
        else {
            header("location: ../index.php?msg=wrongpassword");
            exit();
        }
    }
}

?>