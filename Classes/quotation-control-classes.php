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

        $this->setQuotation($this->did, $this->supplier, $this->bidPrice);
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