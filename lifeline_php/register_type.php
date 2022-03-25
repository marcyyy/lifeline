<!DOCTYPE html>
<html style="background-color: #E50914; color: #E50914;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="pragma" content="no-cache" />
        <meta name="viewport" content="initial-scale=1, width=device-width, user-scalable=no, maximum-scale=1">
        <link rel="icon" href="assets/img/lifeline_icon.png">
        <link rel="stylesheet" href="assets/css/semantic/dist/semantic.min.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <title>Register Account</title>
    </head>

    <body class="outside">
        <div class="container" >
            <div class="content" style="position: absolute; top: 50%; transform: translateY(-50%);width: 350px; max-width: 350px;">
                
                <p style="text-align:center; font-size: 30px; font-family: Raleway; font-weight: bold; letter-spacing: -2px;line-height: 0.9; color:white;" >Register account</p>
                <a href="login.php"><p style="text-align:center; font-size: 15px; font-family: Raleway; letter-spacing: 0px; line-height: 0.9; color:white; margin:-20px 0 15px 0" >Already have an account?</p></a>

                <hr>

                <form class="ui form">
                    <div class="field">
                        <label style="color:white; font-family: Raleway; margin:25px 20px 25px 20px; text-align: center; font-size:25px">I am a ...</label>
                        
                        <div style="justify-content: center; display: flex;">
                            <a href="register_donor.php">
                                <button type="button" class="ui button" style="background-color:#ff525b; color:white; margin-right:10px; font-size:15px">
                                    Donor
                                </button>
                            </a>
                            <a href="register_host.php">
                                <button type="button" class="ui button" style="background-color:#ff525b; color:white; font-size:15px">
                                    Host
                                </button>
                            </a>
                        </div>

                      </div>

                  </form>

            </div>
        </div>
    </body>
</html>
