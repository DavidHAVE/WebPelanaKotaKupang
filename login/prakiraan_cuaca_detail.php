<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Detail Prakiraan Cuaca
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
             <li>
                <i class="fa fa-fw fa-table"></i> <a href="index.php?page=prakiraan_cuaca">Prakiraan Cuaca</a>
            </li>
            <li>
                <i class="fa fa-edit"></i> Detail Prakiraan Cuaca
            </li>
        </ol>
    </div>
</div>



    <div>
        <!-- blog-contents -->
        <?php
        include "../dashboard/config/koneksi.php";
            $prakiraan_cuaca_id = $_GET['prakiraan_cuaca_id'];
            $sql = "SELECT * FROM prakiraan_cuaca ";
            $sql.= "WHERE prakiraan_cuaca_id = ".$prakiraan_cuaca_id;
            $hasil = mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
            $data  = mysqli_fetch_assoc($hasil);                  
        ?>
        <section class="col-md-8">
            <article class="single-blog-item">
                <div class="alert alert-info">
                    <p>
                    <time><i class="fa fa-clock-o "> <?php echo date('j F Y',strtotime($data['tanggal'])); ?></i></time>
                    </p>
                </div>
                <img src="foto_prakiraan_cuaca/<?php echo $data['foto'] ?>" class="img-responsive center-block" width=300px height=300px/>
                </br>
                <p><?php echo $data['informasi']; ?></p>
            </article>
        </section>
        <!-- end of blog-contents -->

        <!-- end of sidebar -->
    </div>
