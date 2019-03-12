<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Buat Peringatan Dini
        </h1>
        <ol class="breadcrumb">
		    <li>
                <i class="fa fa-desktop"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-fw fa-table"></i> <a href="index.php?page=peringatan_dini">Peringatan Dini</a>
            </li>
            <li class="active">
                <i class="glyphicon glyphicon-plus"></i> Buat Peringatan Dini
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
		$judul = $_POST['judul'];

		$sql = "INSERT INTO peringatan_dini(tanggal, judul, informasi) VALUES ('$tgl', '$judul', '$informasi')";

			// $input = "INSERT INTO peringatan_dini(tanggal, informasi) VALUES ('$tanggal', '$informasi')";

		mysqli_query($konek, $sql) or exit("Error query : <b>".$sql."</b>.");
		
			////
						require_once '../notifications/notification.php';
						$notification = new Notification();
	
						$title = "Info " . $judul;
						$message = $informasi." pada ".$tgl;
						$imageUrl = '';
						$action = '';
						$actionDestination = '';
	
						
						$notification->setTitle($title);
						$notification->setMessage($message);
						$notification->setImage($imageUrl);
						$notification->setAction($action);
						$notification->setActionDestination($actionDestination);
						
			
						$firebase_api = "AAAAlMTzUSg:APA91bGJ2t1ud998dokEYU6AB0OV8SpmYL_7NbKDEbD0lHYQ3ipyruw1SNhZVGC1sQ4MHFQcZ0iCEo4TtEeZIJ_cuh29TdEuxpHvmGGdwngbAVW_HNgaqzlmv_KNKqFManARu04tq0Mw";
				
						
						$requestData = $notification->getNotificatin();
						
								
							$fields = array(
								'to' => '/topics/global',
								'data' => $requestData,
							);	
			
		
						// Set POST variables
						$url = 'https://fcm.googleapis.com/fcm/send';
 
						$headers = array(
							'Authorization: key=' . $firebase_api,
							'Content-Type: application/json'
						);
						
						// Open connection
						$ch = curl_init();
 
						// Set the url, number of POST vars, POST data
						curl_setopt($ch, CURLOPT_URL, $url);
 
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
						// Disabling SSL Certificate support temporarily
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
						// Execute post
						$result = curl_exec($ch);
						if($result === FALSE){
							die('Curl failed: ' . curl_error($ch));
						}
 
						// Close connection
						curl_close($ch);
						
						echo '<h2>Result</h2><hr/><h3>Request </h3><p><pre>';
						echo json_encode($fields,JSON_PRETTY_PRINT);
						echo '</pre></p><h3>Response </h3><p><pre>';
						echo $result;
						echo '</pre></p>';
						////
						
		?>
		<div class="alert alert-success">
			<strong>Peringatan Dini Berhasil dibuat</strong>
		</div>
			 <a href="index.php?page=peringatan_dini" class="btn btn-primary">Lihat Peringatan Dini</a>

		<?php
	}

	else
	{

	?>

	<form class="form-horizontal" action="index.php?page=buat_peringatan_dini" method="post">
		<div class="form-group">
		  <label class="col-md-2 control-label">Judul:</label>
		  <div class="col-md-4">
                <input type="text" class="form-control" name="judul">
            </div>
		</div>

		<div class="form-group">
		  <label class="col-md-2 control-label">Informasi:</label>
		  <div class="col-md-4">
               <textarea class="form-control" rows="10" name="informasi"></textarea>
		 </div>
		</div>

	<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-2 control-label"></label>
		  <div class="col-md-8">
		    <a href="index.php?page=peringatan_dini" class="btn btn-default">Kembali</a>
		    <button type="submit" class="btn btn-primary">Submit</button>
		  </div>
		</div>
		 </form>
	<?php
		}
	?>