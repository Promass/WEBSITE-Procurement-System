<!-- Page Name: delete-inc.php -->
<!-- Description: Once the user clickes "Delete" in any page, this script will run. -->

<?php

session_start();

if(isset($_POST["submit"])) {

    include_once "timeout-inc.php";

    //If user timed out we dont run the script
    if (checkTimeOut()) {
        include_once "../Classes/dbh-classes.php";
        include_once "../Classes/delete-classes.php";
    
        if(isset($_POST["username"])) {
            $username = $_POST["username"];
            Delete::userAccount($username);
        }
    
        if(isset($_POST["item-id"])) {
            $itemId = $_POST["item-id"];
            Delete::item($itemId);
        }
    }
    else {
        header("location: logout-inc.php?reason=sessiontimedout");
    }
    
}

?>