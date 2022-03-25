<?php 
	
		$hospitalname = "";
		$category = "";
		$fullname = "";
		$city = "";
		$from = "";
		$to = "";
		$address = "";
		$email = "";
		$contactnum = "";

	include 'db.inc.php';

	if (isset($_POST['submit']))
	{	
		$to = $_POST['to'];
		$from = $_POST['from'];
		$hospitalname = $_POST['hospitalname'];
		$category = $_POST['category'];
		$fullname = $_POST['fullname'];
		$city = $_POST['city'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$contactnum = $_POST['contactnum'];

		$query = "INSERT INTO location (city, category, hospitalname, address, hours_from, hours_to, contactnum, email)
                    VALUES ('$city','$category', '$hospitalname','$address','$from','$to','$contactnum','$email')";
                    	
		mysqli_query($conn, $query);

		$message = 'Blood bank successfully registered.';

		echo "<script> 
			alert('$message')
			window.location.replace('../admin_locations.php');
			</script>";
		//header('location: ../admin_locations.php?register');
	}