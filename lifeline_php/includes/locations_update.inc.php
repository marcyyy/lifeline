<?php 
	
		$hospitalname = "";
		$category = "";
		$city = "";
		$from = "";
		$to = "";
		$address = "";
		$email = "";
		$contactnum = "";

	include 'db.inc.php';

	if (isset($_POST['submit']))
	{	
		$to = mysqli_real_escape_string($conn, $_POST['to']);
		$from = mysqli_real_escape_string($conn, $_POST['from']);
		$hospitalname = mysqli_real_escape_string($conn, $_POST['hospitalname']);
		$category = mysqli_real_escape_string($conn, $_POST['category']);
		$city = mysqli_real_escape_string($conn, $_POST['city']);
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$contactnum = mysqli_real_escape_string($conn, $_POST['contactnum']);
		$id = mysqli_real_escape_string($conn, $_POST['id']);

		mysqli_query($conn, "UPDATE location SET city = '$city', category = '$category', hospitalname = '$hospitalname', address = '$address', 
                                                 hours_from = '$from', hours_to = '$to', contactnum = '$contactnum', email = '$email' WHERE id=$id") or die( mysqli_error($conn));
		
		$message = 'Blood bank details successfully updated.';

		echo "<script> 
			alert('$message')
			window.location.replace('../admin_locations.php');
			</script>";
		//header('location: ../admin_locations.php?sub=update');
	}