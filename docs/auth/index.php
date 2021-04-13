<?php

error_reporting(0);
if (isset($_POST['key'])) {
	$me = @$_POST['key'];
	require __DIR__ . '/../../include/api_oauthsystem.php';
	$getjsondbmysql = auth_api_getdata();
	if ($getjsondbmysql == 'error_conn') {
		$errordb = true;
	} elseif ($getjsondbmysql == 'error_db') {
		$errordb = true;
	} else {
		$apicheck = json_decode($getjsondbmysql);
		foreach ($apicheck as $keys) {
			if ($keys->key == $me) {
				$apikey_check = true;
				$keyss = $keys->key;
			}
		}
	}
	if (@$apikey_check == true) {
		setcookie('auth_fadhil_login', hash('sha512', $keyss), time() + 3600, '/');
		header("location: /docs/");
		exit();
	} else {
		$keysalah = true;
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" action="" method="POST">
					<span class="login100-form-title p-b-49">
						Login
					</span>

					<div class="wrap-input100 validate-input" data-validate="Key dibutuhkan, jika tidak punya. silahkan kontak @fadhil_riyanto di telegram">
						<input class="input100" type="password" name="key" placeholder="Masukkan key" autocomplete="off">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="text-right p-t-8 p-b-31">

					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>




				</form>
			</div>
		</div>
	</div>
	<!-- Button trigger modal -->




	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<?php
	if ($errordb == true) {
		echo "
		<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
		<div class='modal-dialog' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title' id='exampleModalLabel'>Kesalahan Server</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
					Error fetch data from MYSQL engine, coba lagi nanti atau hubungi <a href='https://t.me/fadhil_riyanto'>@fadhil_riyanto</a>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>

				</div>
			</div>
		</div>
	</div>

		
		<script>
	$('#exampleModal').modal({
		show: true
	})
</script>";
	} elseif ($keysalah == true) {
		echo "
		<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
		<div class='modal-dialog' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title' id='exampleModalLabel'>Kesalahan</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
					Apikey yang anda masukkan salah.<br></br> jika anda tidak punya apikey, anda bisa menghubungi <a href='https://t.me/fadhil_riyanto'>@fadhil_riyanto</a> di telegram untuk mendapatkan apikey
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>

				</div>
			</div>
		</div>
	</div>

		
		<script>
	$('#exampleModal').modal({
		show: true
	})
</script>";
	}
	?>

</body>

</html>