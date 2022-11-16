<!-- Page Name: item-control-classes.php -->
<!-- Description: This page contains a class which checks the input for any abnormalities -->

<?php

class CreateItemController extends CreateItem {
    //This class is a child of the CreateItem class. It provides the CreateItem class with the information to create and item and put it in the database.

    private $itemName;
    private $itemDescription;

    public function __construct($itemName, $itemDescription) {
        $this->itemName = $itemName;
        $this->itemDescription = $itemDescription;
    }

    public function CreateItem() {
        if ($this->emptyInput() == false) {
            header("location: ../adm-items.php?msg=emptyinput");
            exit();
        }

        if ($this->itemnameTaken() == true) {
            header("location: ../adm-accounts.php?msg=itemalreadyexist");
            exit();
        }

        $this->setItem($this->itemName, $this->itemDescription);
    }

    private function emptyInput() {
        $result = false;
        if (empty($this->itemName) || empty($this->itemDescription)) {
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }

    private function itemnameTaken() {
        $result = false;
        if ($this->itemExistance($this->itemName)) {
            $result = true;
        }
        else {
            $result = false;
        }

        return $result;
    }
}

?>