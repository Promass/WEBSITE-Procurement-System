<!-- Page Name: logout-inc.php -->
<!-- Description: Once the user click sign out on the sidebar, this script will run -->

<?php 

if (isset($_POST["submit"])) {
    session_start();
    session_unset();
    session_destroy();
    header("location: ../index.php?signout=success");
}


if (isset($_GET["submit"])) {
    session_start();
    session_unset();
    session_destroy();
    header("location: ../index.php?unauthorized");
}

?>