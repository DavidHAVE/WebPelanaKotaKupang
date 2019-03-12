<?php
include "../dashboard/config/koneksi.php";

        if (isset($_GET['pengguna_id']))
         {
            $pengguna_id = $_GET['pengguna_id'];
            $value = ''; 
            
            if($_GET['value'] == '0'){
                $value = '1';
            }else{
                $value = '0';
            }
            
            //script untuk upload gambar
            $sql = "UPDATE pengguna SET ";
            $sql.= "blok='".$value."'";
            $sql.= " WHERE pengguna_id = ".$pengguna_id;
            mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
         }

    //Pagination
    $sql = "SELECT count(pengguna_id) FROM pengguna";
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

        if (isset($_GET['action'])){
            $nama = $_POST['nama'];
            
            $sql = "SELECT count(pengguna_id) FROM pengguna WHERE nama LIKE '%$nama%'";
            $query = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
            $row = mysqli_fetch_row($query);
              //total row count
            $rows = $row[0];

            // $data = mysqli_query("select * from mhs where nama like '%".$cari."%'");    
            
            $sql = "SELECT * FROM pengguna WHERE nama LIKE '%$nama%'";
            $query = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");

            $textline1 = "Total pengguna $nama ada $rows";
            $paginationCtrls = '';
         }else{
    // This is your query again, it is for grabbing just one page worth of rows by applying $limit
    $sql = "SELECT * FROM pengguna ORDER BY pengguna_id DESC $limit";
    $query = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
    //this shows the user where page on and total number
    $textline1 = "Total pengguna ada $rows";
    // membuat variabel
    $paginationCtrls = '';
    // If there is more than 1 page worth of results
    if ($last != 1) {
        // halaman pertama tanpa previous page
        if($pagenum > 1 ) {
            $previous = $pagenum - 1;
            $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?page=pengguna&pn='.$previous.'" aria-label="Previous">
                Prev</a></li>&nbsp;&nbsp; ';
            //clickable number links that should appear on the left target page number
            for ($i= $pagenum-4; $i < $pagenum ; $i++) { 
                # code...
                if ($i > 0) {
                    $paginationCtrls .='<li><a href="'.$_SERVER['PHP_SELF'].'?page=pengguna&pn='.$i.'">'.$i.'</a></li> &nbsp; ';
                    # code...
                }
            }
        }
        // render the target page number without link
        $paginationCtrls .= '<li class="active"><a>'.$pagenum.'</a></li>&nbsp;';
        //clickable number links that should appear on the right target page number
        for ($i= $pagenum+1; $i <= $last ; $i++) { 
            $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?page=pengguna&pn='.$i.'">'.$i.'</a></li> &nbsp; ';
            if ($i >= $pagenum+4) {
                break;
            }
        }
        // this does same the above, only clecking if we are on the last page, and then generating the "Next"
        if ($pagenum != $last) {
            $next = $pagenum + 1;
            $paginationCtrls .= ' &nbsp;&nbsp;<li><a href="'.$_SERVER['PHP_SELF'].'?page=pengguna&pn='.$next.'">Next</a></li> ';
            # code...
        }
    } //akhir pagination
}
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Pengguna
        </h1>
        <ol class="breadcrumb">
		    <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-users"></i> Pengguna
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
                                <form class="form-horizontal" role="form" action="index.php?page=pengguna&action=cari" method="POST">
                                <div class="form-group">
                                    <label>Nama :</label>
                                    <input type="text" name="nama" class="form-control">      
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
			<th>Nama</th>
			<th>Nomor Telepon</th>
			<th>Email</th>
            <th>Blokir</th>
            <th>Aksi</th>
		</tr>

		<?php
		while($row = mysqli_fetch_assoc($query))
				{
			?>
		<tr>
			<td class="col-lg-2"><strong><?php echo $row['nama']; ?></strong></td>
			<td class="col-lg-3"><?php echo $row['nomor_telepon']; ?></td>
			<td class="col-lg-3"><?php echo $row['email']; ?></td>
            <td class="col-lg-3">
                <?php 
                if ($row['blok'] == 1){
                    echo "<i class='fa fa-check'/>";
                }else{
                    echo "<i class='fa fa-close'/>";
                }?>
            </td>
		
            <td class="col-lg-2">
                <a href="index.php?page=pengguna&pengguna_id=<?php echo $row['pengguna_id']; ?>&value=<?php echo $row['blok']; ?>" class="btn btn-warning btn-xs">
                Ubah Kondisi
                </a>
                <a href="index.php?page=hapus_pengguna&pengguna_id=<?php echo $row['pengguna_id']; ?>"
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
     if(confirm("Yakin mau hapus pengguna ini?")){
        return true;
     } else {
        return false;
     }
  }
</script>
