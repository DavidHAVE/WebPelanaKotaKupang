<?php
     include('session.php');
?> 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BPBD</title>
    
    <link rel="icon" href="../image/bpbd.png"/>
    <link rel="shortcut icon" href="../image/bpbd.png" type="image/x-icon" />

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" type="text/css" href="../assets/plugin/datepicker/dist/css/bootstrap-datepicker.min.css">

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../assets/plugin/datepicker/dist/js/bootstrap-datepicker.min.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand navbar-brand-logo" href="index.php">
                <div class="logo">
                    <img src="../image/bpbd.png" width=30px height=30px>  Dashboard BPBD Kota Kupang
                </div>
              </a>
              
                <!--<a class="navbar-brand" href="index.php" src="../image/bpbd.png"> Dashboard BPBD Kota Kupang</a>-->
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                        <?php 
                        include "../dashboard/config/koneksi.php";
                            $sql = mysqli_query($konek, "SELECT * FROM admin WHERE username= '$login_session'");
                            $data=mysqli_fetch_assoc($sql);
                            echo $data['username']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php?page=edit_profil"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="index.php?page=ubah_password"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php" onClick="return logout();"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>                
            </ul>            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-desktop"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="index.php?page=laporan"><i class="fa fa-table"></i> Laporan</a>
                    </li>
                    <li>
                        <a href="index.php?page=peringatan_dini"><i class="fa fa-exclamation-circle"></i> Peringatan Dini</a>
                    </li>
                    <li>
                        <a href="index.php?page=prakiraan_cuaca"><i class="fa fa-cloud"></i> Prakiraan Cuaca</a>
                    </li>
                    <li>
                        <a href="index.php?page=pengguna"><i class="fa fa-users"></i> Pengguna</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                            if(isset($_GET['page'])) {
                                if($_GET['page'] == "") {
                                    include("home.php");
                                } else {
                                    include($_GET['page'].".php");
                                }
                            } else {
                                include("home.php");
                            }
                        ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <script language="JavaScript">
      function logout(){
         if(confirm("Yakin mau keluar?")){
            return true;
         } else {
            return false;
         }
      }
      
    </script>

</body>

</html>
