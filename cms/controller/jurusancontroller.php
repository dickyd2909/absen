<?php
	session_start();
	include "../config/function.php";
	include "../config/database.php";
	date_default_timezone_set('Asia/Jakarta');
	
	if($_GET['m'] == 'jurusantambah'){		
		$jurusan_id				= $_POST['jurusan_id'];
		$jurusan_nama			= $_POST['jurusan_nama'];
		$jurusan_status			= $_POST['jurusan_status'];
		
		$query = select("SELECT * FROM tb_jurusan WHERE jurusan_id = '$jurusan_id'");
		$rows = mysqli_num_rows($query);
		if($rows > 0){
			$_SESSION['error'] = 'Id sudah digunakan silahkan gunakan yang lain!';
		}else{
			
			$sql = insert("INSERT INTO tb_jurusan (jurusan_id, jurusan_nama, jurusan_status) VALUES ('$jurusan_id', '$jurusan_nama', '$jurusan_status')");
			
			if($sql == true){
				$_SESSION['success'] = 'Data Jurusan Berhasil Ditambahkan';
			}else{
				$_SESSION['error'] = 'Tambah Data Jurusan Gagal!';
			}	
		}	
		echo "<meta http-equiv='refresh' content='0; url=/jurusan'>";
	}else if($_GET['m'] == 'jurusanedit'){
		$jurusan_id				= $_POST['jurusan_id'];
		$jurusan_idlama			= $_POST['jurusan_idlama'];
		$jurusan_nama			= $_POST['jurusan_nama'];
		$jurusan_status			= $_POST['jurusan_status'];
		
		$sql = update("UPDATE tb_jurusan SET
		jurusan_id				= '$jurusan_id',
		jurusan_nama			= '$jurusan_nama',
		jurusan_status			= '$jurusan_status'
		WHERE jurusan_id		= '$jurusan_idlama'");
		
		if($sql == true){
			$_SESSION['success'] = 'Data Jurusan Berhasil Diubah!';
		}else{
			$_SESSION['error'] = 'Perubahan Data Jurusan Gagal!';
		}	
		
		echo "<meta http-equiv='refresh' content='0; url=/jurusan'>";	
	}else if($_GET['m'] == 'jurusanhapus'){
		$id = trim($_GET['id']);
		
		$sql = hapus("DELETE FROM tb_jurusan WHERE jurusan_id = '$id'");
		if($sql == true){
			$_SESSION['success'] = 'Data Jurusan Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Jurusan Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/jurusan'>";
	}
?>