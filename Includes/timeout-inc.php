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