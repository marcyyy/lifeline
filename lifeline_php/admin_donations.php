<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }
  
  $result1= mysqli_query($conn, "SELECT COUNT(confirm) AS count FROM donation WHERE confirm ='Pending'");
  $row1 = mysqli_fetch_assoc($result1); 
  $count1 = $row1['count'];

  $result2 = mysqli_query($conn, "SELECT COUNT(confirm) AS count FROM donation WHERE tracking ='In Storage'");
  $row2 = mysqli_fetch_assoc($result2); 
  $count2 = $row2['count'];

  $result3 = mysqli_query($conn, "SELECT COUNT(confirm) AS count FROM donation WHERE confirm ='Rejected'");
  $row3 = mysqli_fetch_assoc($result3); 
  $count3 = $row3['count'];

  $result4 = mysqli_query($conn, "SELECT COUNT(id) AS count FROM donation WHERE confirm NOT IN ('Rejected')");
  $row4 = mysqli_fetch_assoc($result4); 
  $count4 = $row4['count'];

  $results = mysqli_query($conn, "SELECT donation.blood_code, donation.blood_type, donation.blood_rh, donation.datetime, donation.confirm, donation.id,
                                        drive.title FROM donation INNER JOIN drive ON donation.drive_id = drive.id
                                  WHERE donation.confirm NOT IN ('Rejected') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");

  
  $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
                                  WHERE donation.confirm NOT IN ('Rejected') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");
  $rowCtr = mysqli_fetch_assoc($resultsCtr);
  $dCount = $rowCtr['count'];                                                              


  if (isset($_GET['accept']))
    {
      $id = $_GET['accept'];

      mysqli_query($conn, "UPDATE donation SET confirm='Approved' WHERE id=$id");
      
      $message = 'Blood verification set to Approved.';

      echo "<script> 
        alert('$message')
        window.location.replace('admin_donations.php');
        </script>";
      //header('location: admin_donations.php?approvesuccess');
      }

  if (isset($_GET['decline']))
    {
      $id = $_GET['decline'];

      mysqli_query($conn, "UPDATE donation SET confirm='Rejected' AND tracking='Unavailable' WHERE id=$id");
      
      $message = 'Blood verificaton set to Rejected.';

      echo "<script> 
        alert('$message')
        window.location.replace('admin_donations.php');
        </script>";
      //header('location: admin_donations.php?declinesuccess');
    }


    if (isset($_GET['tableud']))
    {
        $blood_code = $_GET['tableud'];

        if ($blood_code == "A"){
            $results = mysqli_query($conn, "SELECT * FROM donation INNER JOIN drive ON donation.drive_id = drive.id
            WHERE donation.confirm NOT IN ('Rejected') AND donation.blood_type IN ('A') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");

  
            $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
            WHERE donation.confirm NOT IN ('Rejected') AND donation.blood_type IN ('A') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");
            $rowCtr = mysqli_fetch_assoc($resultsCtr);
            $dCount = $rowCtr['count'];                                                        
        }
        else if ($blood_code == "B"){
          $results = mysqli_query($conn, "SELECT * FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm NOT IN ('Rejected') AND donation.blood_type IN ('B') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");

  
          $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm NOT IN ('Rejected') AND donation.blood_type IN ('B') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");
          $rowCtr = mysqli_fetch_assoc($resultsCtr);
          $dCount = $rowCtr['count'];               
        }
        else if ($blood_code == "AB"){
          $results = mysqli_query($conn, "SELECT * FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm NOT IN ('Rejected') AND donation.blood_type IN ('AB') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");

          $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm NOT IN ('Rejected') AND donation.blood_type IN ('AB') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");
          $rowCtr = mysqli_fetch_assoc($resultsCtr);
          $dCount = $rowCtr['count'];               
        }
        else if ($blood_code == "O"){
          $results = mysqli_query($conn, "SELECT * FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm NOT IN ('Rejected') AND donation.blood_type IN ('O') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");

  
          $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm NOT IN ('Rejected') AND donation.blood_type IN ('O') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");
          $rowCtr = mysqli_fetch_assoc($resultsCtr);
          $dCount = $rowCtr['count'];               

        }
        else if ($blood_code == "All"){
          $results = mysqli_query($conn, "SELECT * FROM donation INNER JOIN drive ON donation.drive_id = drive.id
                                          WHERE donation.confirm NOT IN ('Rejected') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");
        
          
          $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm NOT IN ('Rejected') AND donation.tracking NOT IN ('Donated') ORDER BY donation.confirm desc");
          $rowCtr = mysqli_fetch_assoc($resultsCtr);
          $dCount = $rowCtr['count'];              

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
        <title>Donation</title>
        
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
                        <h4 style="text-align: right; color:#E50914; font-size:18px; padding: 10px 15px; margin-right:12px">
                            Donations Verification
                        </h4>
                </div> 
            </div>



            <div class="main" style="padding:20px">

            <div class="ui three cards"  style="width:100%; margin:auto; z-index:0">

              <div class="card">
                <div class="content">
                  <div class="left floated ui image">
                    <i class="spinner yellow icon" style="font-size: 20px"></i> 
                  </div>
                  <div class="header">
                        <?php echo $count1; ?>
                  </div>
                  <div class="meta">
                    Pending
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="content">
                  <div class="left floated ui image">
                    <i class="thumbtack green icon" style="font-size: 20px"></i> 
                  </div>
                  <div class="header">
                        <?php echo $count2; ?>
                  </div>
                  <div class="meta" style="font-size:11px">
                    In Storage
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="content">
                  <div class="left floated ui image">
                    <i class="ban red icon" style="font-size: 20px"></i> 
                  </div>
                  <div class="header">
                        <?php echo $count3; ?>
                  </div>
                  <div class="meta" style="font-size:13px">
                    Rejected
                  </div>
                </div>
              </div>

            </div>
            
                <div class="ui form">
                    <div class="field">
                                <label style="color:white; font-family: Raleway;">.</label>
                                    <div class="ui selection" >
                                            <select class="form-select" onchange="location = this.value;">
                                                <option disabled="disabled" selected="selected">Sort by</option>
                                                <option value="admin_donations.php?tableud=A">A</option>
                                                <option value="admin_donations.php?tableud=B ">B</option>
                                                <option value="admin_donations.php?tableud=AB">AB</option>
                                                <option value="admin_donations.php?tableud=O">O</option>
                                                <option value="admin_donations.php?tableud=All">All</option>
                                            </select>
                                    </div>
                      </div>
                </div>

                <table class="ui celled unstackable table">

                  <thead>
                    <tr>
                    <th>Blood Code</th>
                    <th>Date Donated</th>
                    <th>Status</th>
                    <th colspan="2">Actions</th>
                    </tr>
                </thead>

                  <tbody>
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td data-label="Blood Code">
                                  <a href="admin_donations_view.php?view=<?php echo $row['id']; ?>" target="_self">
                                    <b>
                                      <?php echo $row['blood_code']; ?>
                                    </b>
                                  </a>

                                  <br>
                                    <?php echo $row['blood_type']; ?> <?php echo $row['blood_rh']; ?>

                                </td>
                                <td data-label="Date Donated">
                                  <?php echo $row['title']; ?>
                                  <br>
                                  <?php echo $row['datetime']; ?>
                                </td>
                                <td data-label="Status"><?php echo $row['confirm']; ?></td>

                                <?php if ($row['confirm'] == "Approved" || $row['confirm'] == "Rejected"){ ?>
                                    <td></td>
                                <?php } else { ?>         
                                    <td data-label="Actions" style="text-align:center">
                                        <a href="admin_donations.php?accept=<?php echo $row['id']; ?>" target="_self">
                                            <i class="check circle green icon" style="font-size: 20px"></i>
                                        </a>
                                    </td>
                                    <td data-label="Actions" style="text-align:center">
                                        <a href="admin_donations.php?decline=<?php echo $row['id']; ?>" target="_self">
                                            <i class="times circle red icon" style="font-size: 20px">
                                        </i>
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                  </tbody>
                </table>
                  
                
                      <a href="admin_donations_all.php">
                          <button class="ui right labeled icon button" style="float:right">
                              <i class="right arrow icon"></i>
                              View Tracking
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
