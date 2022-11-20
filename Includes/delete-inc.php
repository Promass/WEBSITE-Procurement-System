<!-- Page Name: delete-inc.php -->
<!-- Description: Once the user clickes "Delete" in any page, this script will run. -->

<?php

if(isset($_POST["submit"])) {

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

?>