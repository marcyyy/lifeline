<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }

  if (isset($_GET['view']))
    {
        $id = $_GET['view'];

        $result1= mysqli_query($conn, "SELECT COUNT(id) as count FROM donation WHERE donor_id = $id");
        $row1 = mysqli_fetch_assoc($result1); 
        $count1 = $row1['count'];
        
        $dCount = $count1;

        $rec = mysqli_query($conn, "SELECT * FROM donor WHERE id = $id");
        $record = mysqli_fetch_array($rec);
    
        $id = $record['id'];
        $fullname = $record['name'];
        $city = $record['city'];
        $email = $record['email'];
        $phonenum = $record['phonenum'];
        
        $results = mysqli_query($conn, "SELECT dt.blood_code, dt.id, dt.blood_rh, dt.confirm, dt.tracking,
                    dt.blood_type, dt.datetime FROM donation dt INNER JOIN donor dn ON dn.id = dt.donor_id WHERE dt.donor_id = $id");
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
        <title>Donors</title>
        
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
                        <a href="admin_donations.php" class="item " style="font-size:13px; margin:5px">Blood Donations</a>
                        <a href="admin_locations.php" class="item " style="font-size:13px; margin:5px">Blood Bank Locations</a>
                        <a href="admin_accounts.php" class="active item" style="color: #E50914; font-size:13px; margin:5px">Accounts Management</a>
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
                          Donations List
                        </h4>
                </div> 
            </div>


            <div class="main" style="padding:20px">

            <div class="ui one cards"  style="width:100%; margin:auto; z-index:0">

              <div class="card">
                <div class="content">
                  <div class="right floated ui image">
                    <i class="user blue icon" style="font-size: 20px"></i> 
                  </div>
                <div class="header"><?php echo $fullname;?></div>
                    <div class="meta"><?php echo $city;?></div>
                </div>
                <div class="extra content">
                        <?php echo $phonenum;?> | <?php echo $email;?> 
                </div>
              </div>
              
            </div>

            <table class="ui celled unstackable table">

                  <thead>
                    <tr>
                    <th>Blood Drive</th>
                    <th>Date</th>
                    <th>Tracking</th>
                    <th>Status</th>
                    </tr>
                </thead>

                  <tbody>
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td data-label="Name" style="width:150px">
                                  <a href="admin_donations_view.php?view=<?php echo $row['id']; ?>" target="_self">
                                    <b>
                                      <?php echo $row['blood_code']; ?>
                                    </b>
                                  </a>
                                  <br>
                                    <?php echo $row['blood_type']; ?> 
                                    <?php echo $row['blood_rh']; ?>

                                </td>
                                <td data-label="Date" style="width:120px">
                                  <?php echo $row['datetime']; ?>
                                </td>
                                <td data-label="Tracking" style="width:30px">
                                    <br>
                                    <?php echo $row['tracking']; ?>
                                </td>

                                <td data-label="Status" style="width:30px">
                                    <br>
                                    <?php echo $row['confirm']; ?>
                                </td>
                            </tr>
                        <?php } ?>
                  </tbody>
                </table>
                  
                
                    <a href="#" onclick="history.back();">
                          <button class="ui left labeled icon button" style="float:right">
                              <i class="left arrow icon"></i>
                              Back
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
