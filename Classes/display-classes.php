<!-- Page Name: display-classes.php -->
<!-- Description: This page has a class that displays various data present in the database -->

<?php

class Display extends Dbh
{

    public static function supplierAccounts()
    {
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
                    <div><span class="Color-blue">Username: </span>' . $data[$idx]["username"] . '</div>
                    <div><span class="Color-blue">Password: </span>' . $data[$idx]["pwd"] . '</div>
                    <form action="Includes/delete-inc.php" method="post">
                        <input type="hidden" name="username" value="' . $data[$idx]["username"] . '">
                        <button class="Adm-account-delete-btn" type="submit" name="submit">Delete Account</button>
                    </form>
                </div>
            ';
        }

        $stmt = null;
    }

    public static function demanderAccounts()
    {
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
                    <div><span class="Color-blue">Username: </span>' . $data[$idx]["username"] . '</div>
                    <div><span class="Color-blue">Password: </span>' . $data[$idx]["pwd"] . '</div>
                    <form action="Includes/delete-inc.php" method="post">
                        <input type="hidden" name="username" value="' . $data[$idx]["username"] . '">
                        <button class="Adm-account-delete-btn" type="submit" name="submit">Delete Account</button>
                    </form>
                </div>
            ';
        }

        $stmt = null;
    }

    public static function adminItems()
    {
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
                <div><span class="Color-blue">Item ID: </span>' . $data[$idx]["iid"] . '</div>
                <div><span class="Color-blue">Name: </span>' . $data[$idx]["item_name"] . '</div>
                <div><span class="Color-blue">Description: </span>' . $data[$idx]["item_description"] . '</div>
                <form action="Includes/delete-inc.php" method="post">
                    <input type="hidden" name="item-id" value="' . $data[$idx]["iid"] . '">
                    <button class="Adm-item-delete-btn" type="submit" name="submit">Delete Item</button>
                </form>
            </div>
            ';
        }

        $stmt = null;
    }

    public static function demanderItems()
    {
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
                <div><span class="Color-blue">Item ID: </span>' . $data[$idx]["iid"] . '</div>
                <div><span class="Color-blue">Name: </span>' . $data[$idx]["item_name"] . '</div>
                <div><span class="Color-blue">Description: </span>' . $data[$idx]["item_description"] . '</div>
                <form action="Includes/demand-inc.php" method="post">
                    <input type="hidden" name="item-id" value="' . $data[$idx]["iid"] . '">
                    <input type="hidden" name="username" value="' . $_SESSION["username"] . '">
                    <button class="Demander-demand-btn" type="submit" name="submit" value="create-demand">Demand</button>
                </form>
            </div>
            ';
        }

        $stmt = null;
    }

    public static function demanderPendingDemands($demander)
    {
        $stmt = self::connect()->prepare("SELECT D.did, I.item_name FROM demands D, items I WHERE D.demander = ? AND D.state = 'pending' AND D.iid = I.iid;");

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
                <div><span class="Color-blue">Demand ID: </span>' . $data[$idx]["did"] . '</div>
                <div><span class="Color-blue">Item: </span>' . $data[$idx]["item_name"] . '</div>
                <div class="Tag-yellow">PENDING</div>
            </div>
            ';
        }

        $stmt = null;
    }

    public static function supplierPendingDemands($username)
    {
        $stmt = self::connect()->prepare("SELECT D.did, I.item_name FROM demands D, items I WHERE D.state = 'pending' AND D.iid = I.iid AND D.did NOT IN (SELECT did FROM quotations WHERE supplier = ?);");

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header("location: ../supplier.php?msg=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo
            '
            <div class="Supplier-item-box">
                <div><span class="Color-blue">Demand ID: </span>' . $data[$idx]["did"] . '</div>
                <div><span class="Color-blue">Item: </span>' . $data[$idx]["item_name"] . '</div>
                <form action="Includes/quotation-inc.php" method="post">
                    <div class="Supplier-bid-box">
                        <div class="Supplier-bid-input-box">
                            <button type="button" class="Supplier-bid-minus-btn" onclick="counter(this, \'Supplier-bid-input-' . $data[$idx]["did"] . '\', false)">-</button>
                            <input type="number" name="bid-price" value="1" min="1" class="Supplier-bid-input" id="Supplier-bid-input-' . $data[$idx]["did"] . '">
                            <button type="button" class="Supplier-bid-plus-btn" onclick="counter(this, \'Supplier-bid-input-' . $data[$idx]["did"] . '\', true)">+</button>
                        </div>
                        <input type="hidden" name="username" value="' . $_SESSION["username"] . '">
                        <input type="hidden" name="demand-id" value="' . $data[$idx]["did"] . '">
                        <button type="submit" class="Supplier-offer-btn" name="submit" value="supplier-offer">Offer</button>
                    </div>
                </form>
                <div class="Tag-yellow">PENDING</div>
            </div>
            ';
        }

        $stmt = null;
    }

    public static function supplierQuotationsAwaitingApproval($username)
    {
        $stmt = self::connect()->prepare('SELECT Q.qid, D.did, I.item_name, Q.offer FROM items I, demands D, quotations Q WHERE Q.supplier = ? AND Q.state = "waiting" AND Q.did = D.did AND D.iid = I.iid;');

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header("location: ../supplier.php?msg=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo
            '
            <div class="Supplier-item-box">
                <div><span class="Color-blue">Quotation ID: </span>' . $data[$idx]["qid"] . '</div>
                <div><span class="Color-blue">Demand ID: </span>' . $data[$idx]["did"] . '</div>
                <div><span class="Color-blue">Item: </span>' . $data[$idx]["item_name"] . '</div>
                <div><span class="Color-blue">Bid Price: </span>' . $data[$idx]["offer"] . '$</div>
                <div class="Tag-gray">WAITING</div>
            </div>
            ';
        }

        $stmt = null;
    }

    public static function adminPendingDemands()
    {
    $stmt = self::connect()->prepare("SELECT D.did, I.item_name FROM demands D, items I WHERE D.state = 'pending' AND I.iid = D.iid AND 1 < (SELECT COUNT(Q.qid) FROM quotations Q WHERE Q.state = 'waiting' AND Q.did = D.did);");

    if (!$stmt->execute()) {
        $stmt = null;
        header("location: ../adm-home.php?msg=stmtfailed");
        exit();
    }

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
        echo
        '
        <form action="adm-home.php" method="post">
            <button class="Adm-Home-demand-box" type="submit" name="demand-id" value="'. $data[$idx]["did"] .'">
                <div><span class="Color-blue">Demand ID: </span>' . $data[$idx]["did"] . '</div>
                <div><span class="Color-blue">Item: </span>' . $data[$idx]["item_name"] . '</div>
                <div class="Tag-yellow">PENDING</div>
            </button>
        </form>
        ';
    }

    $stmt = null;
    }

    public static function adminQuotationsAwaitingApproval($did)
    {
        $stmt = self::connect()->prepare('SELECT qid, supplier, offer FROM quotations WHERE did = ?;');

        if (!$stmt->execute(array($did))) {
            $stmt = null;
            header("location: ../adm-home.php?msg=stmtfailed");
            exit();
        }

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo
            '
            <div class="Adm-Home-demand-quotation-box">
                <div><span class="Color-blue">Quotation ID: </span>' . $data[$idx]["qid"] . '</div>
                <div><span class="Color-blue">Supplier: </span>' . $data[$idx]["supplier"] . '</div>
                <div><span class="Color-blue">Bid Price: </span>' . $data[$idx]["offer"] . '$</div>
                <form action="Includes/quotation-inc.php" method="post">
                    <input type="hidden" name="demand-id" value="' . $did . '">
                    <input type="hidden" name="quotation-id" value="' . $data[$idx]["qid"] . '">
                    <button class="Adm-Home-accept-quotation-btn" type="submit" name="submit" value="admin-accept">Accept</button>
                </form>
            </div>
            ';
        }

        $stmt = null;
    }

    public static function adminDemandSummary($did)
    {
        if (!empty($did)) {
            $stmt = self::connect()->prepare('SELECT D.demander, I.item_name, I.item_description FROM demands D, items I WHERE D.did = ? AND D.iid = I.iid;');

            if (!$stmt->execute(array($did))) {
                $stmt = null;
                header("location: ../adm-home.php?msg=stmtfailed");
                exit();
            }
    
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
                echo
                '
                <div class="Bottom-border">Demand ID: <span>'. $did .'</span></div>
                <div class="Adm-Home-demand-summary-list-box">
                    <div class="Adm-Home-demand-info">
                        <div><span class="Color-blue">Demander: </span>'. $data[$idx]["demander"] .'</div>
                        <div><span class="Color-blue">Item: </span>'. $data[$idx]["item_name"] .'</div>
                        <div><span class="Color-blue">Description: </span>'. $data[$idx]["item_description"] .'</div>
                        <form action="Includes/demand-inc.php" method="post">
                            <input type="hidden" name="demand-id" value="' . $did . '">
                            <button class="Adm-Home-reject-demand-btn" type="submit" name="submit" value="reject-demand">Reject Demand</button>
                        </form>
                    </div>
                    <div class="Adm-Home-demand-quotation">
                ';
                Display::adminQuotationsAwaitingApproval($did);
                echo
                '
                    </div>
                </div>
                ';
            }
    
            $stmt = null;
        }
        else {
            echo
            '
            <div class="Bottom-border">Pick A Demand From Pending Demands</div>
            ';
        }

    }

    public static function adminPreviousDemands()
    {
    $stmt = self::connect()->prepare("SELECT D.did, D.demander, I.item_name, D.state FROM demands D, items I WHERE (D.state = 'accepted' OR D.state = 'rejected') AND I.iid = D.iid;");

    if (!$stmt->execute()) {
        $stmt = null;
        header("location: ../adm-history.php?msg=stmtfailed");
        exit();
    }

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
        echo
        '
        <div class="Adm-history-box">
            <div><span class="Color-blue">Demand ID: </span>'. $data[$idx]["did"] .'</div>
            <div><span class="Color-blue">Demander: </span>'. $data[$idx]["demander"] .'</div>
            <div><span class="Color-blue">Item: </span>'. $data[$idx]["item_name"] .'</div>
        ';
            if ($data[$idx]["state"] == "accepted") {
                echo '<div class="Tag-green">ACCEPTED</div>';
            }
            else if ($data[$idx]["state"] == "rejected") {
                echo '<div class="Tag-red">REJECTED</div>';
            }
        echo
        '
        </div>
        ';
    }

    $stmt = null;
    }

    public static function adminPreviousQuotations()
    {
        $stmt = self::connect()->prepare("SELECT Q.qid, Q.supplier, Q.did, I.item_name, Q.offer, Q.state FROM quotations Q, items I, demands D WHERE (Q.state = 'rejected' OR Q.state = 'accepted') AND Q.did = D.did AND D.iid = I.iid;");

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../adm-history.php?msg=stmtfailed");
            exit();
        }
    
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo
            '
            <div class="Adm-history-box">
                <div><span class="Color-blue">Quotation ID: </span>'. $data[$idx]["qid"] .'</div>
                <div><span class="Color-blue">Supplier: </span>'. $data[$idx]["supplier"] .'</div>
                <div><span class="Color-blue">Demand ID: </span>'. $data[$idx]["did"] .'</div>
                <div><span class="Color-blue">Item: </span>'. $data[$idx]["item_name"] .'</div>
                <div><span class="Color-blue">Bid Price: </span>'. $data[$idx]["offer"] .'$</div>
            ';
                if ($data[$idx]["state"] == "accepted") {
                    echo '<div class="Tag-green">ACCEPTED</div>';
                }
                else if ($data[$idx]["state"] == "rejected") {
                    echo '<div class="Tag-red">REJECTED</div>';
                }
            echo
            '
            </div>
            ';
        }
    
        $stmt = null;
    }

    public static function demanderPreviousDemands($demander)
    {
        $stmt = self::connect()->prepare("SELECT D.did, I.item_name, D.state FROM demands D, items I WHERE (D.state = 'accepted' OR D.state = 'rejected') AND D.demander = ? AND I.iid = D.iid;");

        if (!$stmt->execute(array($demander))) {
            $stmt = null;
            header("location: ../adm-history.php?msg=stmtfailed");
            exit();
        }
    
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo
            '
            <div class="Demander-demand-box">
                <div><span class="Color-blue">Demand ID: </span>'. $data[$idx]["did"] .'</div>
                <div><span class="Color-blue">Item: </span>'. $data[$idx]["item_name"] .'</div>
            ';
                if ($data[$idx]["state"] == "accepted") {
                    echo '<div class="Tag-green">ACCEPTED</div>';
                }
                else if ($data[$idx]["state"] == "rejected") {
                    echo '<div class="Tag-red">REJECTED</div>';
                }
            echo
            '
            </div>
            ';
        }
    
        $stmt = null;
    }

    public static function supplierPreviousQuotations($supplier)
    {
        $stmt = self::connect()->prepare("SELECT Q.qid, Q.did, I.item_name, Q.offer, Q.state FROM quotations Q, items I, demands D WHERE (Q.state = 'rejected' OR Q.state = 'accepted') AND Q.supplier = ? AND Q.did = D.did AND D.iid = I.iid;");

        if (!$stmt->execute(array($supplier))) {
            $stmt = null;
            header("location: ../adm-history.php?msg=stmtfailed");
            exit();
        }
    
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        for ($idx = 0; $idx < $stmt->rowCount(); $idx++) {
            echo
            '
            <div class="Supplier-item-box">
                <div><span class="Color-blue">Quotation ID: </span>'. $data[$idx]["qid"] .'</div>
                <div><span class="Color-blue">Demand ID: </span>'. $data[$idx]["did"] .'</div>
                <div><span class="Color-blue">Item: </span>'. $data[$idx]["item_name"] .'</div>
                <div><span class="Color-blue">Bid Price: </span>'. $data[$idx]["offer"] .'$</div>
            ';
                if ($data[$idx]["state"] == "accepted") {
                    echo '<div class="Tag-green">ACCEPTED</div>';
                }
                else if ($data[$idx]["state"] == "rejected") {
                    echo '<div class="Tag-red">REJECTED</div>';
                }
            echo
            '
            </div>
            ';
        }
    
        $stmt = null;
    }

}

?>