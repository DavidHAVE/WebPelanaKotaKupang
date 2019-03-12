<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Hapus Laporan
        </h1>
        <ol class="breadcrumb">
		    <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-fw fa-table"></i> <a href="index.php?page=laporan">Laporan</a>
            </li>
            <li class="active">
                <i class="glyphicon glyphicon-remove"></i> Hapus Laporan
            </li>
		</ol>
    </div>
</div>
<?php
include "../dashboard/config/koneksi.php";
$query = "SELECT * FROM laporan WHERE laporan_id = '$_GET[laporan_id]'";
$result = mysqli_query($konek, $query) or exit("Error query : <b>".$sql."</b>.");
while($data = mysqli_fetch_assoc($result)){
    
	$del = $_GET['laporan_id'];
	$sql = "DELETE FROM laporan WHERE laporan_id = $del";
	mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
	
	 unlink("../foto_laporan/$data[foto]");
}
	?>
	<div class="alert alert-success">
		<strong>Laporan berhasil dihapus</strong>
	</div>
		 <a href="index.php?page=laporan" class="btn btn-primary">Lihat Laporan</a>
