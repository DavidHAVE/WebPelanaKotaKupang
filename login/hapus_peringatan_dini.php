<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Hapus Peringatan Dini
        </h1>
        <ol class="breadcrumb">
		    <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-fw fa fa-envelope"></i> <a href="index.php?page=peringatan_dini">Peringatan Dini</a>
            </li>
            <li class="active">
                <i class="glyphicon glyphicon-remove"></i> Hapus Peringatan Dini
            </li>
		</ol>
    </div>
</div>
<?php
include "../dashboard/config/koneksi.php";
	$del = $_GET['peringatan_dini_id'];
	$sql = "DELETE FROM peringatan_dini WHERE peringatan_dini_id = $del";
	mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
	?>
	<div class="alert alert-success">
		<strong>Peringatan Dini berhasil dihapus</strong>
	</div>
		 <a href="index.php?page=peringatan_dini" class="btn btn-primary">Lihat Peringatan Dini</a>
