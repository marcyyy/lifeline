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

        $rec = mysqli_query($conn, "SELECT * FROM location WHERE id = $id");
        $record = mysqli_fetch_array($rec);
    
        $id = $record['id'];
        $hospitalname = $record['hospitalname'];
        $category = $record['category'];
        $city = $record['city'];
        $hours_from = $record['hours_from'];
        $hours_to = $record['hours_to'];
        $address = $record['address'];
        $email = $record['email'];
        $contactnum = $record['contactnum'];
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


            <div class="main" style="padding:20px;margin-top:20px">

            <form action="includes/locations_update.inc.php" class="ui form" method="post">
                        <h4 class="ui dividing header" style="color:#E50914">Hospital Information</h4>

                        <div class="two fields">
                            <div class="field" style="width:20%">
                                <label>ID</label>
                                <div class="field">
                                    <input type="text" name="id" value="<?php echo $id; ?>" readonly>
                                </div>
                            </div>
                            <div class="field"style="width:80%">
                                <label>Hospital Name</label>
                                <div class="field">
                                    <input type="text" name="hospitalname" placeholder="Name of Hospital" value="<?php echo $hospitalname; ?>"readonly >
                                </div>
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label>Category</label>
                                <div class="field">
                                    <input type="text" name="category" placeholder="Category" value="<?php echo $category; ?>"  readonly >
                                </div>
                            </div>
                            <div class="field">
                                <label>City Located</label>
                                <div class="field">
                                    <input type="text" name="city" placeholder="City" value="<?php echo $city; ?>"  readonly >
                                </div>
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label>Operating Hours from</label>
                                <div class="field">
                                    <input type="time" name="from" placeholder="From" value="<?php echo $hours_from; ?>" readonly>
                                </div>
                            </div>
                            <div class="field">
                                <label>until</label>
                                <div class="field">
                                    <input type="time" name="to" placeholder="To" value="<?php echo $hours_to; ?>" readonly>
                                </div>
                            </div>
                        </div>
            
                    <h4 class="ui dividing header" style="color:#E50914">Contact Information</h4>

                        <div class="field">
                                <label>Full Address</label>
                                <div class="field">
                                    <textarea style="resize:none; height:30px"  name="address" required readonly><?php echo $address; ?></textarea>
                                </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label>Email</label>
                                <div class="field">
                                    <input type="text" name="email" value="<?php echo $email; ?>"  placeholder="email@address.com" readonly>
                                </div>
                            </div>
                            <div class="field">
                                <label>Contact Number</label>
                                <div class="field">
                                    <input type="text" name="contactnum" value="<?php echo $contactnum; ?>"  placeholder="Contact Number/s" readonly>
                                </div>
                            </div>
                        </div>

                    <a href="#" onclick="history.back();">
                        <button type="button" class="ui left labeled icon button" style="float:left">
                            <i class="left arrow icon"></i>
                                Back
                        </button>
                    </a>
                </form>
                
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
