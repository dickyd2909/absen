<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
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
		<link href="assets/images/smk2logo.png" rel="shortcut icon" type="image/x-icon">
		<title>Error Login - SMKN 2 CIMAHI</title>
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
					<div class="errorpage">
						Password Atau Username anda salah!, silahkan coba lagi!
					</div>
					<div class="errorpagebtn">
						<a href="cms">Login</a>
					</div>
				</div>
			</div>
		</div>
	</Body>
	<script>
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }

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