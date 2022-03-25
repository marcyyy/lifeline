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
        <title>Home</title>
        
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
                        <a href="donor_home.php" class="item" style="font-size:13px; margin:5px">Home</a>
                        <a href="donor_appointments.php" class="item " style="font-size:13px; margin:5px">Appointments</a>
                        <a href="donor_donations.php" class="item " style="font-size:13px; margin:5px">Donations</a>
                        <a href="donor_drives.php" class="item " style="font-size:13px; margin:5px">Blood Drives</a>
                        <a href="donor_locations.php" class="item " style="font-size:13px; margin:5px">Blood Banks</a>
                        <a href="donor_info.php" class="active item " style="color: #E50914; font-size:13px; margin:5px">FAQs</a>
                        </div>
                    </div>
                    <a href="donor_profile.php" class="item">
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
                        <img src="assets/img/vector_donation_6.2.jpg">
                    </div>

                    <div class="content">
                        <div class="header">Programs</div>
                        <div class="meta">
                            Visit <a href="https://redcross.org.ph/give-blood/#programs" style="text-decoration:underline">Philippine Red Cross</a> for more..
                        </div>
                        <div class="ui list" style="text-align: justify; text-justify: inter-word; padding:0px 10px 5px 10px; margin-top:10px">
                            <a class="item">
                                <i class="caret right icon"></i>
                                <div class="content">
                                <div class="header">Donor Recruitment and Retention</div>
                                <div class="description">To meet the increasing demand for blood and augment the national blood requirement, the PRC
                                    conducts education and recruitment sessions to encourage regular voluntary blood donations nationwide.</div>
                                </div>
                            </a>
                            <a class="item">
                                <i class="caret right icon"></i>
                                <div class="content">
                                <div class="header">Blood Collection</div>
                                <div class="description">The PRC collects blood from voluntary blood donors with their donations accounting to almost
                                    50% share of the nation’s blood supply.</div>
                                </div>
                            </a>
                            <a class="item">
                                <i class="caret right icon"></i>
                                <div class="content">
                                <div class="header">Blood Component Processing</div>
                                <div class="description">Once blood is suitable for transfusion, blood is stored in a temperature controlled blood bank
                                    refrigerator. Clients or patients needing blood for transfusion may request from any PRC blood facilities.</div>
                                </div>
                            </a>
                            <a class="item">
                                <i class="caret right icon"></i>
                                <div class="content">
                                <div class="header">Blood Samaritan Program</div>
                                <div class="description">The Blood Samaritan Program is aimed mainly to assist indigent patients needing blood
                                    transfusion. The PRC seeks individuals/groups that are willing to give financial donations.</div>
                                </div>
                            </a>
                            <a class="item">
                                <i class="caret right icon"></i>
                                <div class="content">
                                <div class="header">Blood Donor Recognition</div>
                                <div class="description">We have instituted different awards to recognize and thank individuals and different groups who
                                    untiringly help us attain our mission.</div>
                                </div>
                            </a>
                            </div>
                    </div>
                </div>

                <div class="card" style="width: 100%;">
                    <div class="content">
                        <div class="header">How to donate</div>
                    </div>

                    <a href="donor_info_1.php" style="color:gray">
                        <div class="ui bottom attached button"><i class="chevron down icon"></i>
                            Expand
                        </div>
                    </a>
                </div>

                <div class="card" style="width: 100%;">

                    <div class="content">
                        <div class="header">Contact Us</div>
                    </div>

                <a href="donor_info_3.php" style="color:gray">
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
