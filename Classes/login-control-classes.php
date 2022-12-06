<!-- Page Name: login-control-classes.php -->
<!-- Description: This page contains a class which checks the login input for any abnormalities -->

<?php

class LoginController extends Login {
    //This class is a child of the Login class. It provides the login class with the user inputs so that they have access to the webpage.

    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function loginUser() {
        if ($this->emptyInput() == false) {
            header("location: ../index.php?msg=emptyinput");
            exit();
        }

        $this->getUser($this->username, $this->password);
    }

    private function emptyInput() {
        $result = false;
        if (empty($this->username) || empty($this->password)) {
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }
}

?>