<!-- Page Name: quotation-inc.php -->
<!-- Description: Once the supplier clickes "Offer" in the supplier.php page, this script will run. -->

<?php

if(isset($_POST["submit"])) {
    
    if($_POST["submit"] == "supplier-offer") {
        $did = $_POST["demand-id"];
        $username = $_POST["username"];
        $bidPrice = $_POST["bid-price"];

        include "../Classes/dbh-classes.php";
        include "../Classes/quotation-classes.php";
        include "../Classes/quotation-control-classes.php";
        $quotation = new QuotationController($did, $username, $bidPrice);
    
        //This object will call the createQuotation function which will initiate the quotation creation process.
        $quotation->createQuotation();
    
        header("location: ../supplier.php?msg=offersent");
    }

}

?>