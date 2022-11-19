<!-- Page Name: display-classes.php -->
<!-- Description: This page has a class that displays various data present in the database -->

<?php

class Display extends Dbh {

    public static function supplierAccounts() {
        $stmt = self::connect()->prepare("SELECT * FROM users WHERE user_type = 'supplier' AND state = 1;");

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../adm-accounts.php?msg=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo 
            '
                <div class="Adm-account-account-box">
                    <div><span class="Color-blue">Username: </span>'. $data[$idx]["username"] .'</div>
                    <div><span class="Color-blue">Password: </span>'. $data[$idx]["pwd"] .'</div>
                    <form action="Includes/delete-inc.php" method="post">
                        <input type="hidden" name="username" value="'. $data[$idx]["username"] .'">
                        <button class="Adm-account-delete-btn" type="submit" name="submit">Delete Account</button>
                    </form>
                </div>
            ';
        }

        $stmt = null;
    }

    public static function demanderAccounts() {
        $stmt = self::connect()->prepare("SELECT * FROM users WHERE user_type = 'demander' AND state = 1;");

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../adm-accounts.php?msg=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo 
            '
                <div class="Adm-account-account-box">
                    <div><span class="Color-blue">Username: </span>'. $data[$idx]["username"] .'</div>
                    <div><span class="Color-blue">Password: </span>'. $data[$idx]["pwd"] .'</div>
                    <form action="Includes/delete-inc.php" method="post">
                        <input type="hidden" name="username" value="'. $data[$idx]["username"] .'">
                        <button class="Adm-account-delete-btn" type="submit" name="submit">Delete Account</button>
                    </form>
                </div>
            ';
        }

        $stmt = null;
    }

    public static function adminItems() {
        $stmt = self::connect()->prepare("SELECT * FROM items WHERE availability = 1;");

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../adm-items.php?msg=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo 
            '
            <div class="Adm-item-item-box">
                <div><span class="Color-blue">Item ID: </span>'. $data[$idx]["iid"] .'</div>
                <div><span class="Color-blue">Name: </span>'. $data[$idx]["item_name"] .'</div>
                <div><span class="Color-blue">Description: </span>'. $data[$idx]["item_description"] .'</div>
                <form action="Includes/delete-inc.php" method="post">
                    <input type="hidden" name="item-id" value="'. $data[$idx]["iid"] .'">
                    <button class="Adm-item-delete-btn" type="submit" name="submit">Delete Item</button>
                </form>
            </div>
            ';
        }

        $stmt = null;
    }

    public static function demanderItems() {
        $stmt = self::connect()->prepare("SELECT * FROM items WHERE availability = 1;");

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../adm-items.php?msg=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo 
            '
            <div class="Demander-item-box">
                <div><span class="Color-blue">Item ID: </span>'. $data[$idx]["iid"] .'</div>
                <div><span class="Color-blue">Name: </span>'. $data[$idx]["item_name"] .'</div>
                <div><span class="Color-blue">Description: </span>'. $data[$idx]["item_description"] .'</div>
                <form action="Includes/demand-inc.php" method="post">
                    <input type="hidden" name="item-id" value="'. $data[$idx]["iid"] .'">
                    <input type="hidden" name="username" value="'. $_SESSION["username"] .'">
                    <button class="Demander-demand-btn" type="submit" name="submit">Demand</button>
                </form>
            </div>
            ';
        }

        $stmt = null;
    }

    public static function demanderPendingDemands($demander) {
        $stmt = self::connect()->prepare("SELECT D.did, I.item_name FROM demands D, items I WHERE D.demander = ? AND state = 'pending' AND D.iid = I.iid;");

        if (!$stmt->execute(array($demander))) {
            $stmt = null;
            header("location: ../demander.php?msg=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo 
            '
            <div class="Demander-demand-box">
                <div><span class="Color-blue">Demand ID: </span>'. $data[$idx]["did"] .'</div>
                <div><span class="Color-blue">Item: </span>'. $data[$idx]["item_name"] .'</div>
                <div class="Tag-yellow">PENDING</div>
            </div>
            ';
        }

        $stmt = null;
    }

    public static function supplierPendingDemands() {
        $stmt = self::connect()->prepare("SELECT D.did, I.item_name FROM demands D, items I WHERE state = 'pending' AND D.iid = I.iid;");

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../demander.php?msg=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo 
            '
            <div class="Supplier-item-box">
                <div><span class="Color-blue">Demand ID: </span>'. $data[$idx]["did"] .'</div>
                <div><span class="Color-blue">Item: </span>'. $data[$idx]["item_name"] .'</div>
                <form action="Includes/quotation-inc.php" method="post">
                    <div class="Supplier-bid-box">
                        <div class="Supplier-bid-input-box">
                            <button type="button" class="Supplier-bid-minus-btn" onclick="counter(this, \'Supplier-bid-input-' . $data[$idx]["did"] . '\', false)">-</button>
                            <input type="number" name="bid-price" value="1" min="1" class="Supplier-bid-input" id="Supplier-bid-input-' . $data[$idx]["did"] . '">
                            <button type="button" class="Supplier-bid-plus-btn" onclick="counter(this, \'Supplier-bid-input-' . $data[$idx]["did"] . '\', true)">+</button>
                        </div>
                        <input type="hidden" name="supplier" value="'. $_SESSION["username"] .'">
                        <input type="hidden" name="demand-id" value="'. $data[$idx]["did"] .'">
                        <button type="submit" class="Supplier-offer-btn" name="submit" value="supplier-offer">Offer</button>
                    </div>
                </form>
                <div class="Tag-yellow">PENDING</div>
            </div>
            ';
        }

        $stmt = null;
    }

}

?>