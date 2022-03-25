<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }

        $uid = $_SESSION["userid"];
  
        $rec = mysqli_query($conn, "SELECT * FROM donor WHERE id = $uid");
        $record = mysqli_fetch_array($rec);
    
        $id = $record['id'];
        $fullname = $record['name'];
        $city = $record['city'];
        $bday = $record['bday'];
        $gender = $record['gender'];
        $employment = $record['employment'];
        $email = $record['email'];
        $phonenum = $record['phonenum'];
        $phonetype = $record['phonetype'];
        $username = $record['username'];
        $password = $record['password'];
        $blood_type = $record['blood_type'];
        $blood_rh = $record['blood_rh'];
        $available = $record['available'];
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
                        <a href="donor_home.php" class="item" style="font-size:13px; margin:5px">Home</a>
                        <a href="donor_appointments.php" class="item " style="font-size:13px; margin:5px">Appointments</a>
                        <a href="donor_donations.php" class="item " style="font-size:13px; margin:5px">Donations</a>
                        <a href="donor_drives.php" class="item " style="font-size:13px; margin:5px">Blood Drives</a>
                        <a href="donor_locations.php" class="item " style="font-size:13px; margin:5px">Blood Banks</a>
                        <a href="donor_info.php" class="item " style="font-size:13px; margin:5px">FAQs</a>
                        </div>
                    </div>
                    <a href="donor_profile.php" class="active item" style="color: #E50914; ">
                        <i class="user circle outline red icon"></i> 
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
                            Profile & Account
                        </h4>
                </div> 
            </div>


            <div class="main" style="padding:20px">

            <form action="includes/donor_update.inc.php" class="ui form" method="post">
                        <h4 class="ui dividing header" style="color:#E50914">Donor Information</h4>

                        <div class="two fields">
                            <div class="field" style="width:20%">
                                <label>ID</label>
                                <div class="field">
                                    <input type="text" name="id" value="<?php echo $id; ?>" readonly>
                                </div>
                            </div>
                            <div class="field"style="width:80%">
                                <label>Full Name</label>
                                <div class="field">
                                    <input type="text" name="name" placeholder="Full name" value="<?php echo $fullname; ?>" >
                                </div>
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label>Birthdate</label>
                                <input type="date" name="bday" placeholder="Birthdate" value="<?php echo $bday; ?>" required>
                            </div>
                            <div class="field">
                            <label>Gender</label>
                                <div class="ui selection" >
                                        <select class="form-select" name="gender" required>
                                            <option selected="selected" value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                </div>
                        </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label>City</label>
                                <input type="text" name="city" placeholder="City" value="<?php echo $city; ?>" required>
                            </div>
                            <div class="field">
                            <label>Employment Status</label>
                                <div class="ui selection" >
                                        <select class="form-select" name="employment" required>
                                            <option selected="selected" value="<?php echo $employment; ?>"><?php echo $employment; ?></option>
                                            <option  value="Full-Employed">Full-time Employed</option>
                                            <option value="Self-Employed">Self Employed</option>
                                            <option  value="Unemployed">Unemployed</option>
                                            <option value="Retired">Retired</option>
                                            <option  value="Student">Student</option>
                                        </select>
                                </div>
                        </div>
                        </div>
            
                    <h4 class="ui dividing header" style="color:#E50914">Contact Information</h4>

                            <div class="field">
                                <label>Email</label>
                                <div class="field">
                                    <input type="text" name="email" value="<?php echo $email; ?>"  placeholder="email@address.com">
                                </div>
                            </div>

                        <div class="two fields" >
                            <div class="field">
                                <label>Phone Number</label>
                                <div class="field">
                                    <input type="text" name="phonenum" value="<?php echo $phonenum; ?>"  placeholder="Contact Number/s" required>
                                </div>
                            </div>
                            <div class="field">
                                <label>Phone Type</label>
                                    <div class="ui selection" >
                                            <select class="form-select" name="phonetype" required>
                                                <option selected="selected"  value="<?php echo $phonetype; ?>"><?php echo $phonetype; ?></option>
                                                <option value="Mobile">Mobile</option>
                                                <option value="Business">Business</option>
                                                <option value="Home">Home</option>
                                            </select>
                                    </div>
                            </div>
                        </div>
                            
                            <h4 class="ui dividing header" style="color:#E50914">Blood Information</h4>

                            <div class="two fields" >
                                <div class="field">
                                    <label>Blood Type</label>
                                    <input type="text" name="blood_type" value="<?php echo $blood_type; ?>" required>
                                </div>
                        
                                <div class="field">
                                            <label>Blood Type Rh</label>
                                    <input type="text" name="blood_rh" value="<?php echo $blood_rh; ?>"  required>
                                </div>
                            </div>

                            <h4 class="ui dividing header" style="color:#E50914">Account Information</h4>

                                <div class="field">
                                    <label>Username</label>
                                    <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                                </div>
                                
                        <a href="donor_changepass.php">
                            <button type="button" class="ui left icon button" style="float:left" data-content="Change Password">
                                <i class="lock icon"></i>
                            </button>
                        </a>
                        <button type="submit" name="submit" class="ui right labeled icon primary button" style="float:right">
                            <i class="check icon"></i>
                                Submit
                        </button>
                    
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
