<!DOCTYPE html>
<html style="background-color: #E50914; color: #E50914;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="pragma" content="no-cache" />
        <meta name="viewport" content="initial-scale=1, width=device-width, user-scalable=no, maximum-scale=1">
        <link rel="icon" href="assets/img/lifeline_icon.png">
        <link rel="stylesheet" href="assets/css/semantic/dist/semantic.min.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <title>Register Host Account</title>

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
                
                <p style="text-align:center; font-size: 30px; font-family: Raleway; font-weight: bold; letter-spacing: -2px;line-height: 0.9; color:white;" >Register host account</p>
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

                <form class="ui form" action="includes/register_host.inc.php" method="post" >
                  
                  <div id="1" class="tabcontent" style="margin-bottom:15px">
                      <div class="field">
                        <label style="color:white; font-family: Raleway;">First Name</label>
                        <input type="text" name="first-name" placeholder="First Name" id="fname">
                      </div>

                      <div class="field">
                        <label style="color:white; font-family: Raleway;">Last Name</label>
                        <input type="text" name="last-name" placeholder="Last Name" id="lname">
                      </div>

                      <div class="field">
                            <label style="color:white; font-family: Raleway;">Organization Name</label>
                            <input type="text" name="orgname" placeholder="Organization" id="orgname">
                      </div>

                      <div class="field">
                        <label style="color:white; font-family: Raleway;">Organization Type</label>
                            <div class="ui selection" >
                                    <select class="form-select" name="orgtype" style="font-family: Raleway;" required id="orgtype">
                                        <option style="font-family: Raleway;" disabled="disabled" selected="selected">Select Organization Type</option>
                                        <option style="font-family: Raleway;"  value="Business">Business</option>
                                        <option style="font-family: Raleway;" value="Church">Church/Faith-Based Group</option>
                                        <option style="font-family: Raleway;"  value="Civic">Civic/Community</option>
                                        <option style="font-family: Raleway;" value="Education">Education</option>
                                        <option style="font-family: Raleway;"  value="Healthcare">Healthcare</option>
                                        <option style="font-family: Raleway;" value="Media">Media Outlet</option>
                                        <option style="font-family: Raleway;"  value="Government">Military/NGO/Government</option>
                                        <option style="font-family: Raleway;" value="Other">Other</option>
                                    </select>
                            </div>
                      </div>

                      <div class="field">
                              <label style="color:white; font-family: Raleway;">Organization Role</label>
                              <input type="text" name="orgrole" placeholder="Organization Role" id="orgrole">
                      </div>

                      <hr>

                    <button type="button" class="ui button" onclick="openPage('2', document.getElementById('btn2'), 'white', '#E50914')" style="background-color:#ff525b; color:white; margin-top:10px; float: right;">
                          Next
                    </button>
                  
                  </div>

                  <div id="2" class="tabcontent" style="margin-bottom:15px">
                      <div class="field">
                        <label style="color:white; font-family: Raleway;">Birthdate</label>
                        <input type="date" name="bday" placeholder="Birthdate" id="bday">>
                      </div>

                      <div class="field">
                        <label style="color:white; font-family: Raleway;">Gender</label>
                            <div class="ui selection" >
                                    <select class="form-select" name="gender" style="font-family: Raleway;" required id="gender">>
                                        <option style="font-family: Raleway;" disabled="disabled" selected="selected">Select Gender</option>
                                        <option style="font-family: Raleway;"  value="Male">Male</option>
                                        <option style="font-family: Raleway;" value="Female">Female</option>
                                    </select>
                            </div>
                      </div>

                      <div class="field">
                          <label style="color:white; font-family: Raleway;">Email Address</label>
                          <input type="text" name="email" placeholder="sample@gmail.com" id="email">
                      </div>

                      <div class="field">
                          <label style="color:white; font-family: Raleway;">Phone number</label>
                          <input type="tel" name="phonenum" placeholder="999-888-777" id="phonenum">
                      </div>

                      <div class="field">
                          <label style="color:white; font-family: Raleway;">Phone Type</label>
                              <div class="ui selection" >
                                      <select class="form-select" name="phonetype"  style="font-family: Raleway;" required id="phonetype">
                                          <option disabled selected value place></option>
                                          <option style="font-family: Raleway;"  value="Mobile">Mobile</option>
                                          <option style="font-family: Raleway;" value="Business">Business</option>
                                          <option style="font-family: Raleway;" value="Home">Home</option>
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
                            <label style="color:white; font-family: Raleway;">Username</label>
                            <input type="text" name="username" placeholder="Username" id="username">
                      </div>
                      <div class="field">
                            <label style="color:white; font-family: Raleway;">Password</label>
                            <input type="password" name="password" placeholder="Password" id="password">
                      </div>
                      <div class="field">
                            <label style="color:white; font-family: Raleway;">Confirm Password</label>
                            <input type="password" name="password2" placeholder="Confirm Password" id="password2">
                      </div>

                      <hr>

                      <button type="button" class="ui button" onclick="openPage('4', document.getElementById('btn4'), 'white', '#E50914')" style="background-color:#ff525b; color:white; margin-top:10px; float: right;">
                            Next
                      </button>

                  </div>

                  <div id="4" class="tabcontent" style="margin-bottom:15px">
                      <div class="field">
                        <label style="color:white; font-family: Raleway;">Have you or your institution hosted a<br>blood drive with the Red Cross before?</label>
                            <div class="ui selection" >
                                    <select class="form-select" name="hostedQ" style="font-family: Raleway;" required id="hostedQ">
                                        <option style="font-family: Raleway;" disabled="disabled" selected="selected">Select</option>
                                        <option style="font-family: Raleway;"  value="Yes">Yes</option>
                                        <option style="font-family: Raleway;" value="No">No</option>
                                        <option style="font-family: Raleway;" value="Unsure">Not Sure</option>
                                    </select>
                            </div>
                      </div>

                      <div class="field">
                        <label style="color:white; font-family: Raleway;">Do you have a relationship with any<br>other lines of service with the Red Cross?</label>
                            <div class="ui selection" >
                                    <select class="form-select" name="relQ" style="font-family: Raleway;" required id="relQ">
                                        <option style="font-family: Raleway;" disabled="disabled" selected="selected">Select</option>
                                        <option style="font-family: Raleway;"  value="Disaster">Disaster Services</option>
                                        <option style="font-family: Raleway;"  value="ArmedForces">Service to Armed Forces</option>
                                        <option style="font-family: Raleway;" value="HealthSafety">Health and Safety</option>
                                        <option style="font-family: Raleway;" value="FinancialDonor">Financial Donor</option>
                                        <option style="font-family: Raleway;" value="Volunteer">Volunteer Services</option>
                                        <option style="font-family: Raleway;" value="None">No Other Relationship</option>
                                    </select>
                            </div>
                      </div>
                      
                      <div class="field">
                        <label style="color:white; font-family: Raleway;">How did you hear about hosting a blood<br>drive with the American Red Cross?</label>
                            <div class="ui selection" >
                                    <select class="form-select" name="hearQ" style="font-family: Raleway;" required id="hearQ">
                                        <option style="font-family: Raleway;" disabled="disabled" selected="selected">Select</option>
                                        <option style="font-family: Raleway;"  value="Referral">Referral</option>
                                        <option style="font-family: Raleway;" value="Marketing">Marketing Campaign</option>
                                        <option style="font-family: Raleway;" value="Website">Website</option>
                                        <option style="font-family: Raleway;" value="Social">Social Media</option>
                                        <option style="font-family: Raleway;" value="Other">Other</option>
                                    </select>
                            </div>
                      </div>

                      <div class="field">
                        <label style="color:white; font-family: Raleway;">Do you have a reason or personal story<br>that motivated you and/or your organization<br>to host this blood drive?</label>
                            <div class="ui selection" >
                                    <select class="form-select" name="storyQ" style="font-family: Raleway;" required id="storyQ">
                                        <option style="font-family: Raleway;" disabled="disabled" selected="selected">Select</option>
                                        <option style="font-family: Raleway;"  value="Yes">Yes</option>
                                        <option style="font-family: Raleway;" value="No">No</option>
                                    </select>
                            </div>
                      </div>
                      
                      <hr>

                      <div class="field" style="margin:20px 0px 20px 0px">
                        <div class="ui checkbox">
                            <input type="checkbox" tabindex="0" name="tnc" id="tnc">
                            <label style="color:white; font-family: Raleway;">I agree to the Terms and Conditions</label>
                        </div>
                      </div>

                        
                        <button type="button" id="submitbtn" name="submit" onclick="verifySubmit()" class="ui button" style="background-color:#ff525b; color:white;">
                              Submit
                        </button>
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
            var orgname = document.getElementById("orgname").value;  
            var orgtype = document.getElementById("orgtype").selectedIndex;
            var orgrole = document.getElementById("orgrole").value;  
            var bday = document.getElementById("bday").value;  
            var gender = document.getElementById("gender").selectedIndex;
            var email = document.getElementById("email").value;  
            var phonenum = document.getElementById("phonenum").value;  
            var phonetype = document.getElementById("phonetype").selectedIndex;
            var username = document.getElementById("username").value;  
            var pwN = document.getElementById("password").value;  
            var pwC = document.getElementById("password2").value;  
            var hostedQ = document.getElementById("hostedQ").selectedIndex; 
            var relQ = document.getElementById("relQ").selectedIndex;
            var hearQ = document.getElementById("hearQ").selectedIndex;
            var storyQ = document.getElementById("storyQ").selectedIndex;
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
            else if(orgname  == "") {  
                alert("Organization Name cannot be blank.");
                return false;  
            }    
            else if(orgtype  == "") {  
                alert("Please select an Organization Type.");
                return false;  
            }    
            else if(orgrole  == "") {  
                alert("Organization Role cannot be blank.");
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
            else if(hostedQ  == "") {  
                alert("Please select an answer for Question 1.");
                return false;  
            }    
            else if(relQ  == "") {  
                alert("Please select an answer for Question 2.");
                return false;  
            }    
            else if(hearQ  == "") {  
                alert("Please select an answer for Question 3.");
                return false;  
            }    
            else if(storyQ  == "") {  
                alert("Please select an answer for Question 4.");
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
