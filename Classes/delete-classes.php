<!-- Page Name: delete-classes.php -->
<!-- Description: This page has a class that deletes various data present in the database -->

<?php

class Delete extends Dbh {

    public static function userAccount($username) {
        $stmt = self::connect()->prepare("UPDATE users SET state = 0 WHERE username = ?;");

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header("location: ../adm-accounts.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
        header("location: ../adm-accounts.php?msg=accountdeleted");
    }

    public static function item($itemId) {
        $stmt = self::connect()->prepare("UPDATE items SET availability = 0 WHERE iid = ?;");

        if (!$stmt->execute(array($itemId))) {
            $stmt = null;
            header("location: ../adm-items.php?msg=stmtfailed");
            exit();
        }

        $stmt = null;
        header("location: ../adm-items.php?msg=itemdeleted");
    }

}

?>