<?php
	session_start();
	include "../config/function.php";
	include "../config/database.php";
	date_default_timezone_set('Asia/Jakarta');
	if($_GET['m'] == 'presensitambah'){	
		// var_dump($_POST);
		$jadwal_id				= mysqli_real_escape_string($koneksi, $_POST['jadwal_id']);
		$presensi_tanggal		= mysqli_real_escape_string($koneksi, $_POST['presensi_tanggal']);
		
		$sql = insert("INSERT INTO tb_presensi (presensi_id, jadwal_id, presensi_tanggal) VALUES (NULL, '$jadwal_id', '$presensi_tanggal')");
	
		if($sql == true){
			$_SESSION['success'] = 'Data Presensi Berhasil Ditambahkan';
		}else{
			$_SESSION['error'] = 'Tambah Data Presensi Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/presensi-$jadwal_id'>";
		
	}else if($_GET['m'] == 'presensiedit'){
		$presensi_id			= mysqli_real_escape_string($koneksi, $_POST['presensi_id']);
		$jadwal_id				= mysqli_real_escape_string($koneksi, $_POST['jadwal_id']);
		$presensi_tanggal		= mysqli_real_escape_string($koneksi, $_POST['presensi_tanggal']);
		
		$sql = update("UPDATE tb_presensi SET
		jadwal_id			= '$jadwal_id',
		presensi_tanggal	= '$presensi_tanggal'
		WHERE presensi_id	= '$presensi_id'");
		
		if($sql == true){
			$_SESSION['success'] = 'Data Presensi Berhasil Diubah!';
		}else{
			$_SESSION['error'] = 'Perubahan Data Presensi Gagal!';
		}	
		
		echo "<meta http-equiv='refresh' content='0; url=/presensi-$jadwal_id'>";	
	}else if($_GET['m'] == 'presensihapus'){
		$id = trim($_GET['id']);
		
		$sql = hapus("DELETE FROM tb_presensi WHERE presensi_id = '$id'");
		if($sql == true && $sql2){
			$_SESSION['success'] = 'Data Presensi Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Presensi Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/presensi-$jadwal_id'>";
	}
?>