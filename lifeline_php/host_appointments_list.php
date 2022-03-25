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
        $drive_id = $_GET['view'];

        $result5= mysqli_query($conn, "SELECT status FROM drive WHERE id = $drive_id");
        $row5 = mysqli_fetch_assoc($result5); 
        $aptStatus = $row5['status'];

        $result1= mysqli_query($conn, "SELECT COUNT(id) AS count FROM appointment WHERE drive_id = $drive_id AND status='Pending'");
        $row1 = mysqli_fetch_assoc($result1); 
        $count1 = $row1['count'];

        $result2 = mysqli_query($conn, "SELECT COUNT(apt.id) AS count FROM appointment apt INNER JOIN donation dn ON apt.drive_id = dn.drive_id AND apt.donor_id = dn.donor_id
                                        WHERE apt.drive_id = $drive_id AND dn.confirm IN ('Pending')");
        $row2 = mysqli_fetch_assoc($result2); 
        $count2 = $row2['count'];

        $result3 = mysqli_query($conn, "SELECT COUNT(apt.id) AS count FROM appointment apt INNER JOIN donation dn ON apt.drive_id = dn.drive_id AND apt.donor_id = dn.donor_id
                                        WHERE apt.drive_id = $drive_id AND dn.confirm IN ('Approved')");
        $row3 = mysqli_fetch_assoc($result3); 
        $count3 = $row3['count'];

        $result4 = mysqli_query($conn, "SELECT COUNT(apt.id) AS count FROM appointment apt INNER JOIN donation dn ON apt.drive_id = dn.drive_id AND apt.donor_id = dn.donor_id
                                        WHERE apt.drive_id = $drive_id AND dn.confirm IN ('Rejected')");
        $row4 = mysqli_fetch_assoc($result4); 
        $count4 = $row4['count'];

        $results = mysqli_query($conn, "SELECT apt.id, dn.name, dn.blood_type, dn.blood_rh, apt.date, apt.time, apt.datetime, apt.status, apt.drive_id, apt.donor_id
                                        FROM appointment apt INNER JOIN donor dn ON dn.id = apt.donor_id
                                        WHERE apt.drive_id = $drive_id ORDER BY apt.status desc");
    }

     if (isset($_GET['donated']))
      {
            $apt_id = $_GET['donated'];

            $rec = mysqli_query($conn, "SELECT * FROM appointment INNER JOIN donor ON appointment.donor_id = donor.id WHERE appointment.id = $apt_id");
            $record = mysqli_fetch_array($rec);
        
            $donor_id = $record['donor_id'];
            $drive_id = $record['drive_id'];
            $blood_type = $record['blood_type'];
            $blood_rh = $record['blood_rh'];

            // update appointment
            $status_apt = "Done";
  
            mysqli_query($conn, "UPDATE appointment SET status = '$status_apt' WHERE id=$apt_id")
                                    or die( mysqli_error($conn));

            //update donor
            $status_donor = "Pending";

            mysqli_query($conn, "UPDATE donor SET available = '$status_donor' WHERE id=$donor_id")
                                    or die( mysqli_error($conn));

            //create donation
            $blood_code = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 7)), 0, 7);

            $query = "INSERT INTO donation (donor_id, drive_id, blood_code, blood_type, blood_rh)
                        VALUES ('$donor_id','$drive_id', '$blood_code','$blood_type','$blood_rh')";
                            
            mysqli_query($conn, $query);


            $message = 'Donation successfully recorded.';

            echo "<script> 
              alert('$message')
              window.location.replace('host_appointments_list.php?view='.$drive_id');
              </script>";
            //header('location: host_appointments_list.php?view='.$drive_id);
  
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
        <title>Appointments</title>
        
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
                        <a href="host_home.php" class=" item" style="font-size:13px; margin:5px">Home</a>
                        <a href="host_drives.php" class="active item " style="color: #E50914; font-size:13px; margin:5px">Blood Drives</a>
                        <a href="host_donations.php" class="item " style="font-size:13px; margin:5px">Donations</a>
                        <a href="host_info.php" class="item " style="font-size:13px; margin:5px">How to host</a>
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

                <div style="position: sticky; z-index:2;  top: 0; ">
                <div class="ui grid" style="width:100%; background-color: white;margin-bottom:10px;
                            border-bottom: 5px; -webkit-box-shadow: 0 4px 6px -6px #222;
                            -moz-box-shadow: 0 4px 6px -6px #222; box-shadow: 0 4px 6px -6px #222;">
                    <div class="eight wide column">
                        <button class="openbtn" onclick="openNav()" style="font-size:25px; margin-left:20px;background:transparent">
                                <i class="th icon"></i> 
                        </button>  
                    </div>
                    <div class="eight wide column">
                            <h4 style="text-align: right; color:#E50914; font-size:20px; padding: 10px 15px; margin-right:12px">
                                Appointments
                            </h4>
                    </div> 
                </div>
            </div>


            <div class="main" style="padding:20px">

            <div class="ui two cards" style="width:100%; margin:auto; z-index:0">
                <div class="card">
                    <div class="content">
                    <div class="left floated ui image">
                        <i class="calendar alternate outline blue icon" style="font-size: 20px"></i> 
                    </div>
                    <div class="header">
                        <?php echo $count1; ?>
                    </div>
                    <div class="meta">
                        Scheduled
                    </div>
                    </div>
                </div>

                <div class="card">
                    <div class="content">
                    <div class="left floated ui image">
                        <i class="spinner yellow icon" style="font-size: 20px"></i> 
                    </div>
                    <div class="header">
                        <?php echo $count2; ?>
                    </div>
                    <div class="meta">
                        Pending Donations
                    </div>
                    </div>
                </div>

                <div class="card">
                    <div class="content">
                    <div class="left floated ui image">
                        <i class="thumbs up outline green icon" style="font-size: 20px"></i> 
                    </div>
                    <div class="header">
                        <?php echo $count3; ?>
                    </div>
                    <div class="meta">
                        Approved Donations
                    </div>
                    </div>
                </div>

                <div class="card">
                    <div class="content">
                    <div class="left floated ui image">
                        <i class="thumbs down outline red icon" style="font-size: 20px"></i> 
                    </div>
                    <div class="header">
                        <?php echo $count4; ?>
                    </div>
                    <div class="meta">
                        Rejected Donations
                    </div>
                    </div>
                </div>
          </div>

          <table class="ui celled unstackable table">

            <thead>
            <tr>
            <th>Donor Info</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td data-label="Donor">
                            <b>
                                <?php echo $row['name']; ?>
                            </b>

                            <br>

                            <?php echo $row['blood_type']; ?> <?php echo $row['blood_rh']; ?>
                        </td>
                        <td data-label="Date Start" style="width:100px"><?php echo $row['date']; ?></td>
                        <td data-label="Date End" style="width:100px"><?php echo $row['time']; ?></td>
                        <td><?php echo $row['status']; ?></td>

                            <?php if ($row['status'] == 'Pending' AND $aptStatus == 'On Going') { ?>
                                <td data-label="Actions" style="text-align:center">
                                <a href="host_appointments_list.php?donated=<?php echo $row['id']; ?>" target="_self">
                                                <i class="check circle green icon" style="font-size: 20px"></i>
                                </a>
                            </td>
                            <?php } else { ?>
                                <td></td>
                            <?php } ?>

                    </tr>
                <?php } ?>
            </tbody>
            </table>


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
