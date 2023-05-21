<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../config/database.php";
	$username		= mysqli_real_escape_string($koneksi, $_POST['username']);
	$password		= md5(mysqli_real_escape_string($koneksi, $_POST['password']));
	
	$action 			= $_GET['action'];
	$notification_ip	= $_SERVER['REMOTE_ADDR'];
	
	if ($action == "in") {
		
		$cdb = mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE guru_username='$username' AND guru_password='$password' AND guru_status='Aktif'");
		if (mysqli_num_rows($cdb) == 1) {
			$cdt = mysqli_fetch_array($cdb);
			$postdated					= date("Y-m-d H:i:s");
			$_SESSION['guru_username'] 	= $cdt['guru_username'];
			$_SESSION['guru_nama'] 		= $cdt['guru_nama'];
			$_SESSION['nip'] 			= $cdt['nip'];
			if ($cdt['guru_username']=="$username" AND $cdt['guru_status']=="Aktif") {
				
				header("location:/beranda");
				
			} 
			
		} else {
			$cdb = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE nisn='$username' AND siswa_password='$password' AND siswa_status='Aktif'");
			if (mysqli_num_rows($cdb) == 1) {
				$cdt = mysqli_fetch_array($cdb);
				$postdated					= date("Y-m-d H:i:s");
				$_SESSION['nisn'] 			= $cdt['nisn'];
				$_SESSION['siswa_nama'] 	= $cdt['siswa_nama'];
				if ($cdt['nisn']=="$username" AND $cdt['siswa_status']=="Aktif") {
					
					header("location:/beranda");
					
				} 
				
			}else{
				$postdated			= date("Y-m-d H:i:s");
				$notification_ip	= $_SERVER['REMOTE_ADDR'];
				header("location:/errorloginguru");
			}				
		}
		
	} elseif ($action == "out") {
		
		if(isset($_SESSION['nip'])){
			unset($_SESSION['guru_username']);
			unset($_SESSION['guru_nama']);
			unset($_SESSION['nip']);
		}else{
			unset($_SESSION['siswa_nama']);
			unset($_SESSION['nisn']);
		}
		
		header("location:/");	
	}
?>
