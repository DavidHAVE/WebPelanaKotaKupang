<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Detail Peringatan Dini
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
             <li>
                <i class="fa fa-fw fa-table"></i> <a href="index.php?page=peringatan_dini">Peringatan Dini</a>
            </li>
            <li>
                <i class="fa fa-edit"></i> Detail Peringatan Dini
            </li>
        </ol>
    </div>
</div>



    <div>
        <!-- blog-contents -->
        <?php
        include "../dashboard/config/koneksi.php";
            $peringatan_dini_id = $_GET['peringatan_dini_id'];
            $sql = "SELECT * FROM peringatan_dini ";
            $sql.= "WHERE peringatan_dini_id = ".$peringatan_dini_id;
            $hasil = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
            $data  = mysqli_fetch_assoc($hasil);                  
        ?>
        <section class="col-md-8">
            <article class="single-blog-item"><h2><?php echo $data['judul']; ?></h2>
                <div class="alert alert-info">
                    <p>
                    <time><i class="fa fa-clock-o "> <?php echo date('j F Y',strtotime($data['tanggal'])); ?></i></time>
                    </p>
                </div>
                <p><?php echo $data['informasi']; ?></p>
            </article>
        </section>
        <!-- end of blog-contents -->

        <!-- end of sidebar -->
    </div>
