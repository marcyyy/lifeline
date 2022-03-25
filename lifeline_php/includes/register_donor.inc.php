<?php 
	
		$fname = "";
		$lname = "";
		$fullname = "";
		$city = "";
		$bday = "";
		$gender = "";
		$employment = "";
		$email = "";
		$phonenum = "";
		$phonetype = "";
		$username = "";
		$password = "";
		$blood_type = "";
		$blood_rh = "";

	include 'db.inc.php';

	if (isset($_POST['submit']))
	{	
		$fname = $_POST['first-name'];
		$lname = $_POST['last-name'];
		$fullname = $fname . " " . $lname;
		$city = $_POST['city'];
		$bday =  $_POST['bday'];
		$gender = $_POST['gender'];
		$employment = $_POST['employment'];
		$email = $_POST['email'];
		$phonenum = $_POST['phonenum'];
		$phonetype = $_POST['phonetype'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$blood_type = $_POST['blood_type'];
		$blood_rh = $_POST['blood_rh'];

		$bday = date('Y-m-d', strtotime($bday));
		$query = "INSERT INTO donor (name, city, bday, gender, employment, email, phonenum, phonetype, username, password, blood_type, blood_rh)
                    VALUES ('$fullname','$city', '$bday','$gender','$employment','$email','$phonenum','$phonetype','$username','$password','$blood_type','$blood_rh')";
                    	
		mysqli_query($conn, $query);

		$message = 'Account successfully registered.\nTry logging in with your Account.';

		echo "<script> 
			alert('$message')
			window.location.replace('../login.php');
			</script>";
		//header('location: ../login.php?register');
	}