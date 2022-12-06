<!-- Page Name: demand-classes.php -->
<!-- Description: This page contains a class which creates a new demand and puts it into the database. It also contains the functionality to reject demands and accept demands. -->

<?php

class Demand extends Dbh {
    //This class is the child of the Dbh class. It uses it's parent to connect to the database.

    protected function setDemandCreate($itemId, $demander) {
        $stmt = $this->connect()->prepare('INSERT INTO demands (iid, demander, state) VALUES (?, ?, "pending");');

        if (!$stmt->execute(array($itemId, $demander))) {
            $stmt = null;
            header("location: ../demander.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected static function setDemandReject($did) {
        include_once "../Classes/dbh-classes.php";
        include_once "../Classes/quotation-classes.php";
        include_once "../Classes/quotation-control-classes.php";

        QuotationController::rejectAllQuotation($did);

        $stmt = self::connect()->prepare("UPDATE demands SET state = 'rejected' WHERE did = ?;");

        if (!$stmt->execute(array($did))) {
            $stmt = null;
            header("location: ../adm-home.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected static function setDemandAccept($did) {
        $stmt = self::connect()->prepare("UPDATE demands SET state = 'accepted' WHERE did = ?;");

        if (!$stmt->execute(array($did))) {
            $stmt = null;
            header("location: ../adm-home.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}

?>