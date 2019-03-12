<?php 

	include "dashboard/config/koneksi.php";
	
	$response = array();
	
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){

//REGISTER PENGGUNA
            case 'register_pengguna':
				if(isTheseParametersAvailable(array('nama','nomor_telepon', 'email'))){

					$nama = $_POST['nama'];
					$nomor_telepon = $_POST['nomor_telepon'];
					$email = $_POST['email'];

					$sql = "SELECT count(nomor_telepon) FROM pengguna";
				    $query = mysqli_query($konek, $sql);
				    $row = mysqli_fetch_row($query);
				    //total row count
				    $rows = $row[0];

				    if($rows > 0){
		
						$input = "INSERT INTO pengguna (nama, nomor_telepon, email) VALUES ('".$nama."', '".$nomor_telepon."', '".$email."')";
	 
						 if(mysqli_query($konek, $input)){
							 $response['error'] = false; 
							 $response['message'] = 'successfull registered'; 
						 
						 }
						 else{
							$response['error'] = true; 
							$response['message'] = 'unsuccessfull registered'; 
						 }
					 
					 }else{
						$response['error'] = true; 
						$response['message'] = 'Account already registered'; 
					 }

				}else{
					$response['error'] = true; 
					$response['message'] = 'are not available'; 
				}
					
			break; 


			//READ PENGGUNA
            case 'read_pengguna':
				if (isset($_GET['pengguna_id'])) {

					    $pengguna_id = $_GET['pengguna_id'];
			
						$sql = "SELECT * FROM pengguna WHERE pengguna_id = '$pengguna_id'";
		 
    		 			//Getting result 
    		 			$result = mysqli_query($konek, $sql); 
    
    			
    					 //Adding results to an array 
    					 $res = array(); 
    
    					 if ($result) {
    					 
    						 while($row = mysqli_fetch_array($result)){
    
    			 				$pengguna = array(
    											"nama"=>$row['nama'], 
    											"nomor_telepon"=>$row['nomor_telepon'],
    											"email"=>$row['email']
    										);
    
    			 				$response['error'] = false; 
    			 				$response['message'] = 'Retrieve successfull'; 
    			 				$response['pengguna'] = $pengguna; 
    			 			}
    		 			}else{
    		 				$response['error'] = true; 
    			 			$response['message'] = 'Retrieve Unsuccessfull'; 
    		 			}
				}

			break; 


//UPDATE PENGGUNA
			case 'update_pengguna':
				
			if(isTheseParametersAvailable(array('pengguna_id'))){
					
				if (isset($_POST['pengguna_id'])) {

					$pengguna_id = $_POST['pengguna_id'];
					$nama = $_POST['nama'];
					$email = $_POST['email'];

					// $sql = "SELECT * FROM seller WHERE password = '$password'";


					$edit = "UPDATE pengguna SET nama = '$nama', email = '$email'
				    WHERE pengguna_id = '$pengguna_id'";

		 			//Getting result 
		 			$result = mysqli_query($konek, $edit); 

		 			if ($result) {
		 				$response['error'] = false; 
		 				$response['message'] = 'update successfull'; 
		 			}else{
		 				$response['error'] = true; 
		 				$response['message'] = 'update unsuccessfull'; 
		 			}

		 			// }
			 // Displaying the array in json format 
 			// echo json_encode($response);
			 // echo json_encode($res);
 				}
 			}else{
				$response['error'] = true; 
				$response['message'] = 'are not available'; 
			}	

			break; 


//LOGIN

			case 'login':
				
			if(isTheseParametersAvailable(array('nama', 'nomor_telepon'))){
					
				if (isset($_POST['nama'])) {

					$nama = $_POST['nama'];
					$nomor_telepon = $_POST['nomor_telepon'];

					$sql = "SELECT * FROM pengguna WHERE nama = '$nama' AND nomor_telepon = '$nomor_telepon'";

		 
		 			//Getting result 
		 			$result = mysqli_query($konek, $sql); 

			
					 //Adding results to an array 
					 $res = array(); 

					 if ($result) {
					 
						 while($row = mysqli_fetch_array($result)){

						 	if ($row['blok'] == "0") {

				 				$pengguna = array(
											'pengguna_id'=>$row['pengguna_id'], 
											'nama'=>$row['nama'], 
											'nomor_telepon'=>$row['nomor_telepon'],
											'email'=>$row['email']
										);

				 				$response['error'] = false; 
				 				$response['message'] = 'Login successfull'; 
				 				$response['pengguna'] = $pengguna; 

				 			}else{
				 				$response['error'] = true; 
			 					$response['message'] = 'Account has been blocked'; 
				 			}
			 			}
		 			}else{
		 				$response['error'] = true; 
			 			$response['message'] = 'Login Unsuccessfull'; 
		 			}
 				}
 				else{
		 				$response['error'] = true; 
			 			$response['message'] = 'post Unsuccessfull'; 
		 			}
 			}else{
		 				$response['error'] = true; 
			 			$response['message'] = 'parameter salah'; 
		 			}	

			break; 


//REGISTER LAPORAN
			case 'register_laporan_pic':
				if(isTheseParametersAvailable(array('laporan_id', 'tanggal'))){

                            date_default_timezone_set('Asia/Jakarta');

                            
							$tanggal = $_POST['tanggal'];
							

                            $format_date  = date('Y-m-d H:i:s', strtotime($tanggal));

							$latitude = $_POST['latitude'];
							$longitude = $_POST['longitude'];
							$alamat = $_POST['alamat'];
							$jenis_kejadian = $_POST['jenis_kejadian'];
							$informasi = $_POST['informasi'];
							$pengguna_id = $_POST['pengguna_id'];
                            
                            $laporan_id = $_POST['laporan_id'];
							
				
							$edit = "UPDATE laporan SET tanggal = '$format_date', latitude = '$latitude', longitude = '$longitude', alamat = '$alamat', jenis_kejadian = '$jenis_kejadian', informasi = '$informasi', pengguna_id = '$pengguna_id' WHERE laporan_id = '$laporan_id'";
		 
		 						$sql = mysqli_query($konek, $edit);
							 if($sql){

							 	$query = "SELECT laporan_id FROM laporan WHERE tanggal = '$format_date'";
								$tampil = mysqli_query($konek, $query);
								$r=mysqli_fetch_array($tampil);

							     $laporan_id = $r['laporan_id'];

							    if ($tampil) {
									 $response['error'] = false; 
									 $response['message'] = 'sukses membaca'; 
									 $response['laporan_id'] = $laporan_id;
								}else{
									$response['error'] = true; 
									$response['message'] = 'gagal membaca'; 
								}
								
								////
									require_once __DIR__ . '/notifications/notification.php';
						$notification = new Notification();
	
						$title = "Info " . $jenis_kejadian;
						$message = $informasi." di ".$alamat." pada ".$tanggal;
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
							 
							 }else{
								$response['error'] = true; 
								$response['message'] = 'gagal mengubah'; 
							 }
				}else{
					$response['error'] = true; 
					$response['message'] = 'are not available'; 
				}
					
			
			break; 



//READ LAPORAN TERAKHIR
			case 'read_latest_laporan':
				

					$sql = "SELECT * FROM laporan WHERE tanggal =  (SELECT max(tanggal) FROM laporan)";

		 
		 			//Getting result 
		 			$result = mysqli_query($konek, $sql); 

			
					 //Adding results to an array 
					 $res = array(); 

					 if ($result) {
					 
						 while($row = mysqli_fetch_array($result)){

			 				$latest_laporan = array(
											"tanggal"=>$row['tanggal'], 
											"latitude"=>$row['latitude'],
											"longitude"=>$row['longitude'],
											"alamat"=>$row['alamat'],
											"jenis_kejadian"=>$row['jenis_kejadian'],
											"foto"=>$row['foto'],
											"informasi"=>$row['informasi']
										);

			 				$response['error'] = false; 
			 				$response['message'] = 'Retrieve successfull'; 
			 				$response['latest_laporan'] = $latest_laporan; 
			 			}
		 			}else{
		 				$response['error'] = true; 
			 			$response['message'] = 'Retrieve Unsuccessfull'; 
		 			}

			break; 



//READ RIWAYAT LAPORAN
			case 'read_history_laporan':
					
							
					if (isset($_GET['pengguna_id'])) {

						$pengguna_id = $_GET['pengguna_id'];
			
						$sql = "SELECT * FROM laporan WHERE pengguna_id = '$pengguna_id' ORDER BY tanggal DESC";

			 			//Getting result 
			 			$result = mysqli_query($konek, $sql); 

				
						 //Adding results to an array 
						 $res = array(); 

						 if ($result) {
						 
 
							 while($row = mysqli_fetch_array($result)){
							 array_push($response, array(
							      'laporan_id'=>$row['laporan_id'],
								'tanggal'=>$row['tanggal'], 
												"latitude"=>$row['latitude'],
												"longitude"=>$row['longitude'],
												"alamat"=>$row['alamat'],
												"jenis_kejadian"=>$row['jenis_kejadian'],
												"foto"=>$row['foto'],
												"informasi"=>$row['informasi'],
												"pengguna_id"=>$row['pengguna_id'])
						 );
						 }
			 			}else{
			 				$response['error'] = true; 
				 			$response['message'] = 'Retrieve Unsuccessfull'; 
			 			}
					}
			break; 



//READ PERINGATAN DINI
			case 'read_peringatan_dini':
				
				    $tanggal = '';
				    $judul = '';
				    $informasi = '';
				    
					$sql = "SELECT * FROM peringatan_dini";

		 
		 			//Getting result 
		 			$result = mysqli_query($konek, $sql); 

			
					 //Adding results to an array 
					 $res = array(); 

					 if ($result) {
					 
						 while($row = mysqli_fetch_array($result)){
						     
						    $tanggal = $row['tanggal'];
						    $judul = $row['judul'];
						    $informasi = $row['informasi'];

			 				$peringatan_dini = array(
											'tanggal'=>$row['tanggal'], 
											'judul'=>$row['judul'],
											'informasi'=>$row['informasi']
										);

			 				$response['error'] = false; 
			 				$response['message'] = 'Retrieve successfull'; 
			 				$response['peringatan_dini'] = $peringatan_dini; 
			 			}
			 			
		 			}else{
		 				$response['error'] = true; 
			 			$response['message'] = 'Retrieve Unsuccessfull'; 
		 			}

			break; 



//READ PRAKIRAAN CUACA
			case 'read_prakiraan_cuaca':
				
					$sql = "SELECT * FROM prakiraan_cuaca";

		 
		 			//Getting result 
		 			$result = mysqli_query($konek, $sql); 

			
					 //Adding results to an array 
					 $res = array(); 

					 if ($result) {
					 
						 while($row = mysqli_fetch_array($result)){

			 				$prakiraan_cuaca = array(
											'tanggal'=>$row['tanggal'], 
											'informasi'=>$row['informasi'],
											'foto'=>$row['foto']
										);

			 				$response['error'] = false; 
			 				$response['message'] = 'Retrieve successfull'; 
			 				$response['prakiraan_cuaca'] = $prakiraan_cuaca; 
			 			}
		 			}else{
		 				$response['error'] = true; 
			 			$response['message'] = 'Retrieve Unsuccessfull'; 
		 			}

			break; 

			
			default: 
				$response['error'] = true; 
				$response['message'] = 'Invalid Operation Called';
			break;
		}
		
	}else{
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}
	
	echo json_encode($response);
	
	function isTheseParametersAvailable($params){
		
		foreach($params as $param){
			if(!isset($_POST[$param])){
				return false; 
			}
		}
		return true; 
	}