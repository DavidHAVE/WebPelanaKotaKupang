<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard
        </h1>
        <ol class="breadcrumb">
		    <li>
		        <i class="fa fa-desktop"></i> Dashboard
		    </li>
		</ol>
    </div>
</div>

<div class="jumbotron">
	<h2>Selamat Datang <?php 
    include "../dashboard/config/koneksi.php";
        $sql = mysqli_query($konek, "SELECT * FROM admin WHERE username= '$login_session'");
        $data=mysqli_fetch_assoc($sql);
        echo $data['nama']; ?>
	</h2>
</div>