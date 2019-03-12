<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Profile
        </h1>
        <ol class="breadcrumb">
			    <li>
                    <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-user"></i> Profile
                </li>
		</ol>
    </div>
</div>
	<?php 
	include "../dashboard/config/koneksi.php"; 
		$sql = mysqli_query($konek, "SELECT * FROM admin WHERE username= '$login_session'");
        $data=mysqli_fetch_assoc($sql);        
	?>
		<?php
			if (isset($_POST['txtUsername']))
				{
					$sql = "UPDATE admin SET ";
					$sql.= "nama ='".$_POST['txtNamaLengkap']."'";
					$sql.= "WHERE username = '$login_session'";
					mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
					?>
					<div class="alert alert-success">
						<strong>Profil berhasil diubah</strong>
					</div>
						 <a href="index.php?page=edit_profil" class="btn btn-primary">Lihat Profil</a>

					<?php
				}
			else
         {
      ?>

	<form class="form-horizontal" action="index.php?page=edit_profil&username=<?php echo '$login_session' ?>" method="post">
	    <div class="form-group">
	    	<label class="col-md-2 control-label">Username</label>
	    	<div class="col-md-4">
				<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $data['username']; ?>" disabled>
				<input type="hidden" name="txtUsername" value="<?php echo $data['username'];
         ?>" />
			</div>
	    </div>
	    <div class="form-group">
	    	<label class="col-md-2 control-label">Nama Lengkap</label>
	    	<div class="col-md-4">
				<input type="text" class="form-control" name="txtNamaLengkap" value="<?php echo $data['nama']; ?>" required=""/>
			</div>
	    </div>

	<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-2 control-label"></label>
		  <div class="col-md-8">
		  	<a href="index.php" class="btn btn-default">Kembali</a>

		    <button type="submit" class="btn btn-primary">Edit</button>
		  </div>
		</div>
		 </form>
	<?php
         }
      ?>