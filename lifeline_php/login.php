<?php
    {
        session_start();
        session_destroy();
        $_SESSION = array();
    }

    include 'includes/db.inc.php';

    //check if any drives date start is today and if date end today
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
        <script src="assets/css/semantic/semantic.js"></script>
        <title>Log in</title>
    </head>

    <body class="outside">
        <div class="container" >
            <div class="content" style="position: absolute; top: 50%; transform: translateY(-50%); width:350px; max-width: 350px">
                
                <img src="assets/img/lifeline_w.png" width=150px style="display: flex; margin:auto;">
                <p style="text-align:center; font-size: 30px; font-family: Raleway; font-weight: bold; letter-spacing: 1px;
                                        line-height: 0.9; color:white; margin-left:30px; margin-top:-10px" >Login</p>

                <hr>

                <form action="includes/login.inc.php" class="ui form" method="post">
                    <div class="field">
                        <label style="color:white; font-family: Raleway;">Username</label>
                        <input type="text" name="username" placeholder="Username" >
                      </div>
                      <div class="field">
                        <label style="color:white; font-family: Raleway;">Password</label>
                        <input type="password" name="password" placeholder="Password">
                      </div>
                      <div class="field">
                        <label style="color:white; font-family: Raleway;">User Type</label>
                            <div class="ui selection" >
                                    <select class="form-select" name="auth" style="font-family: Raleway;" required>
                                        <option style="font-family: Raleway;" disabled="disabled" selected="selected">Select User Type</option>
                                        <option style="font-family: Raleway;"  value="Donor">Donor</option>
                                        <option style="font-family: Raleway;" value="Host">Host</option>
                                        <option style="font-family: Raleway;" value="Admin">Admin</option>
                                    </select>
                            </div>
                      </div>

                      <hr>

                        <div style="display: flex; justify-content: center; margin-top:20px"> 
                                <button type="submit" name="submit" class="ui button" style="background-color:white; color:#E50914;font-size:15px">
                                    Log in
                                </button>
                            <a href="index.php">
                                <button type="button" class="ui button" style="margin-left:5px; background-color:#ff525b; color:white;font-size:15px">
                                    Back
                                </button>
                            </a>
                        </div> 

                  </form>

                  <a href="register_type.php"><p style="text-align:center; font-size: 15px; font-family: Raleway; letter-spacing: 0px; line-height: 0.9; color:white; margin-top:20px">Register account</p></a>

            </div>
        </div>
    </body>
</html>
