<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="pragma" content="no-cache" />
        <meta name="viewport" content="initial-scale=1, width=device-width, user-scalable=no, maximum-scale=1">
        <link rel="icon" href="assets/img/lifeline_icon.png">
        <link rel="stylesheet" href="assets/css/semantic/dist/semantic.min.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="assets/css/sidebar.css">
        <title>FAQs</title>
        
    </head>

    <body style="background-color:white;">
    <div class="container" >
    <div class="content" style="position: absolute; top:50%; transform: translateY(-56%);
                             width: 100%; max-width: 100%; height:100px; min-height: 90%;
                             overflow-y: scroll; overflow-x:hidden">
            
                <div class="ui vertical menu sidepanel"  id="mySidepanel" hidden="true" style="min-height:100vh">
                      <div class="ui two column very relaxed stackable grid" style="margin-top:-55px; margin-bottom:-20px">
                        <div class="column" style="margin-left: 30px; margin-top:10px">
                          <img src="assets/img/lifeline_r.png" width=100px style="margin-bottom:20px">
                        </div>

                      </div>

                      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
                        <i class="chevron left icon"></i> 
                      </a>

                    <div class="item">
                        <div class="menu">
                        <a href="host_home.php" class="item" style="font-size:13px; margin:5px">Home</a>
                        <a href="host_drives.php" class="item " style="font-size:13px; margin:5px">Blood Drives</a>
                        <a href="host_donations.php" class="item " style="font-size:13px; margin:5px">Donations</a>
                        <a href="host_info.php" class="active item " style="color: #E50914; font-size:13px; margin:5px">How to host</a>
                        </div>
                    </div>
                    <a href="host_profile.php" class="item">
                        <i class="user circle outline icon"></i> 
                        <?php echo $name = $_SESSION["usernm"]; ?>
                    </a>
                    <a href="logout.php" class="item">
                        <i class="arrow alternate circle left outline icon"></i> 
                        Logout
                    </a>
                </div>

                <div class="ui grid" style="width:100%; background-color: white; position: sticky; top: 0; z-index:2; margin-bottom:10px;
                        border-bottom: 5px; -webkit-box-shadow: 0 4px 6px -6px #222; -moz-box-shadow: 0 4px 6px -6px #222; box-shadow: 0 4px 6px -6px #222;">
                <div class="eight wide column">
                    <button class="openbtn" onclick="openNav()" style="font-size:25px; margin-left:20px;background:transparent">
                            <i class="th icon"></i> 
                    </button>  
                </div>
                <div class="eight wide column">
                        <h4 style="text-align: right; color:#E50914; font-size:20px; padding: 10px 15px; margin-right:12px">
                            FAQs
                        </h4>
                </div> 
            </div>


            <div class="main" style="padding:20px">

            <div class="ui link cards" style="width:100%; margin:auto; z-index:0">

            <div class="card" style="width: 100%;">
                    <div class="image">
                        <img src="assets/img/vector_donation_0.jpg">
                    </div>

                    <div class="content">
                        <div class="header">Contact Us</div>
                        <div class="meta">
                            Visit <a href="https://redcross.org.ph/contact-us/" style="text-decoration:underline">Philippine Red Cross</a> for more..
                        </div>
                        <div class="ui list" style="text-align: justify; text-justify: inter-word; padding:0px 10px 5px 10px; margin-top:10px">
                            <a class="item">
                                <i class="caret right icon"></i>
                                <div class="content">
                                <div class="header">General</div>
                                <div class="description">37 EDSA corner Boni Avenue, Mandaluyong City 1550<br>143 Trunkline +63 2 8790 2300 <br> communication@redcross.org.ph</div>
                                </div>
                            </a>
                            <a class="item">
                                <i class="caret right icon"></i>
                                <div class="content">
                                <div class="header">Blood Donation and Requests</div>
                                <div class="description">(+63 2) 8790-2382 / (+63 2) 8790-2383 <br> (+63 2) 8790-2300 loc. 113/116 <br> nbc@redcross.org.ph</div>
                                </div>
                            </a>
                            <a class="item">
                                <i class="caret right icon"></i>
                                <div class="content">
                                <div class="header">Volunteer</div>
                                <div class="description">(+63 2) 8790-2373 <br> (+63 2) 8790-2300 loc. 945 <br> volunteer@redcross.org.ph</div>
                                </div>
                            </a>
                            <a class="item">
                                <i class="caret right icon"></i>
                                <div class="content">
                                <div class="header">Donation and Fundraising</div>
                                <div class="description">(+63 2) 8790-2410 / (+63 2) 8790-2413 <br> (+63 2) 8790-2300 loc. 984 <br> (+63 917) 834 8378 <br> fundgeneration@redcross.org.ph</div>
                                </div>
                            </a>
                            <a class="item">
                                <i class="caret right icon"></i>
                                <div class="content">
                                <div class="header">Membership</div>
                                <div class="description">(+63 2) 8790-2396 <br> (+63 2) 8790-2300 loc. 827 <br> maabrecruitment@redcross.org.ph</div>
                                </div>
                            </a>
                            </div>
                    </div>

            </div>

                <div class="card" style="width: 100%;">

                    <div class="content">
                        <div class="header">How to host</div>
                    </div>

                    <a href="host_info_1.php" style="color:gray">
                        <div class="ui bottom attached button"><i class="chevron down icon"></i>
                            Expand
                        </div>
                    </a>
                </div>

                <div class="card" style="width: 100%;">

                    <div class="content">
                        <div class="header">How to donate</div>
                    </div>

                    <a href="host_info_2.php" style="color:gray">
                        <div class="ui bottom attached button"><i class="chevron down icon"></i>
                            Expand
                        </div>
                    </a>
                </div>


            </div>


        </div>
    </div>

    </body>

    <script>
        closeNav();
        
        function openNav() {
            document.getElementById("mySidepanel").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
    <script src="assets/css/semantic/dist/semantic.min.js">
</html>
