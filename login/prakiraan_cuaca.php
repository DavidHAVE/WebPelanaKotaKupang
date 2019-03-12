<?php
include "../dashboard/config/koneksi.php";
  
    $sql = "SELECT * FROM prakiraan_cuaca";
    $query = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Prakiraan Cuaca
        </h1>
        <ol class="breadcrumb">
		    <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
		    <li>
		        <i class="fa fa-cloud"></i> Prakiraan Cuaca
		    </li>
		</ol>
    </div>
</div>

<?php
    $sql2 = "SELECT count(prakiraan_cuaca_id) FROM prakiraan_cuaca";
    $query2 = mysqli_query($konek, $sql2) or exit("Error query : <b>".$sql."</b>.");
    $row = mysqli_fetch_row($query2);
    //total row count
    $count = $row[0];

    if ($count == 0){
?>
    <p>
        <a href="index.php?page=buat_prakiraan_cuaca" class="btn btn-primary">Buat Prakiraan Cuaca Baru</a>
    </p>

<?php
    }
?>

<div>
    <table class="table table-striped">
        <tr>
            <th class="col-lg-2 col-md-2 col-sm-2">Tanggal</th>
            <th class="col-lg-4 col-md-4 col-sm-4">Foto</th>
            <th class="col-lg-2 col-md-2 col-sm-2">Aksi</th>
        </tr>

        <?php
        while($data = mysqli_fetch_assoc($query)){ ?>
        <tr>
            <td><?php echo '<em>'.date('H:i ',strtotime($data['tanggal'])).'</em>'; ?><br/>   
                <?php echo '<em>'.date('j F Y',strtotime($data['tanggal'])).'</em>'; ?>
            </td>
            
            <td><img src="foto_prakiraan_cuaca/<?php echo $data['foto'] ?>" class="img-responsive" width=100px height=100px/></td>
           
            <td>
                <a href="index.php?page=prakiraan_cuaca_detail&prakiraan_cuaca_id=<?php echo $data['prakiraan_cuaca_id']; ?>" class="btn btn-info btn-xs">
                Detail
                </a>
                <a href="index.php?page=edit_prakiraan_cuaca&prakiraan_cuaca_id=<?php echo $data['prakiraan_cuaca_id']; ?>" class="btn btn-warning btn-xs">
                Edit
                </a>
                <a href="index.php?page=hapus_prakiraan_cuaca&prakiraan_cuaca_id=<?php echo $data['prakiraan_cuaca_id']; ?>"
                onClick="return cekHapus();" class="btn btn-danger btn-xs">
                Hapus
                </a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

    <script language="JavaScript">
      function cekHapus(){
         if(confirm("Yakin mau hapus Prakiraan Cuaca ini?")){
            return true;
         } else {
            return false;
         }
      }
    </script>
</div>
  