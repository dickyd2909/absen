<?php
	session_start();
	include "../config/function.php";
	include "../config/database.php";
	date_default_timezone_set('Asia/Jakarta');
	echo "<title>Loading..</title>";
	if($_GET['m'] == 'kelastambah'){	
		$stringreplace 			= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
		$jurusan_id				= $_POST['jurusan_id'];
		$nip					= $_POST['nip'];
		$kelas_nama				= $_POST['kelas_nama'];
		$kelas_tahunajaran		= $_POST['kelas_tahunajaran'];
		$kelas_status			= $_POST['kelas_status'];
		
		$ndb 					= select("SELECT MAX(lognoreg) AS NoTerakhir FROM tb_kelas WHERE jurusan_id = '$jurusan_id'");
		$ndt 					= fetch($ndb);
		$lastno 				= $ndt['NoTerakhir'];
		$nourut 				= (int) $lastno;
		$nourut++;
		$nokelas				= sprintf("%02s", $nourut);
		$nothnajar1				= substr($kelas_tahunajaran,2,2);
		$nothnajar2				= substr($kelas_tahunajaran,7);
		$nama					= strtoupper(str_replace($stringreplace,'',$kelas_nama));
		
		$kelas_id				= $jurusan_id."".$nama."".$nothnajar1."".$nothnajar2."".$nokelas;
		$lognoreg				= sprintf("%02s", $nourut);
		
		
		$update = update("UPDATE tb_guru SET guru_hashwali = '1' WHERE nip = '$nip'");
		
		$sql = insert("INSERT INTO tb_kelas (kelas_id, kelas_nama, kelas_tahunajaran, kelas_status, jurusan_id, nip, lognoreg) VALUES ('$kelas_id', '$kelas_nama', '$kelas_tahunajaran','$kelas_status', '$jurusan_id', '$nip', '$lognoreg')");
		
		if($sql == true){
			$_SESSION['success'] = 'Data Kelas Berhasil Ditambahkan';
		}else{
			$_SESSION['error'] = 'Tambah Data Kelas Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/kelas'>";
	}else if($_GET['m'] == 'kelasedit'){
		$kelas_id			= $_POST['kelas_id'];
		$kelas_idlama		= $_POST['kelas_idlama'];
		$kelas_nama			= $_POST['kelas_nama'];
		$kelas_tahunajaran	= $_POST['kelas_tahunajaran'];
		$kelas_status		= $_POST['kelas_status'];
		
		$jurusan_id			= $_POST['jurusan_id'];
		$nip				= $_POST['nip'];
		$niplama			= $_POST['niplama'];
		
		$updatehashno 	= update("UPDATE tb_guru SET guru_hashwali = '0' WHERE nip = '$niplama'");
		$updatehash		= update("UPDATE tb_guru SET guru_hashwali = '1' WHERE nip = '$nip'");
		
		$sql = update("UPDATE tb_kelas SET
		kelas_id			= '$kelas_id',
		kelas_nama			= '$kelas_nama',
		kelas_tahunajaran	= '$kelas_tahunajaran',
		kelas_status		= '$kelas_status',
		jurusan_id			= '$jurusan_id',
		nip					= '$nip'
		WHERE kelas_id		= '$kelas_idlama'");
		
		if($sql == true){
			$_SESSION['success'] = 'Data Kelas Berhasil Diubah!';
		}else{
			$_SESSION['error'] = 'Perubahan Data Kelas Gagal!';
		}	
		
		echo "<meta http-equiv='refresh' content='0; url=/kelas'>";	
	}else if($_GET['m'] == 'kelashapus'){
		$id = trim($_GET['id']);
		$kdb = select("SELECT * FROM tb_kelas WHERE kelas_id = '$id'");
		$kdt = fetch($kdb);
		
		$nip = $kdt['nip'];
		$update = update("UPDATE tb_guru SET guru_hashwali = '0' WHERE nip = '$nip'");
		
		$sql = hapus("DELETE FROM tb_kelas WHERE kelas_id = '$id'");
		if($sql == true){
			$_SESSION['success'] = 'Data Kelas Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Kelas Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/kelas'>";
	}
?>