<?php 
	
		$name = "";
        $city = "";
        $bday = "";
        $gender = "";
        $employment = "";
        $email = "";
        $phonenum = "";
        $phonetype = "";
        $username = "";

	include 'db.inc.php';

	if (isset($_POST['submit']))
	{	
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$city = mysqli_real_escape_string($conn, $_POST['city']);
        $bday = mysqli_real_escape_string($conn, $_POST['bday']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $employment = mysqli_real_escape_string($conn, $_POST['employment']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phonenum = mysqli_real_escape_string($conn, $_POST['phonenum']);
        $phonetype = mysqli_real_escape_string($conn, $_POST['phonetype']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$id = mysqli_real_escape_string($conn, $_POST['id']);

		$bday = date('Y-m-d', strtotime($bday));
		mysqli_query($conn, "UPDATE donor SET name = '$name', city = '$city', bday = '$bday', gender = '$gender', employment = '$employment', email = '$email',
							phonenum = '$phonenum', phonetype = '$phonetype', username = '$username' WHERE id=$id")
                            or die( mysqli_error($conn));
		
		$message = 'Please login again.';

		echo "<script> 
			alert('$message')
			window.location.replace('../login.php');
			</script>";

		//header('location: ../login.php?sub=update');
	}