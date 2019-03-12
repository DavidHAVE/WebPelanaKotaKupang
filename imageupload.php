<?php 
	
	include "dashboard/config/koneksi.php";

	//An array to display the response
	$response = array();

	//if the call is an api call 
	if(isset($_GET['apicall'])){
		
		//switching the api call 
		switch($_GET['apicall']){
			

//UPLOAD FOTO LAPORAN
			//if it is an upload call we will upload the image
			case 'uploadpic':
				
				//first confirming that we have the image and tags in the request parameter
                if (isset($_FILES['uploaded_file']['name'])) {

					// $tags = $_POST['tags'];
					$lokasi_file = $_FILES['uploaded_file'] ['tmp_name'];



					$foto = $_FILES['uploaded_file']['name'];
					$tmp = $_FILES['uploaded_file']['tmp_name'];

					  
					// Rename nama fotonya dengan menambahkan tanggal dan jam upload
					date_default_timezone_set('Asia/Jakarta');
					$fotobaru = date('dmYHis').$foto;
					// Set path folder tempat menyimpan fotonya
					$path = "foto_laporan/".$fotobaru;
					// Proses upload

					if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak


						$input = "INSERT INTO laporan(foto) VALUES ('$fotobaru')";

						$sql = mysqli_query($konek, $input);

						if ($sql) {
							$query = "SELECT * FROM laporan WHERE foto = '$fotobaru'";
							$tampil = mysqli_query($konek, $query);
							$r=mysqli_fetch_array($tampil);

							$image_id = $r['laporan_id'];

							if ($tampil) {
								$response['error'] = false; 
				 				$response['message'] = 'Read successfull'; 
				 				$response['laporan_id'] = $image_id.""; 
							}

						}else{
								// echo "Menyimpan di database gagal.";
								$response['error'] = true; 
				 				$response['message'] = 'Insert unsuccessfull'; 
						}
					}else{
							// echo "Gambar gagal diupload.";
							$response['error'] = true; 
				 			$response['message'] = 'Upload unsuccessfull'; 
					}
				}else{
					$response['error'] = true;
					$response['message'] = "Required params not available";
				}
			
			break;
			
			
			default: 
				$response['error'] = true;
				$response['message'] = 'Invalid api call';
		}
		
	}else{
		header("HTTP/1.0 404 Not Found");
		echo "<h1>404 Not Found</h1>";
		echo "The page that you have requested could not be found.";
		exit();
	}
	
	//displaying the response in json 
	header('Content-Type: application/json');
	echo json_encode($response);
	
?>
