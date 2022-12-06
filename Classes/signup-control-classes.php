<!-- Page Name: signup-control-classes.php -->
<!-- Description: This page contains a class which checks the signup input for any abnormalities -->

<?php

class SignupController extends Signup {
    //This class is a child of the Signup class. It provides the login class with the user inputs so that they have access to the webpage.

    private $username;
    private $password;
    private $type;

    public function __construct($username, $password, $type) {
        $this->username = $username;
        $this->password = $password;
        $this->type = $type;
    }

    public function signupUser() {
        if ($this->emptyInput() == false) {
            header("location: ../adm-accounts.php?msg=emptyinput");
            exit();
        }

        if ($this->usernameTaken() == true) {
            header("location: ../adm-accounts.php?msg=useralreadyexist");
            exit();
        }

        $this->setUser($this->username, $this->password, $this->type);
    }

    private function emptyInput() {
        $result = false;
        if (empty($this->username) || empty($this->password) || empty($this->type)) {
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }

    private function usernameTaken() {
        $result = false;
        if ($this->userExistance($this->username)) {
            $result = true;
        }
        else {
            $result = false;
        }

        return $result;
    }
}

?>