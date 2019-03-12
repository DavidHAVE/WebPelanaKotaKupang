<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Edit Prakiraan Cuaca
        </h1>
        <ol class="breadcrumb">
          <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
          <li>
              <i class="fa fa-edit"></i> <a href="index.php?page=posting">Prakiraan Cuaca</a>
          </li>
         <li class="active">
            <i class="glyphicon glyphicon-plus"></i> Edit Prakiraan Cuaca
         </li>
      </ol>
    </div>
</div>
   
   <?php
   include "../dashboard/config/koneksi.php";
      $sql = "SELECT * FROM prakiraan_cuaca ";
      $sql.= "WHERE prakiraan_cuaca_id = ".$_GET['prakiraan_cuaca_id'];
      
      $hasil = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
      $data  = mysqli_fetch_assoc($hasil);
      
      ?>
      
      <?php
         if (isset($_POST['txtID']))
         {
            date_default_timezone_set('Asia/Jakarta');
            $tgl = date('Y-m-d H:i:s');
            $lokasi_file = $_FILES['fupload']['tmp_name'];
            $nama_file   = $_FILES['fupload']['name'];

            if (empty($lokasi_file)) {

            $sql = "UPDATE prakiraan_cuaca SET ";
            $sql.= "tanggal='".$tgl."', informasi ='".$_POST['txtInformasi']."'";
            $sql.= " WHERE prakiraan_cuaca_id = ".$_POST['txtID'];
            mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");

            ?>

                  <div class="alert alert-success">
                  <strong>Prakiraan Cuaca Berhasil di Edit</strong>
                </div>
                   <a href="index.php?page=prakiraan_cuaca" class="btn btn-primary">Lihat Prakiraan Cuaca</a>

            <?php
            }else{ 
            

              unlink("foto_prakiraan_cuaca/$data[foto]");
              // Rename nama fotonya dengan menambahkan tanggal dan jam upload
              $fotobaru = date('dmYHis').$nama_file;
              // Set path folder tempat menyimpan fotonya

          if(move_uploaded_file($lokasi_file, "foto_prakiraan_cuaca/$fotobaru")){

            $sql = "UPDATE prakiraan_cuaca SET ";
            $sql.= "tanggal='".$tgl."', informasi ='".$_POST['txtInformasi']."', foto ='".$fotobaru."'";
            $sql.= " WHERE prakiraan_cuaca_id = ".$_POST['txtID'];
            mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
            ?>

                    <div class="alert alert-success">
                  <strong>Prakiraan Cuaca Berhasil di Edit</strong>
               </div>
                   <a href="index.php?page=prakiraan_cuaca" class="btn btn-primary">Lihat Prakiraan Cuaca</a>
       
      <?php 
            }
          }
         }
         else
         {
      ?>

      <div class="container">
        <form role="form" action="index.php?page=edit_prakiraan_cuaca&prakiraan_cuaca_id=<?php echo $_GET['prakiraan_cuaca_id'] ?>" method="post" enctype='multipart/form-data'>
         
      
            <div class="form-group">
               <label>Informasi:</label>
               <textarea class="form-control" rows="10" name="txtInformasi"><?php echo $data['informasi']; ?></textarea>
            </div>
            <div class="form-group">
               <img src="foto_prakiraan_cuaca/<?php echo $data['foto'] ?>" width="200" />
               <br/>
               <label>Ganti Gambar:</label>
               <input type="file" name=fupload size=40>
            </div>
            <br />
               <input type="hidden" name="txtID" value="<?php echo $data['prakiraan_cuaca_id'];
               ?>" />
            <button type="submit" class="btn btn-primary">Submit</button>
         </form>
      <?php
         }
      ?>
