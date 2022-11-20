<!-- Page Name: quotation-control-classes.php -->
<!-- Description: This page contains a class which checks the input for any abnormalities -->

<?php

class QuotationController extends Quotation {
    //This class is a child of the Qutation class. It provides the Quotation class with the demand ID, Supplier and Bid price so that a new quotation can be created.

    private $did;
    private $supplier;
    private $bidPrice;

    public function __construct($did, $supplier, $bidPrice) {
        $this->did = $did;
        $this->supplier = $supplier;
        $this->bidPrice = $bidPrice;
    }

    public function createQuotation() {
        if ($this->emptyInput() == false) {
            header("location: ../supplier.php?msg=couldnotoffer");
            exit();
        }

        if ($this->bidPrice > 5000) {
            $this->setQuotation($this->did, $this->supplier, $this->bidPrice);
        }
        else {
            include_once "../Classes/dbh-classes.php";
            include_once "../Classes/demand-classes.php";
            include_once "../Classes/demand-control-classes.php";

            self::rejectAllQuotation($this->did);
            $this->setQuotation($this->did, $this->supplier, $this->bidPrice);
            DemandController::acceptDemand($this->did);
        }
        
    }

    public static function rejectAllQuotation($did) {
        if (!empty($did)) {
            self::setQuotationRejectAll($did);
        }
    }

    private static function rejectAllQuotationExcept($did, $qid) {
        if (!empty($did) && !empty($qid)) {
            self::setQuotationRejectAllExcept($did, $qid);
        }
        else {
            header("location: ../adm-home.php?msg=couldnotacceptoffer");
            exit();
        }
    }

    public static function acceptQuotation($did, $qid) {
        if (!empty($did) && !empty($qid)) {
            self::rejectAllQuotationExcept($did, $qid);
            self::setQuotationAccept($did, $qid);

            include_once "../Classes/dbh-classes.php";
            include_once "../Classes/demand-classes.php";
            include_once "../Classes/demand-control-classes.php";

            DemandController::acceptDemand($did);
        }
        else {
            header("location: ../adm-home.php?msg=couldnotacceptoffer");
            exit();
        }
    }

    private function emptyInput() {
        $result = false;
        if (empty($this->did) || empty($this->supplier) || empty($this->bidPrice)) {
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }
}

?>