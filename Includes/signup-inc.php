<!-- Page Name: signup-inc.php -->
<!-- Description: Once the admin clickes "Create Account" in the adm-accounts.php page, this script will run. -->

<?php

session_start();

if(isset($_POST["submit"])) {

    include_once "timeout-inc.php";

    //If user timed out we dont run the script
    if (checkTimeOut()) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $type = "";
    
        if ($_POST["type"] == "Supplier") {
            $type = "supplier";
        }
        else if ($_POST["type"] == "Demander") {
            $type = "demander";
        }
        else {
            header("location: ../adm-accounts.php?msg=invalidtype");
        }
    
        include_once "../Classes/dbh-classes.php";
        include_once "../Classes/signup-classes.php";
        include_once "../Classes/signup-control-classes.php";
        $signup = new SignupController($username, $password, $type);
    
        //This object will call the lsignupUser function which will initiate the user creation process.
        $signup->signupUser();
    
        header("location: ../adm-accounts.php?msg=usercreated");
    }
    else {
        header("location: logout-inc.php?reason=sessiontimedout");
    }

}

?>