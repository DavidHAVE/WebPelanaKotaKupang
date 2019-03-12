<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Buat Prakiraan Cuaca
        </h1>
        <ol class="breadcrumb">
		    <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-fw fa-table"></i> <a href="index.php?page=prakiraan_cuaca">Prakiraan Cuaca</a>
            </li>
            <li class="active">
                <i class="glyphicon glyphicon-plus"></i> Buat Prakiraan Cuaca
            </li>
		</ol>
    </div>
</div>
<?php
include "../dashboard/config/koneksi.php";
	if (isset($_POST['informasi']))
	{
	    date_default_timezone_set('Asia/Jakarta');
		$tgl = date('Y-m-d H:i:s');
		$informasi = $_POST['informasi'];
		$lokasi_file = $_FILES['fupload']['tmp_name'];
        $nama_file   = $_FILES['fupload']['name'];

        $fotobaru = date('dmYHis').$nama_file;

        //script untuk upload nama file gambar
        move_uploaded_file($lokasi_file,"foto_prakiraan_cuaca/$fotobaru");

		$sql = "INSERT INTO prakiraan_cuaca(tanggal, informasi, foto) VALUES ('$tgl', '$informasi', '$fotobaru')";

			// $input = "INSERT INTO peringatan_dini(tanggal, informasi) VALUES ('$tanggal', '$informasi')";

		mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
		?>
		<div class="alert alert-success">
			<strong>Prakiraan Cuaca Berhasil dibuat</strong>
		</div>
			 <a href="index.php?page=prakiraan_cuaca" class="btn btn-primary">Lihat Prakiraan Cuaca</a>

		<?php
	}

	else
	{

	?>

	<form class="form-horizontal" action="index.php?page=buat_prakiraan_cuaca" method="post" enctype='multipart/form-data'>

		<div class="form-group">
		  <label class="col-md-2 control-label">Informasi:</label>
		  <div class="col-md-4">
               <textarea class="form-control" rows="10" name="informasi"></textarea>
		 </div>
		</div>

		<div class="form-group">
           <label class="col-md-2 control-label">Tambahkan Gambar:</label>
           <div class="col-md-4">
               <input type="file" name=fupload size=40>
       	  </div>
        </div>

	<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-2 control-label"></label>
		  <div class="col-md-8">
		    <a href="index.php?page=prakiraan_cuaca" class="btn btn-default">Kembali</a>
		    <button type="submit" class="btn btn-primary">Submit</button>
		  </div>
		</div>
	  </form>
	<?php
		}
	?>