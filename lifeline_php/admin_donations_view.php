<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }
  

  if (isset($_GET['view']))
    {
        $id = $_GET['view'];

        $rec = mysqli_query($conn, "SELECT * FROM donation INNER JOIN donor ON donor.id = donation.donor_id WHERE donation.id = $id");
        $record = mysqli_fetch_array($rec);
    
        $drive_id = $record['drive_id'];
        $blood_code = $record['blood_code'];
        $blood_type = $record['blood_type'];
        $blood_rh = $record['blood_rh'];
        $datetime = $record['datetime'];
        $confirm = $record['confirm'];
        $tracking = $record['tracking'];
        $fullname = $record['name'];
        $email = $record['email'];
        $phonenum = $record['phonenum'];

        $nextDate = date('Y-m-d', strtotime("+3 months", strtotime($datetime)));

        $result1 = mysqli_query($conn, "SELECT * FROM donor WHERE name = '{$fullname}'");
        $row1 = mysqli_fetch_assoc($result1); 
        $IDdonor = $row1['id'];

        $result2 = mysqli_query($conn, "SELECT COUNT(donor_id) AS count FROM donation WHERE donation.donor_id = $IDdonor");
        $row2 = mysqli_fetch_assoc($result2); 
        $count2 = $row2['count'];

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
                        <a href="admin_home.php" class="item" style="font-size:13px; margin:5px">Dashboard</a>
                        <a href="admin_drives.php" class="item" style="font-size:13px; margin:5px">Blood Drives</a>
                        <a href="admin_donations.php" class="active item " style="color: #E50914; font-size:13px; margin:5px">Blood Donations</a>
                        <a href="admin_locations.php" class="item " style="font-size:13px; margin:5px">Blood Bank Locations</a>
                        <a href="admin_accounts.php" class="item " style="font-size:13px; margin:5px">Accounts Management</a>
                        </div>
                    </div>
                    <a href="admin_profile.php" class="item">
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
                            Donations
                        </h4>
                </div> 
            </div>



            <div class="main" style="padding:20px;margin-top:20px">

                    <form class="ui form">
                        <h4 class="ui dividing header" style="color:#E50914">Donation Information</h4>

                        <div class="four fields" >
                            <div class="field" >
                                <label>Blood Drive ID</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $drive_id; ?>" readonly>
                                </div>
                            </div>
                            <div class="field">
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
                            <div class="field">
                                <label>Date Donated</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $datetime; ?>" readonly>
                                </div>
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

        
            
                    <h4 class="ui dividing header" style="color:#E50914">Donor Information</h4>
                    
                         <div class="two fields" >
                            <div class="field" style="width:90%">
                                <label>Donor Full Name</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $fullname; ?>" readonly>
                                </div>
                            </div>
                            <div class="field">
                                <label>Total Donations</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $count2; ?>" readonly>
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

                            <div class="field">
                                <label>Donation Date Availability</label>
                                <div class="field">
                                    <input type="text" value="<?php echo $nextDate; ?>" readonly>
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
<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }
  

  if (isset($_GET['view']))
    {
        $id = $_GET['view'];

        $rec = mysqli_query($conn, "SELECT drive.id, drive.title, drive.details, drive.date_start, drive.date_end, drive.time_start, drive.time_end, drive.status,
                                            host.name, host.orgname, host.orgrole, host.email, host.phonenum FROM drive INNER JOIN host ON host.id = drive.host_id
                                            WHERE drive.id = $id");
        $record = mysqli_fetch_array($rec);
    
        $id = $record['id'];
        $title = $record['title'];
        $details = $record['details'];
        $date_start = $record['date_start'];
        $date_end = $record['date_end'];
        $time_start = $record['time_start'];
        $time_end = $record['time_end'];
        $status = $record['status'];

        $hostname = $record['name'];
        $orgname = $record['orgname'];
        $orgrole = $record['orgrole'];
        $email = $record['email'];
        $phonenum = $record['phonenum'];

      }

?>

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
        <title>Drives</title>
        
    </head>

    <body style="background-color:white;">
    <div class="container" >
        <div class="content" style="position: absolute; top:50%; transform: translateY(-50%);
                             width: 500px; max-width: 500px; height: 800px; max-height: 800px;">
            
                <div class="ui vertical menu sidepanel"  id="mySidepanel" hidden="true">
                      <div class="ui two column very relaxed stackable grid" style="margin-top:-55px; margin-bottom:-20px">
                        <div class="column" style="margin-left: 20px">
                          <img src="assets/img/lifeline_r.png" width="100px" style="margin-bottom:20px">
                        </div>

                      </div>

                      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
                        <i class="chevron left icon"></i> 
                      </a>

                    <div class="item">
                        <div class="menu">
                        <a href="admin_home.php" class="item" style="font-size:13px; margin:5px">Dashboard</a>
                        <a href="#" class="active item" style="color: #E50914; font-size:13px; margin:5px">Blood Drives</a>
                        <a href="admin_donations.php" class="item " style="font-size:13px; margin:5px">Blood Donations</a>
                        <a href="admin_locations.php" class="item " style="font-size:13px; margin:5px">Blood Bank Locations</a>
                        <a href="admin_accounts.php" class="item " style="font-size:13px; margin:5px">Accounts Management</a>
                        </div>
                    </div>
                    <a href="admin_profile.php" class="item">
                        <i class="user circle outline icon"></i> 
                        <?php echo $name = $_SESSION["usernm"]; ?>
                    </a>
                    <a href="logout.php" class="item">
                        <i class="arrow alternate circle left outline icon"></i> 
                        Logout
                    </a>
                </div>

            <div style="margin-left:5px">
                <button class="openbtn" onclick="openNav()">
                        <i class="th icon"></i> 
                </button>  
            </div>


            <div class="main" style="padding:20px">

                    <form class="ui form">
                        <h4 class="ui dividing header" style="color:#E50914">Donation Information</h4>

                        <div class="two fields">
                            <div class="field">
                                <label>Title</label>
                                <div class="field">
                                    <input type="text" value="" readonly>
                                </div>
                            </div>
                            <div class="field">
                                <label>Date Donated</label>
                                <div class="field">
                                    <input type="text" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="two fields" style="width:500px">
                            <div class="field">
                                <label>Tracking</label>
                                <div class="field">
                                    <input type="text" value="" readonly>
                                </div>
                            </div>
                            <div class="field">
                                <label>Status</label>
                                <div class="field">
                                    <input type="text" value="" readonly>
                                </div>
                            </div>
                        </div>

        
            
                    <h4 class="ui dividing header" style="color:#E50914">Donor Information</h4>
                    
                            <div class="field">
                                <label>Organization Name</label>
                                <div class="field">
                                    <input type="text" value="" readonly>
                                </div>
                            </div>

                        <div class="two fields" style="width:500px">
                            <div class="field">
                                <label>Host Name</label>
                                <div class="field">
                                    <input type="text" value="" readonly>
                                </div>
                            </div>
                            <div class="field">
                                <label>Organization Role</label>
                                <div class="field">
                                    <input type="text" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="two fields" style="width:500px">
                            <div class="field">
                                <label>Email</label>
                                <div class="field">
                                    <input type="text" value="" readonly>
                                </div>
                            </div>
                            <div class="field">
                                <label>Contact Number</label>
                                <div class="field">
                                    <input type="text" value="" readonly>
                                </div>
                            </div>
                        </div>
                    
                </form>


                <a href="#" onclick="history.back();">
                    <button class="ui left labeled icon button" style="float:right">
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
