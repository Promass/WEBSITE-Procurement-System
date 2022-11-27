<!-- Page Name: logout-inc.php -->
<!-- Description: Once the user click sign out on the sidebar, this script will run -->

<?php 

if (isset($_POST["submit"])) {
    session_start();
    session_unset();
    session_destroy();
    header("location: ../index.php?msg=signedout");
}


if (isset($_GET["reason"])) {
    session_start();
    session_unset();
    session_destroy();

    if ($_GET["reason"] == "unauthorised") {
        header("location: ../index.php?msg=unauthorised");
    }
    else if ($_GET["reason"] == "sessiontimedout") {
        header("location: ../index.php?msg=sessiontimedout");
    }
    else {
        header("location: ../index.php");
    }
}

?>