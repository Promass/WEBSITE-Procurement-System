<!-- Page Name: demand-inc.php -->
<!-- Description: Once the user clickes "Demand" in the demander.php page, this script will run. -->

<?php

if(isset($_POST["submit"])) {
    $itemId = $_POST["item-id"];
    $username = $_POST["username"];

    include "../Classes/dbh-classes.php";
    include "../Classes/demand-classes.php";
    include "../Classes/demand-control-classes.php";
    $demand = new DemandController($itemId, $username);

    //This object will call the createDemand function which will initiate the demand creation process.
    $demand->createDemand();

    header("location: ../demander.php?msg=itemdemanded");
}

?>