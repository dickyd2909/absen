<?php
	session_start();
	include "../config/function.php";
	include "../config/database.php";
	date_default_timezone_set('Asia/Jakarta');
	
	if($_GET['m'] == 'mapeltambah'){		
		$mapel_nama			= $_POST['mapel_nama'];
		$mapel_jampel		= $_POST['mapel_jampel'];
		$mapel_status		= $_POST['mapel_status'];
		
		$sql = insert("INSERT INTO tb_mapel (mapel_id, mapel_nama, mapel_jampel, mapel_status) VALUES (NULL, '$mapel_nama', '$mapel_jampel', '$mapel_status')");
		
		if($sql == true){
			$_SESSION['success'] = 'Data Mata Pelajaran Berhasil Ditambahkan';
		}else{
			$_SESSION['error'] = 'Tambah Data Mata Pelajaran Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/mapel'>";
	}else if($_GET['m'] == 'mapeledit'){
		$mapel_id			= $_POST['mapel_id'];
		$mapel_nama			= $_POST['mapel_nama'];
		$mapel_jampel		= $_POST['mapel_jampel'];
		$mapel_status		= $_POST['mapel_status'];
		
		$sql = update("UPDATE tb_mapel SET
		mapel_nama			= '$mapel_nama',
		mapel_jampel		= '$mapel_jampel',
		mapel_status		= '$mapel_status'
		WHERE mapel_id		= '$mapel_id'");
		
		if($sql == true){
			$_SESSION['success'] = 'Data Mata Pelajaran Berhasil Diubah!';
		}else{
			$_SESSION['error'] = 'Perubahan Data Mata Pelajaran Gagal!';
		}	
		
		echo "<meta http-equiv='refresh' content='0; url=/mapel'>";	
	}else if($_GET['m'] == 'mapelhapus'){
		$id = trim($_GET['id']);
		
		$sql = hapus("DELETE FROM tb_mapel WHERE mapel_id = '$id'");
		if($sql == true){
			$_SESSION['success'] = 'Data Mata Pelajaran Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Mata Pelajaran Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/mapel'>";
	}
?>