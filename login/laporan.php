<?php
    include "../dashboard/config/koneksi.php";

         if (isset($_GET['laporan_id']))
         {
            $laporan_id = $_GET['laporan_id'];
            $value = ''; 
            
            if($_GET['value'] == '0'){
                $value = '1';
            }else{
                $value = '0';
            }
            
            //script untuk upload gambar
            $sql = "UPDATE laporan SET ";
            $sql.= "clear='".$value."'";
            $sql.= " WHERE laporan_id = ".$laporan_id;
            mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
         }
            
    //Pagination
    $sql = "SELECT count(laporan_id) FROM laporan";
    $query = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
    $row = mysqli_fetch_row($query);
    //total row count
    $rows = $row[0];
    // artikel per page
    $page_rows = 5;
    // page number of last page
    $last = ceil($rows/$page_rows);
    //make $last tidak < 1
    if($last < 1) {
        $last = 1;
    }
    //establish $pagenum variable
    $pagenum = 1;
    //get pagenum from url
    if(isset($_GET['pn'])) {
        $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
    }
    //halaman tidak kurang 1 atau lebih dari $last page
    if($pagenum < 1) {
        $pagenum = 1;
    } else if ($pagenum > $last) {
        $pagenum = $last;
        # code...
    }
    //this set the range of rows to query for chosen $pagenum
    $limit = 'LIMIT ' .($pagenum - 1) * $page_rows. ',' .$page_rows;
    // This is your query again, it is for grabbing just one page worth of rows by applying $limit
    if (isset($_GET['action'])){
            $disaster = $_POST['disaster'];
            $date = date("Y-m-d H:i:s", strtotime($_POST['date']));
            
            $sql = "SELECT count(laporan_id) FROM laporan WHERE jenis_kejadian LIKE '$disaster%' AND date(tanggal) = '$date%'";
            $query = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
            $row = mysqli_fetch_row($query);
              //total row count
            $rows = $row[0];

            // $data = mysqli_query("select * from mhs where nama like '%".$cari."%'");    
            
            $sql = "SELECT * FROM laporan WHERE jenis_kejadian LIKE '$disaster%' AND date(tanggal) = '$date%'";
            $query = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");

            $textline1 = "Total laporan $disaster yang masuk tanggal ".$_POST['date']." ada $rows";
            $paginationCtrls = '';
         }else{
            $sql = "SELECT * FROM laporan ORDER BY tanggal DESC $limit";
            $query = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
        
    //this shows the user where page on and total number
    $textline1 = "Total laporan yang masuk ada $rows";
    // membuat variabel
    $paginationCtrls = '';
    // If there is more than 1 page worth of results
    if ($last != 1) {
        // halaman pertama tanpa previous page
        if($pagenum > 1 ) {
            $previous = $pagenum - 1;
            $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?page=laporan&pn='.$previous.'" aria-label="Previous">
                Prev</a></li>&nbsp;&nbsp; ';
            //clickable number links that should appear on the left target page number
            for ($i= $pagenum-4; $i < $pagenum ; $i++) { 
                # code...
                if ($i > 0) {
                    $paginationCtrls .='<li><a href="'.$_SERVER['PHP_SELF'].'?page=laporan&pn='.$i.'">'.$i.'</a></li> &nbsp; ';
                    # code...
                }
            }
        }
        // render the target page number without link
        $paginationCtrls .= '<li class="active"><a>'.$pagenum.'</a></li>&nbsp;';
        //clickable number links that should appear on the right target page number
        for ($i= $pagenum+1; $i <= $last ; $i++) { 
            $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?page=laporan&pn='.$i.'">'.$i.'</a></li> &nbsp; ';
            if ($i >= $pagenum+4) {
                break;
            }
        }
        // this does same the above, only clecking if we are on the last page, and then generating the "Next"
        if ($pagenum != $last) {
            $next = $pagenum + 1;
            $paginationCtrls .= ' &nbsp;&nbsp;<li><a href="'.$_SERVER['PHP_SELF'].'?page=laporan&pn='.$next.'">Next</a></li> ';
            # code...
        }
    } //akhir pagination
}
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Laporan
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i> Laporan
            </li>
        </ol>
    </div>
