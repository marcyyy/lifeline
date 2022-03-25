<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }

  $results = mysqli_query($conn, "SELECT * FROM drive WHERE status IN ('Approved') ORDER BY status desc");

        $uid = $_SESSION["userid"];

        if (isset($_GET['view']))
        { 
            $did = $_GET['view'];

            $rec = mysqli_query($conn, "SELECT * FROM drive INNER JOIN host ON host.id = drive.host_id WHERE drive.id = $did");
            $record = mysqli_fetch_array($rec);
        
            $id = $record['id'];
            $title = $record['title'];
            $details = $record['details'];
            $city = $record['city'];
            $location = $record['location'];

            $date_start = $record['date_start'];
            $date1= new DateTime($date_start);

            $date_end = $record['date_end'];
            $date2= new DateTime($date_end);

            $time_start = $record['time_start'];
            $time1= new DateTime($time_start);

            $time_end = $record['time_end'];
            $time2= new DateTime($time_end);
    
            $orgname = $record['orgname'];
            $email = $record['email'];
            $phonenum = $record['phonenum'];

            $lastDonated = "";
            $lastDonate = mysqli_query($conn, "SELECT dn.datetime AS llast FROM donation dn  WHERE dn.donor_id = $uid ORDER BY dn.datetime DESC LIMIT 1");
            if($lastDonate->num_rows === 0)
            {
            
            }
            else{
            $row1 = mysqli_fetch_assoc($lastDonate); 
            $lastDonated = $row1['llast'];
            $date= new DateTime($lastDonated);

            //dates
            $date1= new DateTime($date_start);
            $date3= new DateTime($lastDonated);
            $nextDate = date('Y-m-d', strtotime("+3 months", strtotime($lastDonated)));
            $date4= new DateTime($nextDate);
            $todate = date('Y-m-d');
            $date0= new DateTime($todate);

            $dateStart = date_format($date1, 'Y-m-d');
            $dateLast = date_format($date3, 'Y-m-d');
            $dateAvailable = date_format($date4, 'Y-m-d');
            $dateToday = date_format($date0, 'Y-m-d');
            }

            $apptStatus = 0;
            $check = mysqli_query($conn, "SELECT appointment.status as apptStatus, appointment.date as apptDate, drive.title FROM appointment
                                                INNER JOIN drive ON appointment.drive_id = drive.id
                                                WHERE appointment.donor_id = $uid and appointment.status = 'Pending'");
            if($check->num_rows === 0)
            {
            
            }
            else{
            $row2 = mysqli_fetch_assoc($check); 
            $apptStatus = $row2['apptStatus'];
            $apptDate0 = $row2['apptDate'];
            $driveTitle = $row2['title'];
            $apptDate= new DateTime($apptDate0);
            }
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
        <title>Drives</title>

        <style>
            input:invalid+span:after {
            content: '✖';
            color: red;
            }

            input:valid+span:after {
            content: '✔';
            color: green;
            }
        </style>
        
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
                        <a href="donor_drives.php" class="active item " style="color: #E50914; font-size:13px; margin:5px">Blood Drives</a>
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
                            Blood Drives
                        </h4>
                </div> 
            </div>


            <div class="main" style="padding:20px">
            
            <div class="ui link cards" style="width:100%; margin:auto; z-index:0">
                <div class="card" style="width:100%">
                    <div class="image" style="width:100%; max-height:400px">
                        <img src="assets/img/vector_donation_3.jpg"> 
                    </div>
                    <div class="content">
                    <div class="header"><?php echo $title;?></div>
                    <div class="meta">
                        <a><?php echo $orgname;?></a>
                    </div><br>
                    <div class="description">
                        <div class="ui list">
                            <div class="item" style="padding:5px">
                                <i class="map marker alternate icon"></i>
                                <div class="content" style="padding-left:15px">
                                    <?php echo $city;?>
                                </div>
                            </div>
                            <div class="item" style="padding:5px">
                                <i class="map outline icon"></i>
                                <div class="content" style="padding-left:10px">
                                    <?php echo $location;?>
                                </div>
                            </div>
                            <div class="item" style="padding:5px">
                                <i class="info icon"></i>
                                <div class="content" style="padding-left:20px">
                                    <?php echo $details;?>
                                </div>
                            </div>
                            <div class="item" style="padding:5px">
                                <i class="calendar alternate outline icon"></i>
                                <div class="content" style="padding-left:13px">
                                    <?php echo $date1->format('m/d/Y'); ?> to <?php echo $date2->format('m/d/Y'); ?>
                                </div>
                            </div>
                            <div class="item" style="padding:5px">
                                <i class="hourglass half icon"></i>
                                <div class="content" style="padding-left:15px">
                                    <?php echo $time1->format('H:i'); ?> to <?php echo $time2->format('H:i'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="extra content">
                    
                    <form action="includes/donor_appointment.inc.php" class="ui form" method="post">
                        <div class="two fields">
                            <div class="field" style="width:100%">

                                <input type="hidden" name="drive_id" value="<?php echo $did; ?>">
                                <input type="hidden" name="donor_id" value="<?php echo $uid; ?>">
                                <input type="hidden" name="available" value="Pending">
                                <label>Set Appointment Date</label>
                                <div class="field" > 
                                    <input type="date" name="date" min="<?php echo $date_start; ?>" max="<?php echo $date_end; ?>" required>
                                </div>
                            </div>
                            <div class="field">
                                <label>Set Appointment Time</label>
                                <div class="field"style="width:90%">
                                    <input type="time" name="time" min="<?php echo $time_start; ?>" max="<?php echo $time_end; ?>" required>
                                    <span class="validity right floated" style="margin-top:-30px; margin-right:-28px"></span>
                                </div>
                            </div>
                        </div>

                        <?php if ($apptStatus >= 1) {?>
                            <div style="text-align:center;margin-top:20px; margin-bottom: 5px">
                                <i class="calendar alternate yellow icon"></i>
                                    You already have an appointment set on <?php echo $apptDate->format('m/d/Y'); ?><br>
                                    with <?php echo $driveTitle; ?> <br>
                                    <a href="donor_appointments.php" style="color:blue">Click here to see your appointments.</a>
                            </div>
                        <?php } else if($lastDonated != "" AND $dateStart >= $dateAvailable) {?>
                            <button type="submit" name="submit" class="ui right labeled icon primary button" style="float:right">
                                <i class="check icon"></i>
                                    Confirm 
                            </button>
                        <?php } else if($lastDonated != "" AND $dateAvailable <= $dateToday) {?>
                            <button type="submit" name="submit" class="ui right labeled icon primary button" style="float:right">
                                <i class="check icon"></i>
                                    Confirm 
                            </button>
                        <?php } else if($lastDonated != "" AND $dateLast < $dateAvailable) {?>
                            <div style="text-align:center;margin-top:20px; margin-bottom: 5px">
                                <i class="exclamation triangle yellow icon"></i>
                                    Your Next Donation Availability is on <?php echo $date4->format('m/d/Y'); ?>
                            </div>
                        <?php } else {?>
                            <button type="submit" name="submit" class="ui right labeled icon primary button" style="float:right">
                                <i class="check icon"></i>
                                    Confirm 
                            </button>
                        <?php } ?>
                    
                </form>
                    </div>
                </div>
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
