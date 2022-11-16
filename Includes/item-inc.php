<!-- Page Name: item-inc.php -->
<!-- Description: Once the admin clickes "Create Item" in the adm-items.php page, this script will run. -->

<?php

if(isset($_POST["submit"])) {
    $itemName = $_POST["item-name"];
    $itemDescription = $_POST["item-description"];

    include "../Classes/dbh-classes.php";
    include "../Classes/item-classes.php";
    include "../Classes/item-control-classes.php";
    $item = new CreateItemController($itemName, $itemDescription);

    //This object will call the lsignupUser function which will initiate the user creation process.
    $item->CreateItem();

    header("location: ../adm-items.php?msg=itemcreated");
}

?>