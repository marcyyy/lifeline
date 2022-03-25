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
                            Password
                        </h4>
                </div> 
            </div>


            <div class="main" style="padding:20px">

            <form action="includes/donor_changepass.inc.php" class="ui form" method="post">

                        <h4 class="ui dividing header" style="color:#E50914" >Change Password</h4>

                                <input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
                                <div class="field">
                                    <label>Old Password</label>
                                    <input type="password" name="password0" id="password0" onkeyup="checkPassword()" required style="margin-bottom:10px;">
                                    <span  id = "message1"> </span>
                                </div>
                                
                                <div hidden="true" id="hid_pass">
                                    <div class="two fields" >
                                        <div class="field">
                                                <label>New Password</label>
                                                <input type="password" name="password" id="password" onkeyup="verifyPassword()" required>
                                        </div>
                                        <div class="field">
                                                <label>Confirm Password</label>
                                                <input type="password" name="password2" id="password2" onkeyup="verifyPassword()" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="field">
                                    <span  id = "message2"> </span>
                                </div>
                                
                        <a href="donor_profile.php">
                            <button type="button" class="ui left icon button" style="float:left" data-content="Account & Settings">
                                <i class="user icon"></i>
                            </button>
                        </a>

                        <div hidden="true" id="hid_submit">
                            <button type="submit" name="submit" class="ui right labeled icon primary button" style="float:right">
                                <i class="check icon"></i>
                                    Submit
                            </button>
                        </div>
                    
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

        function checkPassword(){
            var pwO = document.getElementById("password0").value;  
            var pw_php = "<?php echo $password; ?>";
            
            //check empty password field  
            if(pwO == "" ) {  
                document.getElementById("message1").innerHTML = "Old Password cannot be blank.";  
                return false;  
            }  
            if(pwO != pw_php){
                document.getElementById("message1").innerHTML = "Old Password is incorrect.";  
                return false;  
            }
            else{
                document.getElementById("message1").innerHTML = "Old Password is Correct."; 
                document.getElementById("hid_pass").hidden = false;
            }

        }

        function verifyPassword() {  
            var pwN = document.getElementById("password").value;  
            var pwC = document.getElementById("password2").value;  

            //check empty password field  
            if(pwN == "") {  
                document.getElementById("message2").innerHTML = "New Password cannot be blank.";  
                return false;  
            }   
            if(pwC== "") {  
                document.getElementById("message2").innerHTML = "Confirm Password cannot be blank.";  
                return false;  
            }  
            if(pwN.length < 8) {  
                document.getElementById("message2").innerHTML = "Password length must be atleast 8 characters.";  
                return false;  
            }
            if(pwC != pwN){
                document.getElementById("message2").innerHTML = "New Password and Confirm Password do not match.";  
                return false;  
            }
            else{
                document.getElementById("message2").innerHTML = "Password is Correct."; 
                document.getElementById("hid_submit").hidden = false;
            }
        }  
    </script>
    <script src="assets/css/semantic/dist/semantic.min.js">
</html>
