<?php	
	require_once("../dashboard/config/koneksi.php");

	$errNewPass ='';
	$errOldPass ='';
	if (isset($_POST['submit'])) {

	$oldpassword=md5($_POST['oldpassword']);
	$newpassword=md5($_POST['newpassword']);
	$repeatnewpassword=md5($_POST['repeatnewpassword']);

	$query = mysqli_query($konek, "SELECT * FROM admin WHERE password='$oldpassword'");
	$rows = mysqli_num_rows($query);
		if ($rows == 1) {
			if ($newpassword == $repeatnewpassword) {
				$query = "UPDATE admin SET password = '$newpassword' WHERE password= '$oldpassword'";
				$hasil = mysqli_query($konek, $query);
				if($hasil) {
					// header("location: index.php?page=ubah_sukses");
					?>
					<div class="alert alert-success">
						<strong>Password berhasil diubah</strong>
					</div>
				    <?php
				}
			} else {  		//Repeated Password
				$errNewPass = "True";
		} 
	} elseif($rows == 0) { 		//Password lama
		$errOldPass = "True";
		}
	}
?>