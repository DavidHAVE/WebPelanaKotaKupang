<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Hapus Pengguna
        </h1>
        <ol class="breadcrumb">
		    <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-fw fa fa-envelope"></i> <a href="index.php?page=pengguna">Pengguna</a>
            </li>
            <li class="active">
                <i class="glyphicon glyphicon-remove"></i> Hapus Pengguna
            </li>
		</ol>
    </div>
</div>
<?php
include "../dashboard/config/koneksi.php";
	$del = $_GET['pengguna_id'];
	$sql = "DELETE FROM pengguna WHERE pengguna_id = $del";
	mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
	?>
	<div class="alert alert-success">
		<strong>Pengguna berhasil dihapus</strong>
	</div>
		 <a href="index.php?page=pengguna" class="btn btn-primary">Lihat Pengguna</a>
