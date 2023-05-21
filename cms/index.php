<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include "../config/database.php"; ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta charset="utf-8">
		<meta name="author" content="ddfmaymh">
		<meta name="generator" content="phpnative">
		<meta name="robots" content="index, follow">
		<meta name="developer" content="informatikaitenas">
		<meta name="rating" content="general">
		<meta name="spiders" content="all">	
		<meta name="description" content="Presensi SMKN 2 Cimahi adalah aplikasi absen online siswa">
		<meta name="keywords" content="presensi smkn 2 cimahi, presensi smk 2, presensi online smkn 2 cimahi">
		<meta http-equiv="copyright" content="SMK NEGERI 2 CIMAHI 2022">
		<link href="assets/images/smk2logo.png" rel="shortcut icon" type="image/x-icon" />
		<link href="assets/css/login.css" rel="stylesheet" type="text/css" />
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<script src="../assets/fontawesome/fontawesome.js"></script>
		<script src="../assets/fontawesome/fontawesome.min.js"></script>
		<script src="../assets/fontawesome/all.js"></script>
		<script src="../assets/fontawesome/all.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
		<title>Login Presensi SMKN 2 CIMAHI</title>
	</head>
	<Body>
		<!-- TOP MENU -->
		<div id="bgtop">
			<div id="botop" class="clearfix">
				<div class="topimg">
					<img src="assets/images/smk2logo.png" alt="Presensi SMKN 2 CIMAHI" title="Presensi SMKN 2 CIMAHI">
				</div>
				<div class="toptext">
					<h1>SMK NEGERI 2 CIMAHI</h1>
				</div>
			</div>
		</div>
		
		<!-- Login section -->
		<div id="bgcontainer">
			<div id="bocontainer">
				<div id="container">
					<div class="containerimg">
						<img src="assets/images/smk2logo.png" alt="Presensi SMKN 2 CIMAHI" title="Presensi SMKN 2 CIMAHI">
					</div>
					<div class="containertit">
						Login Admin
					</div>
					<div class="lines"></div>
					<div class="containersubtit">
						Selamat datang di presensi SMK NEGERI 2 CIMAHI.<br><span>silahkan login terlebih dahulu!</span>
					</div>
					<form action="/loginadmin" method="post">
						<input type="text" name="admin_username"  class="loginform" placeholder="Username" required></input>
						<div class="iconeye">
							<input type="password" name="admin_password"  class="loginform" placeholder="Password" required  id="id_password"><i class="far fa-eye" id="togglePassword" onclick="showPassword()"></i>
						</div>	
						<input type="submit" name="submit" class="loginformbtn" value="Masuk" required>
					</form>
				</div>
			</div>
		</div>
	</Body>
	<script>
		function showPassword(){
			var x = document.getElementById("id_password");
			var i = document.querySelector('#togglePassword');
			if(x.type === "password"){
				x.type = "text";
				i.classList.add("fa-eye-slash");
			}else{
				x.type = "password";
				i.classList.add("fa-eye");
			}
		}
		
		
    </script>
</html>