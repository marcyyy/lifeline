<?php 
	
		$id = "";
        $password = "";

	include 'db.inc.php';

	if (isset($_POST['submit']))
	{	
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$id = mysqli_real_escape_string($conn, $_POST['id']);

		$bday = date('Y-m-d', strtotime($bday));
		mysqli_query($conn, "UPDATE donor SET password = '$password' WHERE id=$id")
                            or die( mysqli_error($conn));
		
		$message = 'Please login again.';

		echo "<script> 
			alert('$message')
			window.location.replace('../login.php');
			</script>";
		//header('location: ../login.php?sub=update');
	}