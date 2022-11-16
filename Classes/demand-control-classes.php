<!-- Page Name: demand-control-classes.php -->
<!-- Description: This page contains a class which checks the input for any abnormalities -->

<?php

class DemandController extends Demand {
    //This class is a child of the CreateDEmand class. It provides the Demand class with the item and demander so that a new demand can be created.

    private $itemId;
    private $demander;

    public function __construct($itemId, $demander) {
        $this->itemId = $itemId;
        $this->demander = $demander;
    }

    public function createDemand() {
        if ($this->emptyInput() == false) {
            header("location: ../demander.php?msg=couldnotdemand");
            exit();
        }

        $this->setDemand($this->itemId, $this->demander);
    }

    private function emptyInput() {
        $result = false;
        if (empty($this->itemId) || empty($this->demander)) {
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }
}

?>