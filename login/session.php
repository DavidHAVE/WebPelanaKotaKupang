<?php
	//Koneksi server dan database
	require_once("../dashboard/config/koneksi.php");
	session_start();// Starting Session
	// Storing Session
	if(!empty($_SESSION['login_user'])){
	$user_check= $_SESSION['login_user'];
	// SQL Query To Fetch Complete Information Of User
	$ses_sql=mysqli_query($konek, "SELECT username FROM admin WHERE username='$user_check'");
	$row = mysqli_fetch_assoc($ses_sql);
	$login_session =$row['username'];
	if(!isset($login_session)){
		mysqli_close($konek); // Closing Connection
		header('Location: form_login.php'); // Redirecting To Home Page
	
	}
	}else{
	    header('Location: form_login.php'); // Redirecting To Home Page
	}
?>