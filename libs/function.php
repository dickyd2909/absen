<?php 
	// MODULES FILE
	function view($file) {
		$dir = "view/".$file.".php";
		if(file_exists($dir)) {
			include $dir;
		} else {
			echo "No Content";
		}
	}
	
	function controller($file) {
		$dir = "controller/".$file.".php";
		if(file_exists($dir)) {
			include $dir;
		} else {
			echo "No Content";
		}
	}
	
	function temp($file) {
		$dir = "templates/".$file.".php";
		if(file_exists($dir)) {
			include $dir;
		} else {
			echo "No Content";
		}
	}
	
	function select($file) {
		include "../config/database.php";
		$id = mysqli_query($koneksi, $file) or die (mysqli_error($koneksi));
		return $id;
	}
	
	function insert($file) {
		include "../config/database.php";
		$id = mysqli_query($koneksi, $file) or die (mysqli_error($koneksi));
		return $id;
	}
	
	function hapus($file) {
		include "../config/database.php";
		$id = mysqli_query($koneksi, $file) or die (mysqli_error($koneksi));
		return $id;
	}
	
	function update($file) {
		include "../config/database.php";
		$id = mysqli_query($koneksi, $file) or die (mysqli_error($koneksi));
		return $id;
	}
	
	function fetch($file) {
		include "../config/database.php";
		$id = mysqli_fetch_array($file);
		return $id;
	}
	function rows($file) {
		include "../config/database.php";
		$id = mysqli_num_rows($file);
		return $id;
	}
	
	function hariindo($d){
		$hari = date_format(date_create($d), 'D');
	 
		switch($hari){
			case 'Sun':
				$hari_ini = "Minggu";
			break;
	 
			case 'Mon':			
				$hari_ini = "Senin";
			break;
	 
			case 'Tue':
				$hari_ini = "Selasa";
			break;
	 
			case 'Wed':
				$hari_ini = "Rabu";
			break;
	 
			case 'Thu':
				$hari_ini = "Kamis";
			break;
	 
			case 'Fri':
				$hari_ini = "Jumat";
			break;
	 
			case 'Sat':
				$hari_ini = "Sabtu";
			break;
			
			default:
				$hari_ini = "Tidak di ketahui";		
			break;
		}
	 
		return $hari_ini;
	 
	}
?>