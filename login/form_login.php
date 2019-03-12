<?php
	include('cek_login.php'); // Includes Login Script

	if(isset($_SESSION['login_user'])){
		header("location: index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login BPBD Kota Kupang</title>	
		<link href="style.css" rel="stylesheet" type="text/css">	
		<meta charset='utf-8'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="icon" href="../image/bpbd.png"/>
        <link rel="shortcut icon" href="../image/bpbd.png" type="image/x-icon" />
  
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<!-- Custom CSS -->
   		<link href="../css/sb-admin.css" rel="stylesheet">
		<!-- Custom Fonts -->
    	<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- jQuery -->
	    <script src="../js/jquery.js"></script>
	    <!-- Bootstrap Core JavaScript -->
	    <script src="../js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class = "container">
			<div class="wrapper">
				<form action="" method="post" name="Login_Form" class="form-signin">       
				    <h3 class="form-signin-heading">Login Dashboard BPBD Kota Kupang</h3>
				    <img src="../image/bpbd.png" class="img-responsive center-block" width=130px height=130px/>
					  <hr class="colorgraph"><br>
					  
					  <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
					  <input type="password" class="form-control" name="password" placeholder="Password" required=""/>     		  
					 
					  <button class="btn btn-lg btn-primary btn-block"  name="submit" value="login" type="Submit">Login</button>  			
					<div></div>
					<?php
						if($error == "ya") { ?>
						<div class="msg msg-danger msg-danger-text"> Username atau Password salah!</div>
							<?php
						}
					?>
				</form>			
			</div>
		</div>
	</body>
</html>