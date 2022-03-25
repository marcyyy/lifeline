<?php 
	
		$host_id = "";
		$title = "";
		$details = "";
		$city = "";
		$location = "";
		$date_start = "";
		$date_end = "";
		$time_start = "";
		$time_end = "";

	include 'db.inc.php';

	if (isset($_POST['submit']))
	{	
		$host_id = $_POST['host_id'];
		$title = $_POST['title'];
		$details = $_POST['details'];
		$city = $_POST['city'];
		$location = $_POST['location'];
		$date_start = $_POST['date_start'];
		$date_end = $_POST['date_end'];
		$time_start = $_POST['time_start'];
		$time_end = $_POST['time_end'];

		$date_start = date('Y-m-d', strtotime($date_start));
		$date_end = date('Y-m-d', strtotime($date_end));
		$query = "INSERT INTO drive (host_id, title, details, city, location, date_start, date_end, time_start, time_end)
                    VALUES ('$host_id','$title', '$details','$city','$location','$date_start','$date_end','$time_start','$time_end')";
                    	
		mysqli_query($conn, $query);
		
		$message = 'Donation Drive successfully added.\nPlease wait for approval.';

		echo "<script> 
			alert('$message')
			window.location.replace('../host_drives.php');
			</script>";
		//header('location: ../host_drives.php?tableud=Pending');
	}