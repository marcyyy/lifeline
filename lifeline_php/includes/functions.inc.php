<?php

// CHECK IF ACCOUNT EXIST (ADMIN, DOCTOR, PATIENT)
function userExists($conn, $auth, $username) {

	if ($auth == "Donor")
	{
		$sql = "SELECT * FROM donor WHERE username = ?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../login.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if ($row = mysqli_fetch_assoc($resultData)){
			return $row;
		}
		else {
			$result = false;
			return $result;
		}

		mysqli_stmt_close($stmt);
	}	

	else if ($auth == "Host")
	{
		$sql = "SELECT * FROM host WHERE username = ?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../login.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if ($row = mysqli_fetch_assoc($resultData)){
			return $row;
		}
		else {
			$result = false;
			return $result;
		}

		mysqli_stmt_close($stmt);
	}

	else if ($auth == "Admin")
	{
		$sql = "SELECT * FROM adminacc WHERE username = ?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../login.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if ($row = mysqli_fetch_assoc($resultData)){
			return $row;
		}
		else {
			$result = false;
			return $result;
		}

		mysqli_stmt_close($stmt);
	}

}

//LOGS IN THE USER (IF CORRECT PASSWORD) THEN PASSES THE USER DATA ON SESSION
function loginUser($conn, $username, $password, $auth) {
	$userExists = userExists($conn, $auth, $username);	

	if($userExists === false) {
		//header("location: ../login.php?error=wronglogin");
		
		$message = 'Account does not exists.';

		echo "<script> 
			alert('$message')
			window.location.replace('../login.php');
			</script>";
		exit();
	}

	$pwdHashed = $userExists['password'];

	if ($password !== $pwdHashed) {
		//header("location: ../login.php?error=wrongpassword");
		
		$message = 'Password is incorrect.';

		echo "<script> 
			alert('$message')
			window.location.replace('../login.php');
			</script>";
		exit();
	}
	else if ($password === $pwdHashed) {

		if ($auth == "Donor")
		{
			session_start();
			$_SESSION["userid"] = $userExists["id"];
			$_SESSION["usernm"] = $userExists["name"];
			$_SESSION["userauth"] = $auth;
			$_SESSION["status"] = "Active";
			header("location: ../donor_home.php");
			exit();
		}

		else if ($auth == "Host")
		{
			session_start();
			$_SESSION["userid"] = $userExists["id"];
			$_SESSION["usernm"] = $userExists["name"];
			$_SESSION["userauth"] = $auth;
			$_SESSION["status"] = "Active";
			header("location: ../host_home.php");
			exit();
		}
		else if ($auth == "Admin")
		{
			session_start();
			$_SESSION["userid"] = $userExists["id"];
			$_SESSION["usernm"] = $userExists["name"];
			$_SESSION["userauth"] = $auth;
			$_SESSION["status"] = "Active";
			header("location: ../admin_home.php");
			exit();
		}


	}
}

