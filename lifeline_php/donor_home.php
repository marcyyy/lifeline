<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }

  $fullname = $_SESSION["usernm"];
  $doid = $_SESSION["userid"];
  
  $result1= mysqli_query($conn, "SELECT count(id) as count FROM donation WHERE donation.donor_id = $doid");
  $row1 = mysqli_fetch_assoc($result1); 
  $count1 = $row1['count'];

  $results_apt = mysqli_query($conn, "SELECT * FROM appointment apt INNER JOIN drive dr ON apt.drive_id = dr.id WHERE apt.donor_id = $doid AND apt.status IN ('Pending') ORDER BY apt.id DESC LIMIT 1");
  
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
                        <a href="donor_home.php" class="active item" style="color: #E50914; font-size:13px; margin:5px">Home</a>
                        <a href="donor_appointments.php" class="item " style="font-size:13px; margin:5px">Appointments</a>
                        <a href="donor_donations.php" class="item " style="font-size:13px; margin:5px">Donations</a>
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
                            Welcome
                        </h4>
                </div> 
            </div>


            <div class="main" style="padding:20px">

            <div class="ui one cards" style="width:100%; margin:auto; z-index:0">
                          <div class="card">
                          <div class="content">
                          <div class="header">Welcome back, <?php echo $fullname;?>!</div>
                            <div class="extra content">
                                Your Appointments & Donations Overview
                            </div>

                            <div class="ui one cards" style="width:100%; margin:auto; z-index:0">
                                  <div class="card">
                                  <div class="content">
                                    
                                  <?php if ($results_apt->num_rows !== 0) {?>
                                  <?php while ($row = mysqli_fetch_array($results_apt)) { ?>
                                        <div class="right floated ui image">
                                          <i class="circle yellow icon" style="font-size: 20px"></i> 
                                          </div>
                                              <div class="header" style="font-size:17px;">
                                                  <a href="donor_drives_view.php?view=<?php echo $row['id']; ?>">
                                                      <?php echo $row['title']; ?>
                                                  </a>
                                              </div>
                                          <div class="extra content">
                                              Address | <?php echo $row['location']; 
                                              ?>  <br>
                                              Date | <?php $d_s = $row['date']; 
                                                    $date_s= new DateTime($d_s);
                                                    echo $date_s->format('m/d/Y');
                                              ?><br>
                                              Time | <?php $t_s = $row['time']; 
                                                    $time_s= new DateTime($t_s);
                                                    echo $time_s->format('H:i');
                                              ?>
                                          </div>

                                  <?php } ?>

                                      <?php } else {?>
                                         
                                        <div class="right floated ui image">
                                          <i class="circle grey icon" style="font-size: 20px"></i> 
                                        </div>
                                            <div class="header" style="font-size:17px;">
                                                You have no pending appointments.
                                            </div>
                                        <div class="extra content">
                                            Click here to check active <a href="donor_drives.php">donation drives</a> now.
                                        </div>

                                  <?php } ?>

                              </div>  
                            </div>

                            <div class="ui one cards" style="width:100%; margin:auto; z-index:0">
                                  <div class="card">
                                  <div class="content">
                                  <?php if ($count1 == 0) {?>
                                      <div class="right floated ui image">
                                              <i class="shield grey icon" style="font-size: 30px"></i> 
                                      </div>
                                    <div class="header" style="font-size:17px;">You have donated <?php echo $count1;?> times.</div>
                                      <div class="extra content">
                                          Donate now and help save lives!
                                      </div>
                                  <?php } else if ($count1 >= 1 AND $count1 <= 5) {?>
                                      <div class="right floated ui image">
                                              <i class="shield yellow icon" style="font-size: 30px"></i> 
                                      </div>
                                    <div class="header" style="font-size:17px;">You have donated <?php echo $count1;?> times!</div>
                                      <div class="extra content">
                                          You are given the novice donor badge.
                                      </div>
                                  <?php } else if ($count1 >= 6 AND $count1 <= 20) {?>
                                      <div class="right floated ui image">
                                              <i class="shield green icon" style="font-size: 30px"></i> 
                                      </div>
                                    <div class="header" style="font-size:17px;">You have donated <?php echo $count1;?> times!</div>
                                      <div class="extra content">
                                          You are given the regular donor badge.
                                      </div>
                                  <?php } else if ($count1 >= 21 AND $count1 <= 50) {?>
                                      <div class="right floated ui image">
                                              <i class="shield blue icon" style="font-size: 30px"></i> 
                                      </div>
                                    <div class="header" style="font-size:17px;">You have donated <?php echo $count1;?> times!</div>
                                      <div class="extra content">
                                          You are given the recruit donor badge.
                                      </div>
                                  <?php } else if ($count1 >= 51) {?>
                                      <div class="right floated ui image">
                                              <i class="shield violet icon" style="font-size: 30px"></i> 
                                      </div>
                                    <div class="header" style="font-size:17px;">You have donated <?php echo $count1;?> times!</div>
                                      <div class="extra content">
                                          You are given the veteran donor badge.
                                      </div>
                                  <?php } ?>

                              </div>  
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
