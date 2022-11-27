<!-- Page Name: demander.php -->
<!-- Description: User interface for demander account type -->

<?php
include_once "Classes/dbh-classes.php";
include_once "Classes/display-classes.php";

session_start();

//This if statement makes sure that only demanders have access to this page
if (!isset($_SESSION["username"])) {
    header("location: index.php?msg=unauthorised");
} else {
    if (isset($_SESSION["usertype"])) {
        if ($_SESSION["usertype"] != "demander") {
            header("location: Includes/logout-inc.php?reason=unauthorised");
        }

        include_once "Includes/timeout-inc.php";

        if (!checkTimeOut()) {
            header("location: Includes/logout-inc.php?reason=sessiontimedout");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <title> Demander - Home </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="demander.css" rel="stylesheet">
    <link href="adm-sidebar.css" rel="stylesheet">
</head>

<!-- The function dynamicSidebarMenu('text') adds style to the sidebar menu -->
<body style="background: #151515; height: 100%; color: white; overflow: hidden; display: flex;" onload="dynamicSidebarMenu('Home')">

    <!-- Left Sidebar Menu -->
    <div class="Adm-sidebar-box">
        <div class="Adm-sidebar-logo-box">
            <img src="Image/logo.png" alt="NVKE Logo" height="150" width="150" style="text-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        </div>
        <div class="Adm-sidebar-menu-box">
            <ul style="padding: 0px; margin: 0px; list-style: none;">
                <li class="Adm-sidebar-menu-li">
                    <a class="dynamicSidebarMenu" href="demander.php">Home</a>
                </li>
            </ul>
        </div>
        <div class="Adm-sidebar-signout-box">
            <form action="Includes/logout-inc.php" method="post">
                <button type="submit" name="submit" class="Adm-sidebar-signout-btn">Sign Out</button>
            </form>
        </div>
    </div>
    <!-- Left Sidebar Menu -->

    <div class="Adm-main-box">
        
        <!-- Top user info box -->
        <div class="Adm-sidebar-navbox">
            <div class="Adm-sidebar-navbox-userinfo">
                <span><?php echo $_SESSION["username"]; ?></span>
                <span class="Color-blue">&VerticalSeparator;</span>
                <span class="Color-blue">DEMANDER</span>
            </div>
        </div>
        <!-- Top user info box -->

        <!-- Main Content -->
        <div class="Adm-content-box">
            <div style="display: flex;">
                <div class="Demander-child-box">

                    <!-- Previous Demands -->
                    <div class="Demander-pending-demand-box" style="margin-bottom: 20px;">
                        <div class="Bottom-border">Previous Demands</div>
                        <div class="Demander-pending-demand-list-box">
                            <?php
                                Display::demanderpreviousDemands($_SESSION["username"]);
                            ?>
                        </div>
                    </div>
                    <!-- Previous Demands -->

                    <!-- Pending Demands -->
                    <div class="Demander-pending-demand-box">
                        <div class="Bottom-border">Pending Demands</div>
                        <div class="Demander-pending-demand-list-box">
                            <?php
                                Display::demanderPendingDemands($_SESSION["username"]);
                            ?>
                        </div>
                    </div>
                    <!-- Pending Demands -->

                </div>

                <!-- Inventory -->
                <div class="Demander-inventory-box">
                    <div class="Bottom-border">Inventory</div>
                    <div class="Demander-item-list-box">
                        <?php
                            Display::demanderItems();
                        ?>
                    </div>
                </div>
                <!-- Inventory -->
                
            </div>
        </div>
        <!-- Main Content -->

    </div>

    <!-- The function dynamicSidebarMenu('text') script -->
    <script src="adm-sidebar.js"></script>

</body>

</HTML>

<?php
    if (isset($_GET["msg"])) {
        include_once "Classes/modal-classes.php";
        $msg = new Modal($_GET["msg"]);
        $msg->handleMessage();
    }
?>