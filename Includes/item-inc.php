<!-- Page Name: item-inc.php -->
<!-- Description: Once the admin clickes "Create Item" in the adm-items.php page, this script will run. -->

<?php

session_start();

if(isset($_POST["submit"])) {

    include_once "timeout-inc.php";

    //If user timed out we dont run the script
    if (checkTimeOut()) {
        $itemName = $_POST["item-name"];
        $itemDescription = $_POST["item-description"];
    
        include_once "../Classes/dbh-classes.php";
        include_once "../Classes/item-classes.php";
        include_once "../Classes/item-control-classes.php";
        $item = new CreateItemController($itemName, $itemDescription);
    
        //This object will call the lsignupUser function which will initiate the user creation process.
        $item->CreateItem();
    
        header("location: ../adm-items.php?msg=itemcreated");
    }
    else {
        header("location: logout-inc.php?reason=sessiontimedout");
    }

}

?>