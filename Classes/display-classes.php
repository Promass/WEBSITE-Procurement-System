<!-- Page Name: display-classes.php -->
<!-- Description: This page has a class that displays various data present in the database -->

<?php

class Display extends Dbh {

    public static function supplierAccount() {
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

    public static function demanderAccount() {
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

}

?>