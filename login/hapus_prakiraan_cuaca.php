<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Hapus Prakiraan Cuaca
        </h1>
        <ol class="breadcrumb">
		    <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-fw fa-table"></i> <a href="index.php?page=prakiraan_cuaca">Prakiraan Cuaca</a>
            </li>
            <li class="active">
                <i class="glyphicon glyphicon-remove"></i> Hapus Prakiraan Cuaca
            </li>
		</ol>
    </div>
</div>
<?php
include "../dashboard/config/koneksi.php";
$query = "SELECT * FROM prakiraan_cuaca WHERE prakiraan_cuaca_id = '$_GET[prakiraan_cuaca_id]'";
$result = mysqli_query($konek, $query) or exit("Error query : <b>".$sql."</b>.");
while($data = mysqli_fetch_assoc($result)){

if ($data['foto']== "") {

    $del = $_GET['prakiraan_cuaca_id'];
    $sql = "DELETE FROM prakiraan_cuaca WHERE prakiraan_cuaca_id = $del";
    mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");

    ?>
    <div class="alert alert-success">
        <strong>Prakiraan Cuaca berhasil dihapus</strong>
    </div>
         <a href="index.php?page=prakiraan_cuaca" class="btn btn-primary">Lihat Prakiraan Cuaca</a>
<?php
}
else{
    $del = $_GET['prakiraan_cuaca_id'];
    $sql = "DELETE FROM prakiraan_cuaca WHERE prakiraan_cuaca_id = $del";
    mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");

    unlink("foto_prakiraan_cuaca/$data[foto]");
    ?>
    <div class="alert alert-success">
        <strong>Prakiraan Cuaca berhasil dihapus</strong>
    </div>
         <a href="index.php?page=prakiraan_cuaca" class="btn btn-primary">Lihat Prakiraan Cuaca</a>
<?php
}
}
?>




