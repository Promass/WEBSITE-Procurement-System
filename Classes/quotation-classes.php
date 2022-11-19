<!-- Page Name: quotation-classes.php -->
<!-- Description: This page contains a class which creates a new quotation and puts it into the database -->

<?php

class Quotation extends Dbh {
    //This class is the child of the Dbh class. It uses it's parent to connect to the database. Once connected, this class creates a new user in the database

    protected function setQuotation($did, $supplier, $bidPrice) {
        $stmt = $this->connect()->prepare('INSERT INTO quotations (did, supplier, offer, state) VALUES (?, ?, ?, "waiting");');

        if (!$stmt->execute(array($did, $supplier, $bidPrice))) {
            $stmt = null;
            header("location: ../supplier.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}

?>