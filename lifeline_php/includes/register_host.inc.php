<?php 
	
		$fname = "";
		$lname = "";
		$fullname = "";
		$orgname = "";
		$orgtype = "";
		$orgrole = "";
		$bday = "";
		$gender = "";
		$email = "";
		$phonenum = "";
		$phonetype = "";
		$username = "";
		$password = "";

		$hostedQ = "";
		$relQ = "";
		$storyQ= "";
		$hearQ = "";
        

	include 'db.inc.php';

	if (isset($_POST['submit']))
	{	
		$fname = $_POST['first-name'];
		$lname = $_POST['last-name'];
		$fullname = $fname . " " . $lname;
		$orgname = $_POST['orgname'];
		$orgtype = $_POST['orgtype'];
		$orgrole = $_POST['orgrole'];
		$bday =  $_POST['bday'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];
		$phonenum = $_POST['phonenum'];
		$phonetype = $_POST['phonetype'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$hostedQ = $_POST['hostedQ'];
		$relQ = $_POST['relQ'];
		$storyQ = $_POST['storyQ'];
		$hearQ = $_POST['hearQ'];

		$bday = date('Y-m-d', strtotime($bday));
		$query = "INSERT INTO host (name, orgname, orgtype, orgrole, bday, gender, email, phonenum, phonetype, username, password, hostedQ, relQ, storyQ, hearQ)
                    VALUES ('$fullname','$orgname', '$orgtype', '$orgrole', '$bday','$gender','$email','$phonenum','$phonetype','$username','$password','$hostedQ','$relQ','$storyQ','$hearQ')";
                    	
		mysqli_query($conn, $query);

		$message = 'Account successfully registered.\nTry logging in with your Account.';

		echo "<script> 
			alert('$message')
			window.location.replace('../login.php');
			</script>";
		//header('location: ../login.php?register');
	}