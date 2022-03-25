<?php 
	
		$name = "";
		$username = "";
		$password = "";

	include 'db.inc.php';

	if (isset($_POST['submit']))
	{	
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$id = mysqli_real_escape_string($conn, $_POST['id']);

		mysqli_query($conn, "UPDATE adminacc SET name = '$name', username = '$username', password = '$password' WHERE id=$id")
                            or die( mysqli_error($conn));
							
		
		$message = 'Please log in again.';

		echo "<script> 
			alert('$message')
			window.location.replace('../login.php');
			</script>";
		//header('location: ../login.php?sub=update');
	}