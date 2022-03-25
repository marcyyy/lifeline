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

            $rec = mysqli_query($conn, "SELECT * FROM drive WHERE id = $drive_id");
            $record = mysqli_fetch_array($rec);
        
            $id = $record['id'];
            $title = $record['title'];
            $city = $record['city'];
            $details = $record['details'];
            $location = $record['location'];
            $status = $record['status'];
            $date_start = $record['date_start'];
            $date_end = $record['date_end'];
            $time_start = $record['time_start'];
            $time_end = $record['time_end'];

        }

    if (isset($_GET['cancel']))
      {
            $drive_id = $_GET['cancel'];

            $status_drive = "Done";
            $id = $drive_id;
  
            mysqli_query($conn, "UPDATE drive SET status = '$status_drive' WHERE id=$id")
                                    or die( mysqli_error($conn));


            $status_appt = "Cancelled";

            mysqli_query($conn, "UPDATE appointment SET status = '$status_appt' WHERE drive_id=$id AND status='Pending'")
                                    or die( mysqli_error($conn));

            $message = 'Donation Drive set to Cancelled.';

            echo "<script> 
              alert('$message')
              window.location.replace('host_drives.php');
              </script>";
            //header('location: host_drives.php?sub=update');
  
      } 

      if (isset($_GET['ongoing']))
        {
              $drive_id = $_GET['ongoing'];
  
              $status_drive = "On Going";
              $id = $drive_id;
    
              mysqli_query($conn, "UPDATE drive SET status = '$status_drive' WHERE id=$id")
                                      or die( mysqli_error($conn));
  
            $message = 'Donation Drive set to On Going.';

            echo "<script> 
              alert('$message')
              window.location.replace('host_drives.php');
              </script>";
              //header('location: host_drives.php?sub=update');
    
        } 

        if (isset($_GET['done']))
          {
                $drive_id = $_GET['done'];
    
                $status_drive = "Done";
                $id = $drive_id;
      
                mysqli_query($conn, "UPDATE drive SET status = '$status_drive' WHERE id=$id")
                                        or die( mysqli_error($conn));
    
    
                $status_appt = "Cancelled";
    
                mysqli_query($conn, "UPDATE appointment SET status = '$status_appt' WHERE drive_id=$id AND status='Pending'")
                                        or die( mysqli_error($conn));
    
            $message = 'Donation Drive set to done.';

            echo "<script> 
              alert('$message')
              window.location.replace('host_drives.php');
              </script>";
                //header('location: host_drives.php?sub=update');
      
          } 
      
      if (isset($_GET['del']))
      {
        $drive_id = $_GET['del'];
  
        mysqli_query($conn, "DELETE FROM drive WHERE id=$drive_id");

        $message = 'Donation Drive successfully removed.';

        echo "<script> 
          alert('$message')
          window.location.replace('host_drives.php');
          </script>";
        //header('location: host_drives.php?delete');
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
                                My Donation Drive
                            </h4>
                    </div> 
                </div>
            </div>


            <div class="main" style="padding:20px">

          <div class="ui cards" style="width:100%; margin:auto; z-index:0">
          
                        <div class="card" style="width:100%">
                            <div class="content">
                            <div class="right floated ui image">

                                <?php if($status == 'Pending'){ ?>
                                    <i class="circle yellow icon" style="font-size: 20px"></i> 

                                <?php } else if ($status == 'Approved'){?>
                                    <i class="circle blue icon" style="font-size: 20px"></i> 

                                <?php } else if ($status == 'On Going'){?>
                                    <i class="circle green icon" style="font-size: 20px"></i> 

                                <?php } else if ($status == 'Rejected'){?>
                                    <i class="circle red icon" style="font-size: 20px"></i> 

                                <?php } else if ($status == 'Done'){?>
                                    <i class="circle grey icon" style="font-size: 20px"></i> 

                                <?php } ?>

                            </div>
                            <div class="header">
                                <?php echo $title; ?>
                            </div>
                            <div class="meta">
                                <?php echo $city; ?>
                            </div>
                                <div class="ui list" style="text-align: justify; text-justify: inter-word; padding:0px 10px 5px 10px; margin-top:10px">
                                    <a class="item">
                                        <i class="caret right icon"></i>
                                        <div class="content">
                                        <div class="header">Details</div>
                                        <div class="description"><?php echo $details; ?></div>
                                        </div>
                                    </a>
                                    <a class="item">
                                        <i class="caret right icon"></i>
                                        <div class="content">
                                        <div class="header">Location</div>
                                        <div class="description"><?php echo $location; ?></div>
                                        </div>
                                    </a>
                                    <a class="item">
                                        <i class="caret right icon"></i>
                                        <div class="content">
                                        <div class="header">Date</div>
                                        <div class="description"><?php echo date("m/d/Y", strtotime($date_start)); ?> to <?php echo date("m/d/Y", strtotime($date_end)); ?></div>
                                        </div>
                                    </a>
                                    <a class="item">
                                        <i class="caret right icon"></i>
                                        <div class="content">
                                        <div class="header">Time</div>
                                        <div class="description"><?php echo date("H:i", strtotime($time_start)); ?> to <?php echo date("H:i", strtotime($time_end)); ?></div>
                                        </div>
                                    </a>
                                    <a class="item">
                                        <i class="caret right icon"></i>
                                        <div class="content">
                                        <div class="header">Status</div>
                                        <div class="description"><?php echo $status; ?></div>
                                        </div>
                                    </a>
                                    <?php if($status == 'Approved') { ?>
                                        <a class="item">
                                            <i class="caret right icon"></i>
                                            <div class="content">
                                            <div class="header">No. of Appointments</div>
                                            <div class="description">
                                                <?php 
                                                    $drive_id = $id; 
                                                    $ctrAppointments = mysqli_query($conn, "SELECT COUNT(id) AS count FROM appointment WHERE drive_id = $drive_id");
                                                    $rowAppointments = mysqli_fetch_assoc($ctrAppointments); 
                                                    echo $count3 = $rowAppointments['count'];
                                                ?>
                                            </div>
                                            </div>
                                        </a>
                                    <?php } else if($status == 'Done') { ?>
                                        <a class="item">
                                            <i class="caret right icon"></i>
                                            <div class="content">
                                            <div class="header">No. of Donations</div>
                                            <div class="description">
                                                <?php 
                                                    $drive_id = $id; 
                                                    $ctrAppointments = mysqli_query($conn, "SELECT COUNT(id) AS count FROM donation WHERE drive_id = $drive_id");
                                                    $rowAppointments = mysqli_fetch_assoc($ctrAppointments); 
                                                    echo $count3 = $rowAppointments['count'];
                                                ?>
                                            </div>
                                            </div>
                                        </a>
                                    <?php } else if($status == 'On Going') { ?>
                                        <a class="item">
                                            <i class="caret right icon"></i>
                                            <div class="content">
                                            <div class="header">No. of Appointments</div>
                                            <div class="description">
                                                <?php 
                                                    $drive_id = $id; 
                                                    $ctrAppointments = mysqli_query($conn, "SELECT COUNT(id) AS count FROM appointment WHERE drive_id = $drive_id");
                                                    $rowAppointments = mysqli_fetch_assoc($ctrAppointments); 
                                                    echo $count3 = $rowAppointments['count'];
                                                ?>
                                            </div>
                                            </div>
                                        </a>
                                        <a class="item">
                                            <i class="caret right icon"></i>
                                            <div class="content">
                                            <div class="header">No. of Donations</div>
                                            <div class="description">
                                                <?php 
                                                    $drive_id = $id; 
                                                    $ctrAppointments = mysqli_query($conn, "SELECT COUNT(id) AS count FROM donation WHERE drive_id = $drive_id");
                                                    $rowAppointments = mysqli_fetch_assoc($ctrAppointments); 
                                                    echo $count3 = $rowAppointments['count'];
                                                ?>
                                            </div>
                                            </div>
                                        </a>
                                    <?php } ?>


                                    </div>

                            </div>

                            <div class="extra content">
                                <?php if($status == 'Approved') { ?>
                                        <div class="ui two buttons">
                                            <a class="ui basic green button" href="host_drives_view.php?ongoing=<?php echo $id; ?>">Set as On Going</a>
                                            <a class="ui basic red button" href="host_drives_view.php?cancel=<?php echo $id; ?>">Cancel Donation Drive</a>
                                        </div>
                                        <div class="ui two buttons">
                                            <a class="ui basic secondary button" href="#" onclick="history.back();">Back</a>
                                        </div>
                                    </a>
                                <?php } else if($status == 'Pending') { ?>
                                        <div class="ui two buttons">
                                            <a class="ui basic secondary button" href="#" onclick="history.back();">Back</a>
                                            <a class="ui basic red button" href="host_drives_view.php?del=<?php echo $id; ?>">Remove Donation Drive</a>
                                        </div>
                                <?php } else if($status == 'On Going') { ?>
                                        <div class="ui two buttons">
                                            <a class="ui basic secondary button" href="#" onclick="history.back();">Back</a>
                                            <a class="ui basic blue button" href="host_drives_view.php?done=<?php echo $id; ?>">Set as Done</a>
                                        </div>
                                <?php } else { ?>
                                        <div class="ui two buttons">
                                            <a class="ui basic secondary button" href="#" onclick="history.back();">Back</a>
                                        </div>
                                <?php } ?>
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
