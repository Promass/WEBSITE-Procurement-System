<!-- Page Name: delete-inc.php -->
<!-- Description: Once the user clickes "Delete Account" in the adm-accounts.php page, this script will run. -->

<?php

if(isset($_POST["submit"]) && isset($_POST["username"])) {
    $username = $_POST["username"];

    include "../Classes/dbh-classes.php";
    include "../Classes/delete-classes.php";

    Delete::userAccount($username);

}

?>