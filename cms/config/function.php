<?php 
	// MODULES FILE
	function views($file) {
		$dir = "../view/".$file.".php";
		if(file_exists($dir)) {
			include $dir;
		} else {
			echo "No Content";
		}
	}
	
	function controller($file) {
		$dir = "../controller/".$file.".php";
		if(file_exists($dir)) {
			include $dir;
		} else {
			echo "No Content";
		}
	}
	
	function select($file) {
		include "../../config/database.php";
		$id = mysqli_query($koneksi, $file) or die (mysqli_error($koneksi));
		return $id;
	}
	
	function insert($file) {
		include "../../config/database.php";
		$id = mysqli_query($koneksi, $file) or die (mysqli_error($koneksi));
		return $id;
	}
	
	function hapus($file) {
		include "../../config/database.php";
		$id = mysqli_query($koneksi, $file) or die (mysqli_error($koneksi));
		return $id;
	}
	
	function update($file) {
		include "../../config/database.php";
		$id = mysqli_query($koneksi, $file) or die (mysqli_error($koneksi));
		return $id;
	}
	
	function fetch($file) {
		include "../../config/database.php";
		$id = mysqli_fetch_array($file);
		return $id;
	}
	
?>