<?
include "../dashboard/config/koneksi.php";

?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Peringatan Dini
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-exclamation-circle"></i> Peringatan Dini
            </li>
        </ol>
    </div>
</div>

<?php
    $sql2 = "SELECT count(peringatan_dini_id) FROM peringatan_dini";
    $query2 = mysqli_query($konek, $sql2) or exit("Error query : <b>".$sql."</b>.");
    $row = mysqli_fetch_row($query2);
    //total row count
    $count = $row[0];

    if ($count == 0){
?>
    <p>
        <a href="index.php?page=buat_peringatan_dini" class="btn btn-primary">Buat Peringatan Dini</a>
    </p>

<?php
    }
?>

<div>
    <table class="table table-striped">
        <tr>
            <th class="col-lg-2 col-md-2 col-sm-2">Tanggal</th>
            <th class="col-lg-4 col-md-4 col-sm-4">Judul</th>
            <th class="col-lg-2 col-md-2 col-sm-2">Aksi</th>
        </tr>

        <?php
        $sql = "SELECT * FROM peringatan_dini";
        $query = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
        while($data = mysqli_fetch_assoc($query)){ ?>
        <tr>
             <td class="col-lg-3"><?php echo '<em>'.date('H:i ',strtotime($data['tanggal'])).'</em>'; ?><br/>         
                <?php echo '<em>'.date('j F Y',strtotime($data['tanggal'])).'</em>'; ?>
            </td>
            <td><?php echo $data['judul']; ?></td>    
            <td>
                <a href="index.php?page=peringatan_dini_detail&peringatan_dini_id=<?php echo $data['peringatan_dini_id']; ?>" class="btn btn-info btn-xs">
                Detail
                </a>
                <a href="index.php?page=edit_peringatan_dini&peringatan_dini_id=<?php echo $data['peringatan_dini_id']; ?>" class="btn btn-warning btn-xs">
                Edit
                </a>
                <a href="index.php?page=hapus_peringatan_dini&peringatan_dini_id=<?php echo $data['peringatan_dini_id']; ?>"
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
         if(confirm("Yakin mau hapus artikel ini?")){
            return true;
         } else {
            return false;
         }
      }
    </script>
</div>
