<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }

  $results = mysqli_query($conn, "SELECT * FROM drive WHERE status IN ('Approved', 'On Going') ORDER BY status desc");

        $uid = $_SESSION["userid"];
  
        $rec = mysqli_query($conn, "SELECT * FROM donor WHERE id = $uid");
        $record = mysqli_fetch_array($rec);
    
        $id = $record['id'];
        $fullname = $record['name'];
        $blood_type = $record['blood_type'];
        $blood_rh = $record['blood_rh'];
        $available = $record['available'];
          
        $rec1 = mysqli_query($conn, "SELECT * FROM drive INNER JOIN host ON host.id = drive.host_id");
        $record1 = mysqli_fetch_array($rec1);
        $date_start = $record1['date_start'];
        $did = $record1['id'];

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

        $check = mysqli_query($conn, "SELECT COUNT(apt.id) as apptStatus, apt.date as apptDate, dr.title as apptDrive,
                                      dr.id as driveID, apt.id as aid
                                      FROM appointment apt INNER JOIN drive dr ON apt.drive_id = dr.id
                                      WHERE apt.donor_id = $uid and apt.status = 'Pending'
                                      ORDER BY apt.status DESC limit 1");
        $row2 = mysqli_fetch_assoc($check); 
        $apptStatus = $row2['apptStatus'];
        $apptDrive = $row2['apptDrive'];
        $driveID = $row2['driveID'];
        $apptDate0 = $row2['apptDate'];
        $aid = $row2['aid'];
        $apptDate= new DateTime($apptDate0);
        

 if (isset($_GET['del']))
    {
      $aid = $_GET['del'];

      mysqli_query($conn, "DELETE FROM appointment WHERE id=$aid");

      $message = 'Appointment cancelled.';

      echo "<script> 
        alert('$message')
        window.location.replace('donor_drives.php');
        </script>";
      //header('location: donor_drives.php?delete');
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
            
            <div class="ui one cards" style="width:100%; margin:auto; z-index:0">
                <?php if ($lastDonated == NULL AND $apptStatus >= 1) {?>
                    <div class="card">
                        <div class="content">
                          <div class="right floated ui image">
                                  <i class="circle yellow icon" style="font-size: 20px"></i> 
                          </div>
                        <div class="header"><?php echo $fullname;?></div><hr>
                          <div class="extra content">
                              You've already set an appointment on  <?php echo $apptDate->format('m/d/Y'); ?>
                              <br> with <?php echo $apptDrive; ?>.
                              <br><a href="donor_appointments.php"> Click Here </a> to view appointments.
                          </div>
                        </div>
                      </div>
                    </div>
                <?php } else if ($lastDonated != NULL AND $apptStatus >= 1) {?>
                    <div class="card">
                        <div class="content">
                          <div class="right floated ui image">
                                  <i class="circle yellow icon" style="font-size: 20px"></i> 
                          </div>
                        <div class="header"><?php echo $fullname;?></div><hr>
                            <div class="meta" >Last Donated: <?php echo $date->format('m/d/Y'); ?> </div><hr>
                          <div class="extra content">
                              You've already set an appointment on  <?php echo $apptDate->format('m/d/Y'); ?>
                              <br> with <?php echo $apptDrive; ?>.
                              <br><a href="donor_appointments.php"> Click Here </a> to view appointments.
                          </div>
                        </div>
                      </div>
                    </div>
                <?php } else if($lastDonated != "" AND $dateAvailable <= $dateToday)  { ?>
                    <div class="card">
                        <div class="content">
                          <div class="right floated ui image">
                                  <i class="circle green icon" style="font-size: 20px"></i> 

                          </div>
                        <div class="header"><?php echo $fullname;?></div>
                            <div class="meta" >Last Donated: <?php echo $date->format('m/d/Y'); ?> </div><hr>
                          <div class="extra content">
                              You're eligible to donate!<br>Select a Blood Drive to set your appointment.
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }else if($lastDonated != "" AND $dateLast < $dateAvailable){?>
                    <div class="card">
                          <div class="content">
                            <div class="right floated ui image">
                                    <i class="circle red icon" style="font-size: 20px"></i> 
                            </div>
                          <div class="header"><?php echo $fullname;?></div>
                              <div class="meta" >Last Donated: <?php echo $date->format('m/d/Y'); ?> </div><hr>
                            <div class="extra content">
                                Sorry but you're not eligible to donate.<br> Please wait until <?php echo $date4->format('m/d/Y'); ?>
                            </div>
                          </div>
                        </div>
                      </div>
                <?php } else { ?>
                  <div class="card">
                        <div class="content">
                          <div class="right floated ui image">
                                  <i class="circle green icon" style="font-size: 20px"></i> 
                          </div>
                        <div class="header"><?php echo $fullname;?></div>
                            <div class="meta" >You have not donated yet. </div><hr>
                            <div class="extra content">
                              You're eligible to donate!<br>Select a Blood Drive to set your appointment.
                          </div>
                        </div>
                      </div>
                    </div>
                <?php } ?>

                <table class="ui celled unstackable table">

                  <thead>
                    <tr>
                    <th>Donation Drives</th>
                    <th>Date Start</th>
                    <th>Date End</th>
                    <th>Status</th>
                    </tr>
                </thead>

                  <tbody>
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td data-label="Title">
                                  <a href="donor_drives_view.php?view=<?php echo $row['id']; ?>" target="_self">
                                    <b>
                                      <?php echo $row['title']; ?>
                                    </b>
                                  </a>

                                  <br>

                                  <?php echo $row['city']; ?>
                                </td>
                                <td data-label="Date Start" style="width:100px"><?php echo $row['date_start']; ?></td>
                                <td data-label="Date End" style="width:100px"><?php echo $row['date_end']; ?></td>
                                <td data-label="Status" style="text-align:center">
                                        <?php if ($row['status'] = 'Approved') {?>
                                            Looking for Donors
                                        <?php } else {?>
                                            <?php echo $row['status']; ?>
                                       <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                  </tbody>
                </table>
                
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
