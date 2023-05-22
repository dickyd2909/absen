<?php
	session_start();
	include "../config/function.php";
	include "../config/database.php";
	date_default_timezone_set('Asia/Jakarta');
	
	if($_GET['m'] == 'ruangtambah'){	
		$stringreplace 			= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
		$ruang_nama				= $_POST['ruang_nama'];
		$ruang_gedung			= $_POST['ruang_gedung'];
		$ruang_status			= $_POST['ruang_status'];
		
		
		$gedung					= substr($ruang_gedung,-2,2);
		$ruang_id				= $gedung."".$ruang_nama;	
		$sql = insert("INSERT INTO tb_ruang (ruang_id, ruang_nama, ruang_gedung, ruang_status) VALUES ('$ruang_id', '$ruang_nama', '$ruang_gedung','$ruang_status')");
		
		if($sql == true){
			$_SESSION['success'] = 'Data Ruang Berhasil Ditambahkan';
		}else{
			$_SESSION['error'] = 'Tambah Data Ruang Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/ruang'>";
	}else if($_GET['m'] == 'ruangedit'){
		$ruang_id			= $_POST['ruang_id'];
		$ruang_nama			= $_POST['ruang_nama'];
		$ruang_gedung		= $_POST['ruang_gedung'];
		$ruang_status		= $_POST['ruang_status'];
		$gedung				= substr($ruang_gedung,-2,2);
		$ruang_id2			= $gedung."".$ruang_nama;	
		
		$sql = update("UPDATE tb_ruang SET
		ruang_id			= '$ruang_id2',
		ruang_nama			= '$ruang_nama',
		ruang_gedung		= '$ruang_gedung',
		ruang_status		= '$ruang_status'
		WHERE ruang_id		= '$ruang_id'");
		
		if($sql == true){
			$_SESSION['success'] = 'Data Ruang Berhasil Diubah!';
		}else{
			$_SESSION['error'] = 'Perubahan Data Ruang Gagal!';
		}	
		
		echo "<meta http-equiv='refresh' content='0; url=/ruang'>";	
	}else if($_GET['m'] == 'ruanghapus'){
		$id = trim($_GET['id']);
		
		$sql = hapus("DELETE FROM tb_ruang WHERE ruang_id = '$id'");
		if($sql == true){
			$_SESSION['success'] = 'Data Ruang Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Ruang Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/ruang'>";
	}
?>