<!-- Page Name: adm-accounts.php -->
<!-- Description: Here the admin will be able to add new accounts of type demander and supplier. The list of existing accounts will be listed -->

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
            //header("location: Includes/logout-inc.php?reason=sessiontimedout");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <title> Admin - Accounts </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="adm-sidebar.css" rel="stylesheet">
    <link href="adm-accounts.css" rel="stylesheet">
</head>

<!-- The function dynamicSidebarMenu('text') adds style to the sidebar menu -->
<body style="background: #151515; height: 100%; color: white; overflow: hidden; display: flex;" onload="dynamicSidebarMenu('Accounts')">

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

            <div class="Adm-account-box">

                <!-- Supplier Accounts -->
                <div class="Adm-account-supp-dem-box" style="margin-right: 10px;">
                    <div class="Bottom-border">Supplier Accounts</div>
                    <div class="Adm-account-account-list-box">
                        <?php
                            Display::supplierAccounts();
                        ?>
                    </div>
                </div>
                <!-- Supplier Accounts -->

                <!-- Demander Accounts -->
                <div class="Adm-account-supp-dem-box" style="margin-left: 10px;">
                    <div class="Bottom-border">Demander Accounts</div>
                    <div class="Adm-account-account-list-box">
                        <?php
                            Display::demanderAccounts();
                        ?>
                    </div>
                </div>
                <!-- Demander Accounts -->

            </div>

            <!-- Create Account -->
            <div class="Adm-account-create-box">
                <form action="Includes/signup-inc.php" method="post">
                    <div class="Adm-account-form-flex" style="margin-bottom: 20px;">
                        <div class="form-floating" style="width: 50%; margin-right: 10px;">
                            <input type="text" class="form-control Adm-account-form-input" id="username" placeholder="Enter username" name="username" autocomplete="off" maxlength = "19">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating" style="width: 50%; margin-left: 10px;">
                            <input type="text" class="form-control Adm-account-form-input" id="password" placeholder="Enter password" name="password" autocomplete="off">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="Adm-account-form-flex">
                        <div class="form-floating" style="width: 50%; margin-right: 10px;">
                            <select class="form-select Adm-account-form-input" id="type" name="type">
                                <option></option>
                                <option>Supplier</option>
                                <option>Demander</option>
                            </select>
                            <label for="type" class="form-label">Account Type</label>
                        </div>
                        <button class="Adm-account-create-btn" type="submit" name="submit" style="width: 50%; margin-left: 10px;">Create Account</button>
                    </div>
                </form>
            </div>
            <!-- Create Account -->

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