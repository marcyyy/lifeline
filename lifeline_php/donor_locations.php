<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }
  
  $uid = $_SESSION["userid"];

  $result1= mysqli_query($conn, "SELECT COUNT(ln.id) AS count, donor.city as dCity FROM location ln INNER JOIN donor on ln.city = donor.city WHERE donor.id = $uid");
  $row1 = mysqli_fetch_assoc($result1); 
  $count1 = $row1['count'];
  $dCity = $row1['dCity'];

  $result3 = mysqli_query($conn, "SELECT COUNT(id) AS count FROM location");
  $row3 = mysqli_fetch_assoc($result3); 
  $count3 = $row3['count'];

  $results = mysqli_query($conn, "SELECT * FROM location ORDER BY city desc");

  if (isset($_GET['tableud']))
    {
        $nearme = $_GET['tableud'];

        if ($nearme == "Near"){
            $results = mysqli_query($conn, "SELECT ln.id, ln.city, ln.category, ln.hospitalname, ln.address, ln.contactnum, ln.email
                                            FROM location ln
                                            INNER JOIN donor on ln.city = donor.city
                                            WHERE donor.id = $uid");
  
        }
        else if ($nearme == "All"){
            $results = mysqli_query($conn, "SELECT * FROM location ORDER BY city desc");
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
        <title>Locations</title>
        
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
                        <a href="donor_home.php" class="item" style=" font-size:13px; margin:5px">Home</a>
                        <a href="donor_appointments.php" class="item " style="font-size:13px; margin:5px">Appointments</a>
                        <a href="donor_donations.php" class="item " style="font-size:13px; margin:5px">Donations</a>
                        <a href="donor_drives.php" class="item " style="font-size:13px; margin:5px">Blood Drives</a>
                        <a href="donor_locations.php" class="active item " style="color: #E50914; font-size:13px; margin:5px">Blood Banks</a>
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
                            Blood Banks
                        </h4>
                </div> 
            </div>


            <div class="main" style="padding:20px">

            <div class="ui two cards" style="width:100%; margin:auto; z-index:0">

              <div class="card">
                <div class="content">
                  <div class="left floated ui image">
                    <i class="hospital outline blue icon" style="font-size: 20px"></i> 
                  </div>
                  <div class="header">
                        <?php echo $count3; ?>
                  </div>
                  <div class="meta">
                    Blood Banks
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="content">
                  <div class="left floated ui image">
                    <i class="map marker alternate blue icon" style="font-size: 20px"></i> 
                  </div>
                  <div class="header">
                        <?php echo $count1; ?>
                  </div>
                  <div class="meta">
                    Near me
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
                                            <option value="donor_locations.php?tableud=Near">Near me</option>
                                            <option value="donor_locations.php?tableud=All">All</option>
                                        </select>
                                </div>
                  </div>
            </div>

            <table class="ui celled unstackable table">

                  <thead>
                    <tr>
                    <th>City</th>
                    <th>Address</th>
                    <th>Contacts</th>
                    </tr>
                </thead>

                  <tbody>
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td data-label="Title">
                                  <a href="donor_locations_view.php?view=<?php echo $row['id']; ?>" target="_self">
                                    <b>
                                      <?php echo $row['city']; ?>
                                    </b>
                                  </a>

                                  <br>

                                  <?php echo $row['category']; ?>
                                </td>
                                <td data-label="Date Start" >

                                    <?php if ($row['hospitalname'] == NULL) { ?>
                                        N/A
                                    <?php } else { ?>
                                        <?php echo $row['hospitalname']; ?>
                                    <?php } ?>
                                    <br>
                                    <?php echo $row['address']; ?>
                                </td>
                                <td >
                                    <?php echo $row['contactnum']; ?>
                                    <br>
                                    <?php echo $row['email']; ?>
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