</div>
<div>
    <div class="alert alert-info">
        <strong><?php echo $textline1;?></strong>
    </div>
    <div class="col-lg-12">
            <div class="input-group" id="adv-search">
                <input type="text" class="form-control" placeholder="Cari" disabled/>
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <form class="form-horizontal" role="form" action="index.php?page=laporan&action=cari" method="POST">
                                  <div class="form-group">
                                    <label for="filter">Bencana</label>
                                    <select class="form-control" name="disaster">
                                        <option value="Angin Kencang" selected>Angin Kencang</option>
                                        <option value="Banjir">Banjir</option>
                                        <option value="Kebakaran">Kebakaran</option>
                                        <option value="Tanah Longsor">Tanah Longsor</option>
                                        <option value="Gempa Bumi">Gempa Bumi</option>
                                        <option value="Tsunami">Tsunami</option>
                                        <option value="Kekeringan">Kekeringan</option>
                                        <option value="Gelombang Pasang / Abrasi">Gelombang Pasang / Abrasi</option>
                                        <option value="Laka Kerja">Laka Kerja</option>
                                        <option value="Laka Laut">Laka Laut</option>
                                        <option value="Penemuan Mayat">Penemuan Mayat</option>
                                        <option value="Pohon Tumbang">Pohon Tumbang</option>

                                    </select>
                                  </div>
                             <div class="form-group">
                               <label>Tanggal</label>
                               <div class="input-group date">
                                <div class="input-group-addon">
                                       <span class="glyphicon glyphicon-th"></span>
                                   </div>
                                   <input placeholder="Tanggal" type="text" class="form-control datepicker" name="date">
                               </div>
                              </div>
                                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </br>
    </div>
    <table class="table table-striped">
        <tr>
            <th>Tanggal</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Alamat</th>
            <th>Jenis Kejadian</th>
            <th>Foto</th>
            <th>Informasi</th>
            <th>Nama Pelapor</th>
            <th>Kondisi</th>
            <th>Aksi</th>
        </tr>

        <?php
        while($row = mysqli_fetch_array($query))
                {
            ?>
        <tr>
            <td class="col-lg-3"><?php echo '<em>'.date('H:i ',strtotime($row['tanggal'])).'</em>'; ?><br/>         
                <?php echo '<em>'.date('j F Y',strtotime($row['tanggal'])).'</em>'; ?>
            </td>
            <td class="col-lg-3"><?php echo $row['latitude']; ?></td>
            <td class="col-lg-3"><?php echo $row['longitude']; ?></td>
            <td class="col-lg-3"><?php echo $row['alamat']; ?></td>
            <td class="col-lg-3"><strong><?php echo $row['jenis_kejadian']; ?></strong></td>
            <td class="col-lg-3"><img src="../foto_laporan/<?php echo $row['foto'] ?>" class="img-responsive"/></td>
            <td class="col-lg-3"><?php echo $row['informasi']; ?></td>

              <?php
                        $sql_cek_pelapor = "SELECT * FROM pengguna WHERE pengguna_id =".$row['pengguna_id'];
                        $hasil_pelapor = mysqli_query($konek, $sql_cek_pelapor) or exit("Error query : <b>".$sql_cek_pelapor."</b>."); 
                        $pelapor = mysqli_fetch_assoc($hasil_pelapor);
                 ?>
            <td class="col-lg-3"><?php echo $pelapor['nama']; ?></td>
            
            <td class="col-lg-3">
                <?php 
                if ($row['clear'] == 1){
                    echo "<i class='fa fa-check'/>";
                }else{
                    echo "<i class='fa fa-close'/>";
                }?>
            </td>

            <td class="col-lg-2">
                <a href="index.php?page=laporan&laporan_id=<?php echo $row['laporan_id']; ?>&value=<?php echo $row['clear']; ?>" class="btn btn-warning btn-xs">
                Ubah Kondisi
                </a>
                <a href="../foto_laporan/<?php echo $row['foto']; ?>" class="btn btn-info btn-xs" target="_blank">
                Lihat Foto
                </a>
                <a href="https://www.google.com/maps/place/<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>,16z" class="btn btn-info btn-xs" target="_blank">
                Lihat Peta
                </a>
                <a href="index.php?page=hapus_laporan&laporan_id=<?php echo $row['laporan_id']; ?>"
                onClick="return cekHapus();" class="btn btn-danger btn-xs">
                Hapus
                </a>
            </td>           
        </tr>
        <?php
        }
        ?>
    </table>
    <ul class="pagination">
        <?php echo $paginationCtrls;?>
    </ul>
</div>
<script language="JavaScript">
  function cekHapus(){
     if(confirm("Yakin mau hapus pesan ini?")){
        return true;
     } else {
        return false;
     }
  }
</script>
<script type="text/javascript">
 $(function(){
  $(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
  });
 });
 $(".datepicker").datepicker().datepicker("setDate", new Date());
</script>