<!-- Page Name: demand-classes.php -->
<!-- Description: This page contains a class which creates a new demand and puts it into the database -->

<?php

class Demand extends Dbh {
    //This class is the child of the Dbh class. It uses it's parent to connect to the database. Once connected, this class creates a new user in the database

    protected function setDemand($itemId, $demander) {
        $stmt = $this->connect()->prepare('INSERT INTO demands (iid, demander, state) VALUES (?, ?, "pending");');

        if (!$stmt->execute(array($itemId, $demander))) {
            $stmt = null;
            header("location: ../demander.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}

?>