<?php
  session_start();
  include 'includes/db.inc.php';

  if($_SESSION['status']!="Active")
  {
      header("location:login.php");
  }
  
        $uid = $_SESSION["userid"];
  
        $rec = mysqli_query($conn, "SELECT * FROM adminacc WHERE id = $uid");
        $record = mysqli_fetch_array($rec);
    
        $id = $record['id'];
        $fullname = $record['name'];
        $username = $record['username'];
        $password = $record['password'];

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
        <title>Profile</title>
        
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
                        <a href="admin_accounts.php" class="item " style="font-size:13px; margin:5px">Accounts Management</a>
                        </div>
                    </div>
                    
                    <div>
                        <a href="admin_profile.php" class="active item" style="color: #E50914; ">
                            <i class="user circle outline red icon"></i> 
                            <?php echo $name = $_SESSION["usernm"]; ?>
                        </a>
                        <a href="logout.php" class="item">
                            <i class="arrow alternate circle left outline icon"></i> 
                            Logout
                        </a>
                    </div>
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
                            Admin Profile
                        </h4>
                </div> 
            </div>


            <div class="main" style="padding:20px; margin-top:20px">

            <form action="includes/admin_update.inc.php" class="ui form" method="post">
                        <h4 class="ui dividing header" style="color:#E50914">Account Information</h4>

                        <div class="two fields">
                            <div class="field" style="width:20%">
                                <label>ID</label>
                                <div class="field">
                                    <input type="text" name="id" value="<?php echo $id; ?>" readonly>
                                </div>
                            </div>
                            <div class="field"style="width:80%">
                                <label>Name</label>
                                <div class="field">
                                    <input type="text" name="name" value="<?php echo $fullname; ?>" >
                                </div>
                            </div>
                        </div>

                        <div class="two fields">
                            <div class="field">
                                <label>Username</label>
                                <div class="field">
                                    <input type="text" name="username" value="<?php echo $username; ?>">
                                </div>
                            </div>
                            <div class="field">
                                <label>Password</label>
                                <div class="field">
                                    <input type="password" name="password" value="<?php echo $password; ?>" >
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="submit" class="ui right labeled icon primary button" style="float:right">
                            <i class="check icon"></i>
                                Update
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
