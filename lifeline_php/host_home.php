<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }

  $fullname = $_SESSION["usernm"];
  $hid = $_SESSION["userid"];
  
  $result1= mysqli_query($conn, "SELECT COUNT(id) AS count FROM drive WHERE status IN ('Pending') AND host_id = $hid");
  $row1 = mysqli_fetch_assoc($result1); 
  $count1 = $row1['count'];

  $result5 = mysqli_query($conn, "SELECT COUNT(donation.id) AS count FROM donation INNER JOIN drive ON donation.drive_id = drive.id WHERE donation.tracking IN ('In Storage') AND drive.host_id = $hid ");
  $row5 = mysqli_fetch_assoc($result5); 
  $count2 = $row5['count'];

  $result3 = mysqli_query($conn, "SELECT COUNT(id) AS count FROM drive WHERE status IN ('Done') AND host_id = $hid");
  $row3 = mysqli_fetch_assoc($result3); 
  $count3 = $row3['count'];

  $result4 = mysqli_query($conn, "SELECT COUNT(donation.id) AS count FROM donation INNER JOIN drive ON donation.drive_id = drive.id WHERE donation.tracking IN ('Donated') AND drive.host_id = $hid");
  $row4 = mysqli_fetch_assoc($result4); 
  $count4 = $row4['count'];

  $norows = true;
  $results_ongoing = mysqli_query($conn, "SELECT dr.title, dr.date_start, dr.date_end, dr.time_start, dr.time_end, dr.id, dr.host_id,
                                                 count(apt.drive_id) as count FROM appointment apt INNER JOIN drive dr ON apt.drive_id = dr.id
                                                 WHERE dr.status IN ('On Going') AND dr.host_id = $hid");
  $ctr_rowog = mysqli_fetch_assoc($results_ongoing); 
  $id_rowog = $ctr_rowog['id'];
  if ($id_rowog != NULL){
    $results_ongoing = mysqli_query($conn, "SELECT dr.title, dr.date_start, dr.date_end, dr.time_start, dr.time_end, dr.id, dr.host_id,
                                                 count(apt.drive_id) as count FROM appointment apt INNER JOIN drive dr ON apt.drive_id = dr.id
                                                 WHERE dr.status IN ('On Going') AND dr.host_id = $hid");
    $norows = false;
  }
  else{
    $norows = true;
  }
                                                 
  $results_perform = mysqli_query($conn, "SELECT dr.title, count(dn.drive_id) as count FROM donation dn INNER JOIN drive dr ON dn.drive_id = dr.id WHERE dr.host_id = $hid GROUP BY dn.drive_id ORDER BY count DESC LIMIT 3");
  
  
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
                        <a href="host_home.php" class="active item" style="color: #E50914; font-size:13px; margin:5px">Home</a>
                        <a href="host_drives.php" class="item " style="font-size:13px; margin:5px">Blood Drives</a>
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

                <div class="ui grid" style="width:100%; background-color: white; position: sticky; top: 0; z-index:2; margin-bottom:10px;
                        border-bottom: 5px; -webkit-box-shadow: 0 4px 6px -6px #222; -moz-box-shadow: 0 4px 6px -6px #222; box-shadow: 0 4px 6px -6px #222;">
                <div class="eight wide column">
                    <button class="openbtn" onclick="openNav()" style="font-size:25px; margin-left:20px;background:transparent">
                            <i class="th icon"></i> 
                    </button>  
                </div>
                <div class="eight wide column">
                        <h4 style="text-align: right; color:#E50914; font-size:20px; padding: 10px 15px; margin-right:12px">
                            Dashboard
                        </h4>
                </div> 
            </div>


            <div class="main" style="padding:20px">

            <?php if ($norows == false) { ?>
              <?php while ($row_og = mysqli_fetch_array($results_ongoing)) { ?>
                  <div class="ui one cards" style="width:100%; margin:auto; z-index:0">
                      <div class="card">
                                <div class="content">
                                  <div class="right floated ui image">
                                          <i class="circle green icon" style="font-size: 20px"></i> 
                                  </div>
                                      <div class="header">
                                          <a href="host_appointments_list.php?view=<?php echo $row_og['id']; ?>">
                                              <?php echo $row_og['title']; ?>
                                          </a>
                                      </div>
                                  <div class="extra content">
                                      Appointments | <?php echo $row_og['count']; ?><br>
                                      Date | <?php $d_s = $row_og['date_start']; 
                                            $date_s= new DateTime($d_s);
                                            echo $date_s->format('m/d/Y');
                                      ?> to
                                      <?php $d_e = $row_og['date_end']; 
                                            $date_e= new DateTime($d_e);
                                            echo $date_e->format('m/d/Y');
                                      ?><br>
                                      Time | <?php $t_s = $row_og['time_start']; 
                                            $time_s= new DateTime($t_s);
                                            echo $time_s->format('H:i');
                                      ?> to
                                      <?php $t_e = $row_og['time_end']; 
                                            $time_e = new DateTime($t_e);
                                            echo $time_e->format('H:i');
                                      ?>
                                  </div>
                      </div>  
                  </div>  
                <?php } ?>
            <?php } else { ?>
              <div class="ui one cards" style="width:100%; margin:auto; z-index:0">
                      <div class="card">
                                <div class="content">
                                  <div class="right floated ui image">
                                          <i class="circle yellow icon" style="font-size: 20px"></i> 
                                  </div>
                                <div class="header">You have no on going donation drive.</div>
                                  
                                <?php if ($count1 >= 1) { ?>
                                        <div class="extra content">
                                            Please wait for your donation drive approval.
                                        </div>
                                <?php } else { ?>
                                        <div class="extra content">
                                            You may create a donation drive <a href="host_drives_add.php">here.</a>
                                        </div>
                                <?php } ?>

                      </div>  
                  </div>  
            <?php } ?>

            <div class="ui one cards" style="width:100%; margin:auto; z-index:0">
                          <div class="card">
                          <div class="content">
                          <div class="header">Welcome back, <?php echo $fullname ?>!</div>
                            <div class="extra content">
                                Donation Drives and Appointments Overview
                            </div>

                            <div class="ui two cards" style="width:100%; margin:auto; z-index:0">
                                  <div class="card">
                                    <div class="content">
                                      <div class="left floated ui image">
                                        <i class="bookmark yellow icon" style="font-size: 20px"></i> 
                                      </div>
                                      <div class="header">
                                        <?php echo $count1; ?>
                                      </div>
                                      <div class="meta">
                                        Pending Donation Drives
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="content">
                                      <div class="left floated ui image">
                                        <i class="tags violet icon" style="font-size: 20px"></i> 
                                      </div>
                                      <div class="header">
                                        <?php echo $count2; ?>
                                      </div>
                                      <div class="meta">
                                        In Storage Blood Donations
                                      </div>
                                    </div>
                                  </div>
                            </div>

                          <div class="ui two cards" style="width:100%; margin:auto; z-index:0">
                                <div class="card">
                                  <div class="content">
                                    <div class="left floated ui image">
                                      <i class="calendar check blue icon" style="font-size: 20px"></i> 
                                    </div>
                                    <div class="header">
                                        <?php echo $count3; ?>
                                    </div>
                                    <div class="meta">
                                      Concluded Donation Drives
                                    </div>
                                  </div>
                                </div>

                                <div class="card">
                                  <div class="content">
                                    <div class="left floated ui image">
                                      <i class="handshake red icon" style="font-size: 20px"></i> 
                                    </div>
                                    <div class="header">
                                        <?php echo $count4; ?>
                                    </div>
                                    <div class="meta">
                                      Granted Blood Donations
                                    </div>
                                  </div>
                                </div>
                          </div>

                          <div class="ui one cards" style="width:100%; margin:auto; z-index:0">
                              <div class="card">
                              <div class="content">
                                <div class="header">Top Donation Drives</div>
                                <div class="meta">
                                     My Top Performing Donation Drives
                                </div>

                                <?php if ($results_perform->num_rows >= 1) { ?>
                                  <?php while ($row_pd = mysqli_fetch_array($results_perform)) { ?>
                                        <div class="ui list">
                                            <div class="item">
                                              <i class="medkit icon"></i>
                                                <div class="content">
                                                        <?php echo $row_pd['title']; ?><br><?php echo $row_pd['count']; ?> Donations
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else {?>
                                        <div class="ui list">
                                            <div class="item">
                                              <i class="ban icon"></i>
                                                <div class="content">
                                                        No Donation has been done yet.
                                                </div>
                                            </div>
                                        </div>
                                <?php } ?>

                            </div>
                          </div>

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
