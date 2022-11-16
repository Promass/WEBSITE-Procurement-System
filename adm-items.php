<!-- Page Name: adm-items.php -->
<!-- Description: Here admin will see the list of existing items for demands. He/she will be able to add new items or delete existing items -->

<?php
include "Classes/dbh-classes.php";
include "Classes/display-classes.php";

session_start();

//This if statement makes sure that only admin have access to this page
if (!isset($_SESSION["username"])) {
    header("location: index.php?logintocontinue");
} else {
    if (isset($_SESSION["usertype"])) {
        if ($_SESSION["usertype"] != "admin") {
            header("location: Includes/logout-inc.php?submit=submit");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <title> Admin - Items </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="adm-sidebar.css" rel="stylesheet">
    <link href="adm-items.css" rel="stylesheet">
</head>

<!-- The function dynamicSidebarMenu('text') adds style to the sidebar menu -->
<body style="background: #151515; height: 100%; color: white; overflow: hidden; display: flex;" onload="dynamicSidebarMenu('Items')">

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
            <div style="display: flex;">

                <!-- Create New Item -->
                <div class="Adm-item-create-item-box">
                    <form action="Includes/item-inc.php" method="post">
                        <div class="Bottom-border">Create New Item</div>
                        <div class="form-floating">
                            <input type="text" class="form-control Adm-item-form-input" id="item-name" placeholder="Enter item-name" name="item-name" autocomplete="off">
                            <label for="item-name">Name</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control Adm-item-form-input Adm-item-form-description" id="item-description" name="item-description" placeholder="description goes here"></textarea>
                            <label for="item-description">Description</label>
                        </div>
                        <button class="Adm-item-create-item-btn" type="submit" name="submit">Create Item</button>
                    </form>
                </div>
                <!-- Create New Item -->

                <!-- Item Inventory -->
                <div class="Adm-item-inventory-box">
                    <div class="Bottom-border">Inventory</div>
                    <div class="Adm-item-item-list-box">
                        <?php
                            Display::adminItems();
                        ?>
                    </div>
                </div>
                <!-- Item Inventory -->

            </div>
        </div>
        <!-- Main Content -->

    </div>

    <!-- The function dynamicSidebarMenu('text') script -->
    <script src="adm-sidebar.js"></script>

</body>

</html>