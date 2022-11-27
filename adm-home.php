<!-- Page Name: adm-home.php -->
<!-- Description: User interface for admin account type -->

<?php
include_once "Classes/dbh-classes.php";
include_once "Classes/display-classes.php";

session_start();

//This if statement makes sure that only admin have access to this page
if (!isset($_SESSION["username"])) {
    header("location: index.php?msg=unauthorised");
} else {
    if (isset($_SESSION["usertype"])) {
        if ($_SESSION["usertype"] != "admin") {
            header("location: Includes/logout-inc.php?reason=unauthorised");
        }

        include_once "Includes/timeout-inc.php";

        if (!checkTimeOut()) {
            header("location: Includes/logout-inc.php?reason=sessiontimedout");
        }
    }
}

$did = "";

if (isset($_POST["demand-id"])) {
    $did = $_POST["demand-id"];
}
?>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <title> Admin - Home </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="adm-sidebar.css" rel="stylesheet">
    <link href="adm-home.css" rel="stylesheet">
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
                    <a class="dynamicSidebarMenu" href="adm-home.php">Home</a>
                </li>
                <li class="Adm-sidebar-menu-li">
                    <a class="dynamicSidebarMenu" href="adm-accounts.php">Accounts</a>
                </li>
                <li class="Adm-sidebar-menu-li">
                    <a class="dynamicSidebarMenu" href="adm-items.php">Items</a>
                </li>
                <li class="Adm-sidebar-menu-li">
                    <a class="dynamicSidebarMenu" href="adm-history.php">Request History</a>
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
                <span class="Color-blue">ADMIN</span>
            </div>
        </div>
        <!-- Top user info box -->
        
        <!-- Main Content -->
        <div class="Adm-content-box">

            <!-- Admin Revenue -->
            <div class="Adm-Home-revenue-box">
                <div class="Bottom-border">Revenue Data</div>
                <div style="height: 167px; display: flex; justify-content: center; align-items: center;">
                    <?php
                        Display::adminRevenue();
                    ?>
                </div>
            </div>
            <!-- Admin Revenue -->

            <div class="Adm-Home-child-box">

                <!-- Pending Demands -->
                <div class="Adm-Home-pending-demand-box">
                    <div class="Bottom-border">Pending Demand</div>
                    <div class="Adm-Home-pending-demand-list-box">
                        <?php
                            Display::adminPendingDemands();
                        ?>
                    </div>
                </div>
                <!-- Pending Demands -->

                <!-- Demand Summary -->
                <div class="Adm-Home-demand-summary-box">
                    <?php
                        Display::adminDemandSummary($did);
                    ?>
                </div>
                <!-- Demand Summary -->

            </div>

        </div>
        <!-- Main Content -->
        
    </div>

    <!-- The function dynamicSidebarMenu('text') script -->
    <script src="adm-sidebar.js"></script>

</body>

</html>

<?php
    if (isset($_GET["msg"])) {
        include_once "Classes/modal-classes.php";
        $msg = new Modal($_GET["msg"]);
        $msg->handleMessage();
    }
?>