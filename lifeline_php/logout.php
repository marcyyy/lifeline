<?php
    {
        session_start();
        session_destroy();
        $_SESSION = array();
    }
?>

<!DOCTYPE html>
<html style="background-color: #E50914; color: #E50914;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="pragma" content="no-cache" />
        <meta name="viewport" content="initial-scale=1, width=device-width, user-scalable=no, maximum-scale=1">
        <link rel="icon" href="assets/img/lifeline_icon.png">
        <link rel="stylesheet" href="assets/css/semantic/dist/semantic.min.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <title>Log out</title>
    </head>
    <body class="outside">
        <div class="container">
            <div class="content" style="position: absolute; top: 50%; transform: translateY(-50%);max-width: 400px">
                
                <!--img src="img/lifeline-logo-w.png" width=150px-->
                    
                <p style="text-align:left; font-size: 30px; font-family: Raleway; font-weight: bold; letter-spacing: -2px;line-height: 0.9; color:white;" >You have successfully<br>logged out.</p>

                <a href="login.php"><button class="ui button" style="background-color:white; color:#E50914">
                    Log in
                </button></a>

            </div>
        </div>
    </body>
</html>
