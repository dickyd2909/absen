<?php
	session_start();
	include "../config/function.php";
	include "../config/database.php";
	date_default_timezone_set('Asia/Jakarta');
	if($_GET['m'] == 'presensisiswatambah'){	
		// var_dump($_POST);
		$presensi_id				= mysqli_real_escape_string($koneksi, $_POST['presensi_id']);
		$nisn						= mysqli_real_escape_string($koneksi, $_POST['nisn']);
		$presensisiswa_jammasuk		= mysqli_real_escape_string($koneksi, $_POST['presensisiswa_jammasuk']);
		$presensisiswa_jamkeluar	= mysqli_real_escape_string($koneksi, $_POST['presensisiswa_jamkeluar']);
		$presensisiswa_status		= mysqli_real_escape_string($koneksi, $_POST['presensisiswa_status']);
		
		$sql = insert("INSERT INTO tb_presensisiswa (presensisiswa_id, presensi_id, nisn, presensisiswa_jammasuk, presensisiswa_jamkeluar, presensisiswa_status) VALUES (NULL, '$presensi_id', '$nisn', '$presensisiswa_jammasuk', '$presensisiswa_jamkeluar', '$presensisiswa_status')");
	
		if($sql == true){
			$_SESSION['success'] = 'Data Presensi Siswa Berhasil Ditambahkan';
		}else{
			$_SESSION['error'] = 'Tambah Data Presensi Siswa Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/presensisiswa-$presensi_id'>";
		
	}else if($_GET['m'] == 'presensisiswaedit'){
		$presensisiswa_id		= mysqli_real_escape_string($koneksi, $_POST['presensisiswa_id']);
		$presensi_id			= mysqli_real_escape_string($koneksi, $_POST['presensi_id']);
		$presensisiswa_jammasuk		= mysqli_real_escape_string($koneksi, $_POST['presensisiswa_jammasuk']);
		$presensisiswa_jamkeluar	= mysqli_real_escape_string($koneksi, $_POST['presensisiswa_jamkeluar']);
		$presensisiswa_status		= mysqli_real_escape_string($koneksi, $_POST['presensisiswa_status']);
		
		$sql = update("UPDATE tb_presensisiswa SET
		presensi_id				= '$presensi_id',
		presensisiswa_jammasuk	= '$presensisiswa_jammasuk',
		presensisiswa_jamkeluar	= '$presensisiswa_jamkeluar',
		presensisiswa_status	= '$presensisiswa_status'
		WHERE presensisiswa_id	= '$presensisiswa_id'");
		
		if($sql == true){
			$_SESSION['success'] = 'Data Presensi Siswa Berhasil Diubah!';
		}else{
			$_SESSION['error'] = 'Perubahan Data Presensi Siswa Gagal!';
		}	
		
		echo "<meta http-equiv='refresh' content='0; url=/presensisiswa-$presensi_id'>";	
	}else if($_GET['m'] == 'presensisiswahapus'){
		$id 	= trim($_GET['id']);
		$psdb 	= select("SELECT * FROM tb_presensisiswa WHERE presensisiswa_id = '$id'");
		$psdt	= fetch($psdb);
		$presensi_id = $psdt['presensi_id'];
		$sql = hapus("DELETE FROM tb_presensisiswa WHERE presensisiswa_id = '$id'");
		if($sql == true){
			$_SESSION['success'] = 'Data Presensi Siswa Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Presensi Siswa Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/presensisiswa-$presensi_id'>";
	}
?>