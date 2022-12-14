<!-- Page Name: supplier.php -->
<!-- Description: User interface for supplier account type -->

<?php
include_once "Classes/dbh-classes.php";
include_once "Classes/display-classes.php";

session_start();

//This if statement makes sure that only suppliers have access to this page
if (!isset($_SESSION["username"])) {
    header("location: index.php?msg=unauthorised");
} else {
    if (isset($_SESSION["usertype"])) {
        if ($_SESSION["usertype"] != "supplier") {
            header("location: Includes/logout-inc.php?submit=submit");
        }
        
        include_once "Includes/timeout-inc.php";

        //This if statement makes sure that the user did not time out
        if (!checkTimeOut()) {
            header("location: Includes/logout-inc.php?reason=sessiontimedout");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <title> Supplier - Home </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="supplier.css" rel="stylesheet">
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
                    <a class="dynamicSidebarMenu" href="supplier.php">Home</a>
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
                <span class="Color-blue">SUPPLIER</span>
            </div>
        </div>
        <!-- Top user info box -->

        <!-- Main Content -->
        <div class="Adm-content-box">

            <!-- Supplier Revenue -->
            <div class="Supplier-revenue-box">
                <div class="Bottom-border">Revenue Data</div>
                <div style="height: 167px; display: flex; justify-content: center; align-items: center;">
                    <?php
                        Display::supplierRevenue($_SESSION["username"]);
                    ?>
                </div>
            </div>
            <!-- Supplier Revenue -->

            <div class="Supplier-child-box">

                <!-- Pending Demands -->
                <div class="Supplier-inventory-box" style="margin-right: 10px;">
                    <div class="Bottom-border">Pending Demands</div>
                    <div class="Supplier-item-list-box">
                        <?php
                            Display::supplierPendingDemands($_SESSION["username"]);
                        ?>
                    </div>
                </div>
                <!-- Pending Demands -->

                <!-- Quotation Awaiting Approvals -->
                <div class="Supplier-inventory-box" style="margin: 0px 10px 0px 10px;">
                    <div class="Bottom-border">Quotations Awaiting Approval</div>
                    <div class="Supplier-item-list-box">
                        <?php
                            Display::supplierQuotationsAwaitingApproval($_SESSION["username"]);
                        ?>
                    </div>
                </div>
                <!-- Quotation Awaiting Approvals -->

                <!-- Previous Quotations -->
                <div class="Supplier-inventory-box" style="margin-left: 10px;">
                    <div class="Bottom-border">Previous Quotations</div>
                    <div class="Supplier-item-list-box">
                        <?php
                            Display::supplierPreviousQuotations($_SESSION["username"]);
                        ?>
                    </div>
                </div>
                <!-- Previous Quotations -->

            </div>
        </div>
        <!-- Main Content -->

    </div>

    <!-- The function dynamicSidebarMenu('text') script -->
    <script src="adm-sidebar.js"></script>
    
    <!-- This function is used to increment or decrement offers -->
    <script>
        function counter(obj, id, increment) {
            temp = document.getElementById(id)
            current_qty = parseInt(temp.value)

            if (increment) {
                temp.value = current_qty + 1
            } else {
                if (temp.value > 1) {
                    temp.value = current_qty - 1
                }
            }
        }
    </script>

</body>

</html>

<?php
    //This handle all kinds of error messages
    if (isset($_GET["msg"])) {
        include_once "Classes/modal-classes.php";
        $msg = new Modal($_GET["msg"]);
        $msg->handleMessage();
    }
?>