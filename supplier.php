<!-- Page Name: supplier.php -->
<!-- Description: User interface for supplier account type -->

<?php
session_start();

//This if statement makes sure that only suppliers have access to this page
if (!isset($_SESSION["username"])) {
    header("location: index.php?logintocontinue");
} else {
    if (isset($_SESSION["usertype"])) {
        if ($_SESSION["usertype"] != "supplier") {
            header("location: Includes/logout-inc.php?submit=submit");
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
            </div>
            <!-- Supplier Revenue -->

            <div class="Supplier-child-box">

                <!-- Pending Demands -->
                <div class="Supplier-inventory-box" style="margin-right: 10px;">
                    <div class="Bottom-border">Pending Demands</div>
                    <div class="Supplier-item-list-box">
                        <div class="Supplier-item-box">
                            <div><span class="Color-blue">Demand ID: </span>3839201800</div>
                            <div><span class="Color-blue">Item: </span>“Shakespeare’s Romeo and Juliet”</div>
                            <div class="Tag-yellow">PENDING</div>
                        </div>
                        <div class="Supplier-item-box" style="height:fit-content;">
                            <div><span class="Color-blue">Demand ID: </span>3839201800</div>
                            <div><span class="Color-blue">Item: </span>“Shakespeare’s Romeo and Juliet”</div>
                            <div class="Tag-yellow">PENDING</div>
                        </div>
                        <div class="Supplier-item-box" style="height:fit-content;">
                            <div><span class="Color-blue">Demand ID: </span>3839201800</div>
                            <div><span class="Color-blue">Item: </span>“Shakespeare’s Romeo and Juliet”</div>
                            <div class="Tag-yellow">PENDING</div>
                        </div>
                        <div class="Supplier-item-box" style="height:fit-content;">
                            <div><span class="Color-blue">Demand ID: </span>3839201800</div>
                            <div><span class="Color-blue">Item: </span>“Shakespeare’s Romeo and Juliet”</div>
                            <div class="Tag-yellow">PENDING</div>
                        </div>
                    </div>
                </div>
                <!-- Pending Demands -->

                <!-- Quotation Awaiting Approvals -->
                <div class="Supplier-inventory-box" style="margin: 0px 10px 0px 10px;">
                    <div class="Bottom-border">Quotations Awaiting Approval</div>
                    <div class="Supplier-item-list-box">
                        <div class="Supplier-item-box">
                            <div><span class="Color-blue">Quotation ID: </span>1654165416</div>
                            <div><span class="Color-blue">Demand ID: </span>3839201800</div>
                            <div><span class="Color-blue">Item: </span>“Shakespeare’s Romeo and Juliet”</div>
                            <div><span class="Color-blue">Bid Price: </span>4000$</div>
                            <div class="Tag-gray">WAITING</div>
                        </div>
                        <div class="Supplier-item-box">
                            <div><span class="Color-blue">Quotation ID: </span>1654165416</div>
                            <div><span class="Color-blue">Demand ID: </span>3839201800</div>
                            <div><span class="Color-blue">Item: </span>“Shakespeare’s Romeo and Juliet”</div>
                            <div><span class="Color-blue">Bid Price: </span>8000$</div>
                            <div class="Tag-gray">WAITING</div>
                        </div>
                        <div class="Supplier-item-box">
                            <div><span class="Color-blue">Quotation ID: </span>1654165416</div>
                            <div><span class="Color-blue">Demand ID: </span>3839201800</div>
                            <div><span class="Color-blue">Item: </span>“Shakespeare’s Romeo and Juliet”</div>
                            <div><span class="Color-blue">Bid Price: </span>8000$</div>
                            <div class="Tag-gray">WAITING</div>
                        </div>
                    </div>
                </div>
                <!-- Quotation Awaiting Approvals -->

                <!-- Previous Quotations -->
                <div class="Supplier-inventory-box" style="margin-left: 10px;">
                    <div class="Bottom-border">Previous Quotations</div>
                    <div class="Supplier-item-list-box">
                        <div class="Supplier-item-box">
                            <div><span class="Color-blue">Quotation ID: </span>1654165416</div>
                            <div><span class="Color-blue">Demand ID: </span>3839201800</div>
                            <div><span class="Color-blue">Item: </span>“Shakespeare’s Romeo and Juliet”</div>
                            <div><span class="Color-blue">Bid Price: </span>4000$</div>
                            <div class="Tag-red">REJECTED</div>
                        </div>
                        <div class="Supplier-item-box">
                            <div><span class="Color-blue">Quotation ID: </span>1654165416</div>
                            <div><span class="Color-blue">Demand ID: </span>3839201800</div>
                            <div><span class="Color-blue">Item: </span>“Shakespeare’s Romeo and Juliet”</div>
                            <div><span class="Color-blue">Bid Price: </span>8000$</div>
                            <div class="Tag-green">ACCEPTED</div>
                        </div>
                        <div class="Supplier-item-box">
                            <div><span class="Color-blue">Quotation ID: </span>1654165416</div>
                            <div><span class="Color-blue">Demand ID: </span>3839201800</div>
                            <div><span class="Color-blue">Item: </span>“Shakespeare’s Romeo and Juliet”</div>
                            <div><span class="Color-blue">Bid Price: </span>4000$</div>
                            <div class="Tag-red">REJECTED</div>
                        </div>
                    </div>
                </div>
                <!-- Previous Quotations -->

            </div>
        </div>
        <!-- Main Content -->

    </div>

    <!-- The function dynamicSidebarMenu('text') script -->
    <script src="adm-sidebar.js"></script>

</body>

</html>