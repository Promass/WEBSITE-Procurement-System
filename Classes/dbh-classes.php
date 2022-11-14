<!-- Page Name: dbh-classes.php -->
<!-- Description: This page has a class that connects to the server database. It throws an exception if it does not connect to the database -->

<?php

class Dbh {
    //This class is used as a parent class so that other children class can use this connection to query data from the database.
    protected static function connect() {
        try {

            $dbusername = "root";
            $dbpassword = "";
            $dbname = "nvke_procurement_system";

            $dbh = new PDO('mysql:host=localhost;dbname='.$dbname, $dbusername, $dbpassword);
            return $dbh;
        }
        catch (PDOException $err) {
            print "Error!: " . $err->getMessage() . "<br/>";
            die();
        }
    }
}

?>