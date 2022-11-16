<!-- Page Name: item-classes.php -->
<!-- Description: This page contains a class which creates a new item and puts it into the database (if the item does not already exist) -->

<?php

class CreateItem extends Dbh {
    //This class is the child of the Dbh class. It uses it's parent to connect to the database. Once connected, this class creates a new user in the database
    
    protected function itemExistance($itemName) {
        $stmt = $this->connect()->prepare('SELECT * FROM items WHERE item_name = ?;');

        if (!$stmt->execute(array($itemName))) {
            $stmt = null;
            header("location: ../adm-items.php?msg=stmtfailed");
            exit();
        }

        $itemExist = false;
        if ($stmt->rowCount() > 0) {
            $itemExist = true;
        }

        return $itemExist;
    }

    protected function setItem($itemName, $itemDescription) {
        $stmt = $this->connect()->prepare('INSERT INTO items (item_name, item_description, availability) VALUES (?, ?, 1);');

        if (!$stmt->execute(array($itemName, $itemDescription))) {
            $stmt = null;
            header("location: ../adm-items.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}

?>