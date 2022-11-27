<!-- Page Name: quotation-inc.php -->
<!-- Description: Once the supplier clickes "Offer" in the supplier.php page, this script will run. -->

<?php

session_start();

if(isset($_POST["submit"])) {

    include_once "timeout-inc.php";

    if (checkTimeOut()) {
        include_once "../Classes/dbh-classes.php";
        include_once "../Classes/quotation-classes.php";
        include_once "../Classes/quotation-control-classes.php";
        
        if($_POST["submit"] == "supplier-offer") {
            $did = $_POST["demand-id"];
            $username = $_POST["username"];
            $bidPrice = $_POST["bid-price"];
    
            $quotation = new QuotationController($did, $username, $bidPrice);
        
            //This object will call the createQuotation function which will initiate the quotation creation process.
            $quotation->createQuotation();
        
            header("location: ../supplier.php?msg=offersent");
        }
        else if($_POST["submit"] == "admin-accept") {
            $did = $_POST["demand-id"];
            $qid = $_POST["quotation-id"];
    
            QuotationController::acceptQuotation($did, $qid);
    
            header("location: ../adm-home.php?msg=offeraccepted");
        }
    }
    else {
        header("location: logout-inc.php?reason=sessiontimedout");
    }

}

?>