<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }

  $fullname = $_SESSION["usernm"];
  
  $result1= mysqli_query($conn, "SELECT COUNT(id) AS count FROM drive WHERE status IN ('Pending')");
  $row1 = mysqli_fetch_assoc($result1); 
  $count1 = $row1['count'];

  $result5 = mysqli_query($conn, "SELECT COUNT(id) AS count FROM donation WHERE confirm IN ('Pending') ");
  $row5 = mysqli_fetch_assoc($result5); 
  $count2 = $row5['count'];

  $result3 = mysqli_query($conn, "SELECT COUNT(id) AS count FROM drive WHERE status IN ('On Going') ");
  $row3 = mysqli_fetch_assoc($result3); 
  $count3 = $row3['count'];

  $result4 = mysqli_query($conn, "SELECT COUNT(id) AS count FROM donation WHERE tracking IN ('In Storage') ");
  $row4 = mysqli_fetch_assoc($result4); 
  $count4 = $row4['count'];

  $norows = false;
  $results_hosts = mysqli_query($conn, "SELECT h.orgname, dr.host_id, count(dr.host_id) as count FROM drive dr INNER JOIN host h ON dr.host_id = h.id GROUP BY dr.host_id ORDER BY count DESC LIMIT 3");
  $results_donors = mysqli_query($conn, "SELECT h.name, dr.donor_id, count(dr.donor_id) as count FROM donation dr INNER JOIN donor h ON dr.donor_id = h.id GROUP BY dr.donor_id ORDER BY count DESC LIMIT 3");
  if($results_donors->num_rows === 0)
  {
    $norows = true;
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
                        <a href="admin_home.php" class="active item" style="color: #E50914; font-size:13px; margin:5px">Dashboard</a>
                        <a href="admin_drives.php" class="item " style="font-size:13px; margin:5px">Blood Drives</a>
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

            <div class="ui one cards" style="width:100%; margin:auto; z-index:0">
                          <div class="card">
                          <div class="content">
                            <div class="right floated ui image">
                                    <i class="user blue icon" style="font-size: 20px"></i> 
                            </div>
                          <div class="header">Welcome back, Admin!</div>
                            <div class="extra content">
                                Donors, Hosts & Donation Drives  Overview
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
                                        Pending Donations Verification
                                      </div>
                                    </div>
                                  </div>
                            </div>

                          <div class="ui two cards" style="width:100%; margin:auto; z-index:0">
                                <div class="card">
                                  <div class="content">
                                    <div class="left floated ui image">
                                      <i class="ambulance green icon" style="font-size: 20px"></i> 
                                    </div>
                                    <div class="header">
                                        <?php echo $count3; ?>
                                    </div>
                                    <div class="meta">
                                      On Going Donation Drives
                                    </div>
                                  </div>
                                </div>

                                <div class="card">
                                  <div class="content">
                                    <div class="left floated ui image">
                                      <i class="tint red icon" style="font-size: 20px"></i> 
                                    </div>
                                    <div class="header">
                                        <?php echo $count4; ?>
                                    </div>
                                    <div class="meta">
                                      Blood Donations In Storage
                                    </div>
                                  </div>
                                </div>
                          </div>

                          <div class="ui one cards" style="width:100%; margin:auto; z-index:0">
                              <div class="card">
                              <div class="content">
                                <div class="header">Top Hosts</div>
                                <div class="meta">
                                     Hosts with most donation drives
                                </div>

                                <?php while ($row = mysqli_fetch_array($results_hosts)) { ?>
                                      <div class="ui list">
                                          <div class="item">
                                            <i class="hospital outline icon"></i>
                                              <div class="content">
                                                      <?php echo $row['orgname']; ?><br><?php echo $row['count']; ?> Donation Drives
                                              </div>
                                          </div>
                                      </div>
                                  <?php } ?>

                            </div>
                          </div>

                          <div class="ui one cards" style="width:100%; margin:auto; z-index:0">
                              <div class="card">
                              <div class="content">
                                <div class="header">Top Donors</div>
                                <div class="meta">
                                     Donors with most donations
                                </div>

                                
                                <?php if ($norows != true) { ?>
                                  <?php while ($row2 = mysqli_fetch_array($results_donors)) { ?>
                                        <div class="ui list">
                                            <div class="item">
                                              <i class="user outline icon"></i>
                                                <div class="content">
                                                        <?php echo $row2['name']; ?><br><?php echo $row2['count']; ?> Donations
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                  <?php } else { ?>
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
