<!DOCTYPE html>
<html style="background-color: #E50914; color: #E50914;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="pragma" content="no-cache" />
        <meta name="viewport" content="initial-scale=1, width=device-width, user-scalable=no, maximum-scale=1">
        <link rel="icon" href="assets/img/lifeline_icon.png">
        <link rel="stylesheet" href="assets/css/semantic/dist/semantic.min.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <title>Register Donor Account</title>

        <style>
          .tablink {
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 17px;
            justify-content: center;
            width: 25%;
            font-family: Raleway;
          }

          .tablink:hover {
            background-color: #777;
          }

        </style>
    </head>

    <body class="outside">
        <div class="container" >
            <div class="content" style="position: absolute; top: 50%; transform: translateY(-50%); margin-top: 30px; margin-bottom: 30px; width: 380px; max-width: 380px;">
                
                <p style="text-align:center; font-size: 30px; font-family: Raleway; font-weight: bold; letter-spacing: -2px;line-height: 0.9; color:white;" >Register donor account</p>
                <a href="login.php"><p style="text-align:center; font-size: 15px; font-family: Raleway; letter-spacing: 0px; line-height: 0.9; color:white; margin:-20px 0 15px 0" >Already have an account?</p></a>

                <hr>

                <div class="ui top attached tabular menu" style="margin-bottom:15px; margin-top:-8px">
                  <button style="color:white; " class="item tablink"  onclick="openPage('1', this, 'white', '#E50914')" id="defaultOpen">
                    1
                  </button>
                  <button style="color:white;" class="item tablink" id="btn2" onclick="openPage('2', this, 'white', '#E50914')">
                    2
                  </button>
                  <button style="color:white;" class="item tablink" id="btn3" onclick="openPage('3', this, 'white', '#E50914')">
                    3
                  </button>
                  <button style="color:white;" class="item tablink" id="btn4" onclick="openPage('4', this, 'white', '#E50914')">
                    4
                  </button>
                </div>

                <form class="ui form" action="includes/register_donor.inc.php" method="post" >
                  
                  <div id="1" class="tabcontent" style="margin-bottom:15px">
                      <div class="field">
                        <label style="color:white; font-family: Raleway;">First Name</label>
                        <input type="text" name="first-name" placeholder="First Name" id="fname">
                      </div>

                      <div class="field">
                        <label style="color:white; font-family: Raleway;">Last Name</label>
                        <input type="text" name="last-name" placeholder="Last Name" required id="lname">
                      </div>

                      <div class="field">
                        <label style="color:white; font-family: Raleway;">City</label>
                        <input type="text" name="city" placeholder="City" required id="city">
                      </div>

                      <hr>

                      <button type="button" class="ui button" onclick="openPage('2', document.getElementById('btn2'), 'white', '#E50914')" style="background-color:#ff525b; color:white; margin-top:10px; float: right;">
                            Next
                      </button>
                  
                  </div>

                  <div id="2" class="tabcontent" style="margin-bottom:15px">
                    <div class="field">
                      <label style="color:white; font-family: Raleway;">Birthdate</label>
                      <input type="date" name="bday" placeholder="Birthdate" required id="bday">
                    </div>

                    <div class="field">
                        <label style="color:white; font-family: Raleway;">Gender</label>
                            <div class="ui selection" >
                                    <select class="form-select" name="gender" style="font-family: Raleway;" required id="gender">
                                        <option style="font-family: Raleway;" disabled="disabled" selected="selected">Select Gender</option>
                                        <option style="font-family: Raleway;"  value="Male">Male</option>
                                        <option style="font-family: Raleway;" value="Female">Female</option>
                                    </select>
                            </div>
                      </div>

                    <div class="field">
                        <label style="color:white; font-family: Raleway;">Employment Status</label>
                            <div class="ui selection" >
                                    <select class="form-select" name="employment" style="font-family: Raleway;" required id="employment">
                                        <option style="font-family: Raleway;" disabled="disabled" selected="selected">Select Employment Status</option>
                                        <option style="font-family: Raleway;"  value="Full-Employed">Full-time Employed</option>
                                        <option style="font-family: Raleway;" value="Self-Employed">Self Employed</option>
                                        <option style="font-family: Raleway;"  value="Unemployed">Unemployed</option>
                                        <option style="font-family: Raleway;" value="Retired">Retired</option>
                                        <option style="font-family: Raleway;"  value="Student">Student</option>
                                    </select>
                            </div>
                      </div>
                      
                      <div class="field">
                                <label style="color:white; font-family: Raleway;">Blood Type</label>
                                    <div class="ui selection" >
                                            <select class="form-select" name="blood_type" required id="blood_type">
                                                <option disabled="disabled" selected="selected">Select Blood Type</option>
                                                <option value="A">A</option>
                                                <option value="B ">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                    </div>
                      </div>
                      
                      <div class="field">
                                <label style="color:white; font-family: Raleway;">Blood Type Rh</label>
                                    <div class="ui selection" >
                                            <select class="form-select" name="blood_rh" required id="blood_rh">
                                                <option disabled="disabled" selected="selected">Select Blood Type Rh</option>
                                                <option value="+ ">Positive</option>
                                                <option value="-">Negative</option>
                                            </select>
                                    </div>
                      </div>

                      <hr>

                    <button type="button" class="ui button" onclick="openPage('3', document.getElementById('btn3'), 'white', '#E50914')" style="background-color:#ff525b; color:white; margin-top:10px; float: right;">
                          Next
                    </button>

                  </div>

                  <div id="3" class="tabcontent" style="margin-bottom:15px">
                      <div class="field">
                          <label style="color:white; font-family: Raleway;">Email Address</label>
                          <input type="text" name="email" placeholder="sample@gmail.com" required id="email">
                      </div>
                      <div class="field">
                          <label style="color:white; font-family: Raleway;">Phone number</label>
                          <input type="tel" name="phonenum" placeholder="999-888-777" required id="phonenum">
                      </div>
                      <div class="field">
                          <label style="color:white; font-family: Raleway;">Phone Type</label>
                              <div class="ui selection" >
                                      <select class="form-select" name="phonetype" style="font-family: Raleway;" required id="phonetype">
                                        <option style="font-family: Raleway;" disabled="disabled" selected="selected">Select Phone Type</option>
                                          <option style="font-family: Raleway;"  value="Mobile">Mobile</option>
                                          <option style="font-family: Raleway;" value="Business">Business</option>
                                          <option style="font-family: Raleway;" value="Home">Home</option>
                                      </select>
                              </div>
                      </div>

                      <hr>

                      <button type="button" class="ui button" onclick="openPage('4', document.getElementById('btn4'), 'white', '#E50914')" style="background-color:#ff525b; color:white; margin-top:10px; float: right;">
                            Next
                      </button>

                  </div>

                  <div id="4" class="tabcontent" style="margin-bottom:15px">
                      <div class="field">
                            <label style="color:white; font-family: Raleway;">Username</label>
                            <input type="text" name="username" placeholder="Username" required id="username">
                      </div>
                      <div class="field">
                            <label style="color:white; font-family: Raleway;">Password</label>
                            <input type="password" name="password" id="password" required>
                      </div>
                      <div class="field">
                            <label style="color:white; font-family: Raleway;">Confirm Password</label>
                            <input type="password" name="password2" id="password2" required>
                            <div style="margin-top:10px; color: white" >
                            </div>
                      </div>
                      
                      <hr>

                      <div class="field" style="margin:20px 0px 20px 0px">
                        <div class="ui checkbox">
                            <input type="checkbox" tabindex="0" required id="tnc">
                            <label style="color:white; font-family: Raleway;">I agree to the Terms and Conditions</label>
                        </div>
                      </div>

                        <div >
                            <button type="button" id="submitbtn" name="submit" onclick="verifySubmit()" class="ui button" style="background-color:#ff525b; color:white;">
                                Submit
                            </button>
                        </div>
                  </div>
                  
                      

                      
                  </form>

            </div>
        </div>
    </body>

    <script>
      function openPage(pageName,elmnt,color,fcolor) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].style.backgroundColor = "";
          tablinks[i].style.color = "white";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
        elmnt.style.color = fcolor;
      }
      
      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();

      function verifySubmit() {  
            var fname = document.getElementById("fname").value;  
            var lname = document.getElementById("lname").value;  
            var city = document.getElementById("city").value;  
            var bday = document.getElementById("bday").value;  
            var gender = document.getElementById("gender").selectedIndex;
            var employment = document.getElementById("employment").selectedIndex;
            var blood_type = document.getElementById("blood_type").selectedIndex;
            var blood_rh = document.getElementById("blood_rh").selectedIndex;
            var email = document.getElementById("email").value;  
            var phonenum = document.getElementById("phonenum").value;  
            var phonetype = document.getElementById("phonetype").selectedIndex;
            var username = document.getElementById("username").value;  
            var pwN = document.getElementById("password").value;  
            var pwC = document.getElementById("password2").value;  
            var tnc = document.getElementById("tnc").checked;

            //check empty password field   
            if(fname == "") {  
                alert("First Name cannot be blank");
                return false;  
            }    
            else if(lname  == "") {  
                alert("Last Name cannot be blank.");
                return false;  
            }   
            else if(city  == "") {  
                alert("City cannot be blank.");
                return false;  
            }   
            else if(bday  == "") {  
                alert("Date of Birth cannot be blank.");
                return false;  
            }    
            else if(gender == "") {  
                alert("Please select your Gender.");
                return false;  
            }       
            else if(employment == "") {  
                alert("Please select your Employment.");
                return false;  
            }     
            else if(blood_type == "") {  
                alert("Please select your Blood Type.");
                return false;  
            }     
            else if(blood_rh == "") {  
                alert("Please select your Blood Rhesus.");
                return false;  
            }    
            else if(email  == "") {  
                alert("Email cannot be blank.");
                return false;  
            }    
            else if(phonenum  == "") {  
                alert("Contact Number cannot be blank.");
                return false;  
            }    
            else if(phonetype  == "") {  
                alert("Please select a Phone Type.");
                return false;  
            }    
            else if(username  == "") {  
                alert("Username cannot be blank.");
                return false;  
            }    
            else if(pwN == "") {  
                alert("New Password cannot be blank.");
                return false;  
            }   
            else if(pwC== "") {  
                alert("Confirm Password cannot be blank.");
                return false;  
            }  
            else if(pwN.length < 8) {  
                alert("Password length must be atleast 8 characters.");
                return false;  
            }
            else if(pwC != pwN){
                alert("New Password and Confirm Password do not match.");
                return false;  
            }
            else if(tnc  == "") {  
                alert("You must agree to our Terms and Conditions.");
                return false;  
            }   
            else{
                document.getElementById("submitbtn").type="submit";  
            }
        }  

      </script>

</html>