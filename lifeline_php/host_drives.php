<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }

  $uid = $_SESSION["userid"];
  
  $results = mysqli_query($conn, "SELECT * FROM drive WHERE host_id = $uid AND status IN ('On Going') ORDER BY status asc");

  $result1= mysqli_query($conn, "SELECT COUNT(status) AS count FROM drive WHERE host_id = $uid AND status IN ('On Going')");
  $row1 = mysqli_fetch_assoc($result1); 
  $count1 = $row1['count'];

  $result2 = mysqli_query($conn, "SELECT COUNT(status) AS count FROM drive WHERE host_id = $uid AND status IN ('Pending')");
  $row2 = mysqli_fetch_assoc($result2); 
  $count2 = $row2['count'];

  $result3 = mysqli_query($conn, "SELECT COUNT(status) AS count FROM drive WHERE host_id = $uid");
  $row3 = mysqli_fetch_assoc($result3); 
  $count3 = $row3['count'];

  if (isset($_GET['tableud']))
    {
        $getStatus = $_GET['tableud'];

        if ($getStatus == "Pending"){
            $results = mysqli_query($conn, "SELECT * FROM drive WHERE host_id = $uid AND status IN ('Pending') ORDER BY id asc");
        }

        else if ($getStatus == "Approved"){
            $results = mysqli_query($conn, "SELECT * FROM drive WHERE host_id = $uid AND status IN ('Approved') ORDER BY id asc");
        }

        else if ($getStatus == "Ongoing"){
            $results = mysqli_query($conn, "SELECT * FROM drive WHERE host_id = $uid AND status IN ('On Going') ORDER BY id asc");
        }

        else if ($getStatus == "Rejected"){
            $results = mysqli_query($conn, "SELECT * FROM drive WHERE host_id = $uid AND status IN ('Rejected') ORDER BY id asc");
        }

        else if ($getStatus == "Done"){
            $results = mysqli_query($conn, "SELECT * FROM drive WHERE host_id = $uid AND status IN ('Done') ORDER BY id asc");
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
                                My Donation Drives
                            </h4>
                    </div> 
                </div>

                <a href="host_drives_add.php"><div class="ui icon primary button" style="right: 0; top:650px; border-radius:30px;
                                position: absolute; margin:0px 17px 30px 0px; z-index:1; width:60px; height:60px;
                                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);">
                    <i class="add icon" style="font-size:30px;padding:12px 0 0 0px"></i>
                </div></a>
            </div>


            <div class="main" style="padding:20px">

            <div class="ui three cards" style="width:100%; margin:auto; z-index:0">
                <div class="card">
                    <div class="content">
                    <div class="left floated ui image">
                        <i class="spinner yellow icon" style="font-size: 20px"></i> 
                    </div>
                    <div class="header">
                        <?php echo $count2; ?>
                    </div>
                    <div class="meta">
                        Pending
                    </div>
                    </div>
                </div>

                <div class="card">
                    <div class="content">
                    <div class="left floated ui image">
                        <i class="calendar check outline green icon" style="font-size: 20px"></i> 
                    </div>
                    <div class="header">
                        <?php echo $count1; ?>
                    </div>
                    <div class="meta" style="font-size: 12px">
                        On Going
                    </div>
                    </div>
                </div>


                <div class="card">
                    <div class="content">
                    <div class="left floated ui image">
                        <i class="bookmark outline grey icon" style="font-size: 20px"></i> 
                    </div>
                    <div class="header">
                        <?php echo $count3; ?>
                    </div>
                    <div class="meta">
                        Total
                    </div>
                    </div>
                </div>
          </div>

          <div class="ui form" style="width:98%; margin:auto">
                    <div class="field"> 
                                    <div class="ui selection" >
                                            <select class="form-select" onchange="location = this.value;">
                                                <option disabled="disabled" selected="selected">Status</option>
                                                <option value="host_drives.php?tableud=Pending">Pending</option>
                                                <option value="host_drives.php?tableud=Approved ">Approved</option>
                                                <option value="host_drives.php?tableud=Ongoing">On Going</option>
                                                <option value="host_drives.php?tableud=Rejected">Rejected</option>
                                                <option value="host_drives.php?tableud=Done">Done</option>
                                            </select>
                                    </div>
                      </div>
                </div>

          <div class="ui cards" style="width:100%; margin:auto; z-index:0">
          

                <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <div class="card" style="width:100%">
                            <div class="content">
                            <div class="right floated ui image">

                                <?php if($row['status'] == 'Pending'){ ?>
                                    <i class="circle yellow icon" style="font-size: 20px"></i> 

                                <?php } else if ($row['status'] == 'Approved'){?>
                                    <i class="circle blue icon" style="font-size: 20px"></i> 

                                <?php } else if ($row['status'] == 'On Going'){?>
                                    <i class="circle green icon" style="font-size: 20px"></i> 

                                <?php } else if ($row['status'] == 'Rejected'){?>
                                    <i class="circle red icon" style="font-size: 20px"></i> 

                                <?php } else if ($row['status'] == 'Done'){?>
                                    <i class="circle grey icon" style="font-size: 20px"></i> 

                                <?php } ?>

                            </div>
                            <div class="header">
                                <?php echo $row['title']; ?>
                            </div>
                            <div class="meta">
                                <?php echo $row['city']; ?>
                            </div>
                            <div class="description">
                                <b>Date:</b> <?php echo date("m/d/Y", strtotime($row['date_start'])); ?> to <?php echo date("m/d/Y", strtotime($row['date_end'])); ?>
                                <br><b>Time:</b> <?php echo date("H:i", strtotime($row['time_start'])); ?> to <?php echo date("H:i", strtotime($row['time_end'])); ?>
                                <br><b>Status:</b> <?php echo $row['status']; ?>
                                <?php if($row['status'] == 'Approved') { ?>
                                    <br><b>No. of Appointments:</b>

                                    <?php 
                                        $drive_id = $row['id']; 
                                        $ctrAppointments = mysqli_query($conn, "SELECT COUNT(id) AS count FROM appointment WHERE drive_id = $drive_id");
                                        $rowAppointments = mysqli_fetch_assoc($ctrAppointments); 
                                        echo $count3 = $rowAppointments['count'];
                                    ?>

                                <?php } else if($row['status'] == 'Done') { ?>
                                    <br><b>No. of Donations:</b>

                                    <?php 
                                        $drive_id = $row['id']; 
                                        $ctrAppointments = mysqli_query($conn, "SELECT COUNT(id) AS count FROM donation WHERE drive_id = $drive_id");
                                        $rowAppointments = mysqli_fetch_assoc($ctrAppointments); 
                                        echo $count3 = $rowAppointments['count'];
                                    ?>

                                <?php } else if($row['status'] == 'On Going') { ?>
                                    <br><b>No. of Appointments:</b>

                                    <?php 
                                        $drive_id = $row['id']; 
                                        $ctrAppointments = mysqli_query($conn, "SELECT COUNT(id) AS count FROM appointment WHERE drive_id = $drive_id");
                                        $rowAppointments = mysqli_fetch_assoc($ctrAppointments); 
                                        echo $count3 = $rowAppointments['count'];
                                    ?>

                                    <br><b>No. of Donations:</b>

                                    <?php 
                                        $drive_id = $row['id']; 
                                        $ctrAppointments = mysqli_query($conn, "SELECT COUNT(id) AS count FROM donation WHERE drive_id = $drive_id");
                                        $rowAppointments = mysqli_fetch_assoc($ctrAppointments); 
                                        echo $count3 = $rowAppointments['count'];
                                    ?>

                                <?php } ?>
                            </div>
                            </div>
                                <div class="extra content">
                                        <div class="ui three buttons">
                                        <?php if($row['status'] == 'Pending' || $row['status'] == 'Rejected') { ?>
                                            <a class="ui basic blue button" href="host_drives_view.php?view=<?php echo $row['id']; ?>">Details</a>
                                        <?php } else if($row['status'] == 'Done') { ?>
                                            <a class="ui basic green button" href="host_donations_list.php?view=<?php echo $row['id']; ?>">Donations</a>
                                            <a class="ui basic blue button" href="host_drives_view.php?view=<?php echo $row['id']; ?>">Details</a>
                                        <?php } else if($row['status'] == 'On Going') { ?>
                                            <a class="ui basic green button" href="host_appointments_list.php?view=<?php echo $row['id']; ?>">Appointments</a>
                                            <a class="ui basic green button" href="host_donations_list.php?view=<?php echo $row['id']; ?>">Donations</a>
                                            <a class="ui basic blue button" href="host_drives_view.php?view=<?php echo $row['id']; ?>">Details</a>
                                        <?php } else {?>
                                            <a class="ui basic green button" href="host_appointments_list.php?view=<?php echo $row['id']; ?>">Appointments</a>
                                            <a class="ui basic blue button" href="host_drives_view.php?view=<?php echo $row['id']; ?>">Details</a>
                                        <?php } ?>
                                        </div>
                                </div>
                        </div>
                <?php } ?>


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
