<?php
	include "../dashboard/config/koneksi.php";	
	include('ubah_password_proses.php');
?>

	<!-- Page Heading -->
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            Settings
	        </h1>
	        <ol class="breadcrumb">
			    <li>
                    <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-gear"></i> Settings
                </li>
			</ol>
	    </div>
	</div>
	<form method="post" action="" class="form-horizontal">
		<!-- Old Password input-->
		<div class="form-group">
		  <label class="col-md-2 control-label">Password Lama</label>
		  <div class="col-md-4">
		    <input name="oldpassword" type="password" placeholder="Password Lama" class="form-control input-md" required="">
		    </div>
		</div>
		<?php
			if($errOldPass == "True") { ?>
				<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fa fa-info-circle"></i>  <strong>Password lama Anda salah</strong>
                </div>
            <?php
			}
		?>		  

		<!-- Password input-->
		<div class="form-group">
		  <label class="col-md-2 control-label">Password Baru</label>
		  <div class="col-md-4">
		    <input name="newpassword" type="password" placeholder="Password Baru" class="form-control input-md" required="">
		    
		  </div>
		</div>

		<!-- Repeat Password input-->
		<div class="form-group">
		  <label class="col-md-2 control-label">Ulangi Password</label>
		  <div class="col-md-4">
		    <input name="repeatnewpassword" type="password" placeholder="Ulangi Password" class="form-control input-md" required="">
		  </div>
		</div>
		<?php
			if($errNewPass == "True") { ?>
				<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fa fa-info-circle"></i>  <strong>Password baru yang anda masukkan tidak sama dengan ulangi password</strong>
                </div>
				<?php
			}
		?>

		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-2 control-label"></label>
		  <div class="col-md-8">
		    <a href="index.php" class="btn btn-default">Kembali</a>
		    <button name="submit" class="btn btn-primary">Ubah Password</button>
		  </div>
		</div>
	</form>

