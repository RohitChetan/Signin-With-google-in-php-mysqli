<?php

require('config.php');

$loginbutton = '';

if(isset($_GET['code'])){

	$data = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);

	$google_client->setAccessToken($data['access_token']);

	// AANA MADAD THI aapdne access token malese 
	$_SESSION['token'] = $data['access_token'];


	$gdata = new Google_Service_Oauth2($google_client);

	$udata = $gdata->userinfo->get();

	$gid = $udata['id'];


	$checkdata = "SELECT * FROM userdata WHERE gid = $gid";

	$test = mysqli_query($conn,$checkdata);

	$fetcdata = mysqli_fetch_array($test);

	if($fetcdata<1){

		$insert = mysqli_query($conn,"INSERT INTO userdata(name,email,picture,gid,verfied) VALUES('$udata->name','$udata->email','$udata->picture','$udata->id','$udata->verifiedEmail')");

		if($insert){

			if(!empty($udata->name)){

				$_SESSION['name'] = $udata->name;
			}

			if(!empty($udata->email)){

				$_SESSION['email'] = $udata->email;
			}

			if(!empty($udata->picture)){

				$_SESSION['picture'] = $udata->picture;
			}

			if(!empty($udata->id)){

				$_SESSION['id'] = $udata->id;
			}

			if(!empty($udata->verifiedEmail)){

				$_SESSION['verifiedEmail'] = $udata->verifiedEmail;
			}
			?>
				<script> alert('Data Inserted'); </script>
				<script> window.location.href="http://localhost/google-APi/practice_signin-with-google/data.php"; </script>
			<?php

			
			
		}else{
			?>
				<script> alert('Data Inserted Failed]'); </script>
			<?php
		}
	}else{

		echo "test failed";
	}
	



}


if(!isset($_SESSION['access_token'])){

	$loginbutton = '<a href="'.$google_client->createAuthUrl().'"><button> Login With Google </button></a>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

	<div class="container">
		<div class="align-center">
			<?php if(!empty($loginbutton)){echo $loginbutton;} ?>
		</div>
	</div>
	
</body>
</html>