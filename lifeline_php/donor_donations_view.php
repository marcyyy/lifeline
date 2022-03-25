<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }

    $uid = $_SESSION["userid"];

  if (isset($_GET['view']))
  {
      $id = $_GET['view'];

      $rec = mysqli_query($conn, "SELECT dn.id, dn.blood_code, dn.blood_type, dn.blood_rh, dn.datetime, dn.confirm, dn.tracking, dr.id as drive_id
                                  FROM donation dn INNER JOIN drive dr ON dn.drive_id = dr.id WHERE dn.id = $id");
      $record = mysqli_fetch_array($rec);

      $donation_id = $record['id'];
      $blood_code = $record['blood_code'];
      $blood_type = $record['blood_type'];
      $blood_rh = $record['blood_rh'];
      $datetime = $record['datetime'];
      $confirm = $record['confirm'];
      $tracking = $record['tracking'];
      $drive_id = $record['drive_id'];

      $rec2 = mysqli_query($conn, "SELECT * FROM drive INNER JOIN host ON drive.host_id = host.id WHERE drive.id = $drive_id");
      $record2 = mysqli_fetch_array($rec2);

      $title = $record2['title'];
      $city = $record2['city'];
      $orgname = $record2['orgname'];
      $orgtype = $record2['orgtype'];
      $email = $record2['email'];
      $phonenum = $record2['phonenum'];



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
        <title>Donations</title>
        
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
                        <a href="donor_donations.php" class="active item " style="color: #E50914; font-size:13px; margin:5px">Donations</a>
                        <a href="donor_drives.php" class="item " style="font-size:13px; margin:5px">Blood Drives</a>
                        <a href="donor_locations.php" class="item " style="font-size:13px; margin:5px">Blood Banks</a>
                        <a href="donor_info.php" class="item " style="font-size:13px; margin:5px">FAQs</a>
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
                            Your Donation
                        </h4>
                </div> 
            </div>


            <div class="main" style="padding:20px;margin-top:20px">

                    <form class="ui form">
                        <h4 class="ui dividing header" style="color:#E50914">Donation Information</h4>

                        <div class="three fields" >
                            <div class="field" >
                                <label>Donation ID</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $donation_id; ?>" readonly>
                                </div>
                            </div>
                            <div class="field" >
                                <label>Blood Code</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $blood_code; ?>" readonly>
                                </div>
                            </div>
                            <div class="field">
                                <label>Blood Type</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $blood_type; ?> <?php echo $blood_rh; ?>" readonly>
                                </div>
                            </div>
                        </div>

                            <div class="field">
                                <label>Date Donated</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $datetime; ?>" readonly>
                                </div>
                            </div>

                        <div class="two fields" >
                            <div class="field">
                                <label>Status</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $confirm; ?>" readonly>
                                </div>
                            </div>
                            <div class="field">
                                <label>Tracking</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $tracking; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    
                    <h4 class="ui dividing header" style="color:#E50914">Blood Drive Information</h4>
                          
                            <div class="field">
                                <label>Title</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $title; ?>" readonly>
                                </div>
                            </div>

                            <div class="field">
                                <label>Organization Name</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $orgname; ?>" readonly>
                                </div>
                            </div>

                          <div class="two fields" >
                            <div class="field">
                                <label>Organization Type</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $orgtype; ?>" readonly>
                                </div>
                            </div>
                            <div class="field">
                                <label>City</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $city; ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="two fields" >
                            <div class="field">
                                <label>Email</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $email; ?>" readonly>
                                </div>
                            </div>
                            <div class="field">
                                <label>Contact Number</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $phonenum; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>


                <a href="#" onclick="history.back();">
                    <button class="ui left labeled icon button" style="float:right; margin-right:25px">
                        <i class="left arrow icon"></i>
                            Back
                    </button>
                </a>
                
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
