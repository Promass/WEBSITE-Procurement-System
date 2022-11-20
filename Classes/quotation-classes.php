<!-- Page Name: quotation-classes.php -->
<!-- Description: This page contains a class which creates a new quotation and puts it into the database -->

<?php

class Quotation extends Dbh {
    //This class is the child of the Dbh class. It uses it's parent to connect to the database. Once connected, this class creates a new user in the database

    protected function setQuotation($did, $supplier, $bidPrice) {
        if ($bidPrice > 5000) {
            $stmt = $this->connect()->prepare('INSERT INTO quotations (did, supplier, offer, state) VALUES (?, ?, ?, "waiting");');

            if (!$stmt->execute(array($did, $supplier, $bidPrice))) {
                $stmt = null;
                header("location: ../supplier.php?msg=stmtfailed");
                exit();
            }
    
            $stmt = null;
        }
        else {
            $stmt = $this->connect()->prepare('INSERT INTO quotations (did, supplier, offer, state) VALUES (?, ?, ?, "accepted");');

            if (!$stmt->execute(array($did, $supplier, $bidPrice))) {
                $stmt = null;
                header("location: ../supplier.php?msg=stmtfailed");
                exit();
            }
    
            $stmt = null;
        }
    }

    protected static function setQuotationRejectAll($did) {
        $stmt = self::connect()->prepare("UPDATE quotations SET state = 'rejected' WHERE did = ?;");

        if (!$stmt->execute(array($did))) {
            $stmt = null;
            header("location: ../adm-home.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected static function setQuotationRejectAllExcept($did, $qid) {
        $stmt = self::connect()->prepare("UPDATE quotations SET state = 'rejected' WHERE did = ? AND qid != ?;");

        if (!$stmt->execute(array($did, $qid))) {
            $stmt = null;
            header("location: ../adm-home.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected static function setQuotationAccept($did, $qid) {
        $stmt = self::connect()->prepare("UPDATE quotations SET state = 'accepted' WHERE did = ? AND qid = ?;");

        if (!$stmt->execute(array($did, $qid))) {
            $stmt = null;
            header("location: ../adm-home.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}

?>