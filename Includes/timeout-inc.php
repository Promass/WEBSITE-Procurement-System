<!-- Page Name: timeout-inc.php -->
<!-- Description: Contains a function that checks if user timed out or not. -->

<?php

function checkTimeOut() {
    if ((time() - $_SESSION["active-timestamp"]) > $_SESSION["timeout"]) {
        return false;
    }
    else {
        $_SESSION["active-timestamp"] = time();
        return true;
    }
}

?>