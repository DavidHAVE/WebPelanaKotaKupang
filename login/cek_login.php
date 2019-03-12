<?php
include "../dashboard/config/koneksi.php";
	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
			}
		else
			{
			//Koneksi server dan database
			require_once("../dashboard/config/koneksi.php");

			// Define $username and $password
			$username=$_POST['username'];
			$password=md5($_POST['password']);
			
			// To protect MySQL injection for Security purpose
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($konek, $username);
			$password = mysqli_real_escape_string($konek, $password);
		

			// SQL query 
			$query = mysqli_query($konek, "SELECT * FROM admin WHERE password='$password' AND username='$username'");
			$rows = mysqli_num_rows($query);
			if ($rows == 1) {
				$_SESSION['login_user']= $username; // Initializing Session
				header("location: index.php"); // Redirecting To Other Page
			} else {
				$error = "ya";
			}
			mysqli_close($konek); // Closing Connection
		}
	}
?>
