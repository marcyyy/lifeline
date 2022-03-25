<?php

if (isset($_POST["submit"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];
	$auth = $_POST["auth"];

	require_once 'db.inc.php';
	require_once 'functions.inc.php';	

	loginUser($conn, $username, $password, $auth);
}

else {
	header("location: ../login.php");
	exit();
}