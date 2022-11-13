<!-- Page Name: index.php -->
<!-- Description: Landing page that all users will come to through a web browser. The users need to login through this page to access their specific interfaces -->

<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
</head>

<body style="background: #151515; height: 100%; color: white;">

    <div class="Log-background"></div>

    <div class="container" style="display: flex; height: 100%;">
        <div class="container Log-logo-container">
            <div style="text-align: center;">
                <img src="Image/logo.png" alt="NVKE Logo" height="400" width="400" style="text-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <h1 style="margin-top: 20px">NVKE PROCUREMENT SYSTEM</h1>
            </div>
        </div>
        <div class="container Log-box-container">
            <div class="Log-box">
                <div class="Log-box-child">
                    <h2>Welcome!</h2>
                    <span>Please sign into your account</span>
    
                    <div class="Log-form-box">
                        <form action="Includes/login-inc.php" method="post">
                            <div class="form-floating">
                                <input type="text" class="form-control Log-form-input" id="username" placeholder="Enter username" name="username" autocomplete="off">
                                <label for="username">Username</label>
                            </div>
                            
                            <div class="form-floating">
                                <input type="password" class="form-control Log-form-input" id="password" placeholder="Enter password" name="password" autocomplete="off">
                                <label for="password">Password</label>
                            </div>
                            <div style="text-align: right; margin: 20px 0px 40px 0px;"><a style="color: #5568fe !important; text-decoration: none;" href="userguide.html">User Guidelines</a></div>
                            <button class="Log-signin-btn" type="submit" name="submit">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>