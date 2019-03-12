<?php
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	// $connection = mysql_connect("localhost", "root", "") 
	// 	or die("Gagal koneksi ke server database");
	// // Selecting Database
	// $db = mysql_select_db("bpbd", $connection)
	// 	or die ("gagal memilih database");

	$konek = mysqli_connect("localhost", "root", "", "bpbd2");

?>