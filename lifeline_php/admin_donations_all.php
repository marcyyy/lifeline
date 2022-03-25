<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }
  
  $result1= mysqli_query($conn, "SELECT COUNT(confirm) AS count FROM donation WHERE confirm ='Approved' AND tracking ='In Storage'");
  $row1 = mysqli_fetch_assoc($result1); 
  $count1 = $row1['count'];

  $result2 = mysqli_query($conn, "SELECT COUNT(confirm) AS count FROM donation WHERE tracking ='Donated'");
  $row2 = mysqli_fetch_assoc($result2); 
  $count2 = $row2['count'];

  $result3 = mysqli_query($conn, "SELECT COUNT(confirm) AS count FROM donation ");
  $row3 = mysqli_fetch_assoc($result3); 
  $count3 = $row3['count'];

  $result4 = mysqli_query($conn, "SELECT COUNT(id) AS count FROM donation WHERE confirm IN ('Approved')");
  $row4 = mysqli_fetch_assoc($result4); 
  $count4 = $row4['count'];

  $results = mysqli_query($conn, "SELECT dn.blood_code, dn.blood_rh, dn.id, dn.blood_type, dn.datetime, dn.tracking, dr.title
                                  FROM donation dn INNER JOIN drive dr ON dn.drive_id = dr.id
                                  WHERE dn.confirm IN ('Approved') ORDER BY dn.datetime asc");

  
  $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
                                  WHERE donation.confirm IN ('Approved') ORDER BY donation.confirm desc");
  $rowCtr = mysqli_fetch_assoc($resultsCtr);
  $dCount = $rowCtr['count'];        

  if (isset($_GET['accept']))
    {
      $id = $_GET['accept'];

      mysqli_query($conn, "UPDATE donation SET tracking='Donated' WHERE id=$id");
      
      $message = 'Blood tracking updated to Donated.';

      echo "<script> 
        alert('$message')
        window.location.replace('admin_donations_all.php');
        </script>";
      //header('location: admin_donations_all.php?approvesuccess');
      }
  
      if (isset($_GET['tableud']))
    {
        $blood_code = $_GET['tableud'];

        if ($blood_code == "A"){
            $results = mysqli_query($conn, "SELECT * FROM donation INNER JOIN drive ON donation.drive_id = drive.id
            WHERE donation.confirm IN ('Approved') AND donation.blood_type IN ('A') ORDER BY donation.confirm desc");

  
            $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
            WHERE donation.confirm IN ('Approved') AND donation.blood_type IN ('A') ORDER BY donation.confirm desc");
            $rowCtr = mysqli_fetch_assoc($resultsCtr);
            $dCount = $rowCtr['count'];                                                        
        }
        else if ($blood_code == "B"){
          $results = mysqli_query($conn, "SELECT * FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm IN ('Approved') AND donation.blood_type IN ('B') ORDER BY donation.confirm desc");

  
          $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm IN ('Approved') AND donation.blood_type IN ('B') ORDER BY donation.confirm desc");
          $rowCtr = mysqli_fetch_assoc($resultsCtr);
          $dCount = $rowCtr['count'];               
        }
        else if ($blood_code == "AB"){
          $results = mysqli_query($conn, "SELECT * FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm IN ('Approved') AND donation.blood_type IN ('AB') ORDER BY donation.confirm desc");

          $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm IN ('Approved') AND donation.blood_type IN ('AB') ORDER BY donation.confirm desc");
          $rowCtr = mysqli_fetch_assoc($resultsCtr);
          $dCount = $rowCtr['count'];               
        }
        else if ($blood_code == "O"){
          $results = mysqli_query($conn, "SELECT * FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm IN ('Approved') AND donation.blood_type IN ('O') ORDER BY donation.confirm desc");

  
          $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm IN ('Approved') AND donation.blood_type IN ('O') ORDER BY donation.confirm desc");
          $rowCtr = mysqli_fetch_assoc($resultsCtr);
          $dCount = $rowCtr['count'];               

        }
        else if ($blood_code == "All"){
          $results = mysqli_query($conn, "SELECT * FROM donation INNER JOIN drive ON donation.drive_id = drive.id
                                          WHERE donation.confirm IN ('Approved') ORDER BY donation.confirm desc");
        
          
          $resultsCtr = mysqli_query($conn, "SELECT COUNT(donation.id) as count FROM donation INNER JOIN drive ON donation.drive_id = drive.id
          WHERE donation.confirm IN ('Approved') ORDER BY donation.confirm desc");
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
                            Donations Tracking
                        </h4>
                </div> 
            </div>



            <div class="main" style="padding:20px">

            <div class="ui three cards"  style="width:100%; margin:auto; z-index:0">

            <div class="card">
                <div class="content">
                  <div class="left floated ui image">
                    <i class="archive yellow icon" style="font-size: 20px"></i> 
                  </div>
                  <div class="header">
                        <?php echo $count1; ?>
                  </div>
                  <div class="meta" style="font-size:11px">
                    In Storage
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="content">
                  <div class="left floated ui image">
                    <i class="handshake outline green icon" style="font-size: 20px"></i> 
                  </div>
                  <div class="header">
                        <?php echo $count2; ?>
                  </div>
                  <div class="meta">
                    Grants
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="content">
                  <div class="left floated ui image">
                    <i class="database blue icon" style="font-size: 20px"></i> 
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

                <div class="ui form">
                    <div class="field">
                                <label style="color:white; font-family: Raleway;">.</label>
                                    <div class="ui selection" >
                                            <select class="form-select" onchange="location = this.value;">
                                                <option disabled="disabled" selected="selected">Sort by</option>
                                                <option value="admin_donations_all.php?tableud=A">A</option>
                                                <option value="admin_donations_all.php?tableud=B ">B</option>
                                                <option value="admin_donations_all.php?tableud=AB">AB</option>
                                                <option value="admin_donations_all.php?tableud=O">O</option>
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
                    <th>Tracking</th>
                    <th>Action</th>
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
                                <td data-label="Status"><?php echo $row['tracking']; ?></td>

                                <?php if ($row['tracking'] == "Donated"){ ?>
                                    <td></td>
                                <?php } else { ?>         
                                    <td data-label="Actions" style="text-align:center">
                                        <a href="admin_donations_all.php?accept=<?php echo $row['id']; ?>" target="_self">
                                            <i class="check circle green icon" style="font-size: 20px"></i>
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                  </tbody>
                </table>

                  <a href="admin_donations.php">
                      <button class="ui left labeled icon button" style="float: right
                      ">
                          <i class="left arrow icon"></i>
                          View Verification
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
