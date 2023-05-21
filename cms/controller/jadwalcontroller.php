<?php
	session_start();
	include "../config/function.php";
	include "../config/database.php";
	date_default_timezone_set('Asia/Jakarta');
	if($_GET['m'] == 'jadwaltambah'){	
		$jadwal_id				= mysqli_real_escape_string($koneksi, $_POST['jadwal_id']);
		$mapel_id				= mysqli_real_escape_string($koneksi, $_POST['mapel_id']);
		$ruang_id				= mysqli_real_escape_string($koneksi, $_POST['ruang_id']);
		$kelas_id				= mysqli_real_escape_string($koneksi, $_POST['kelas_id']);
		$jadwal_hari			= mysqli_real_escape_string($koneksi, $_POST['jadwal_hari']);
		$jadwal_jammasuk		= mysqli_real_escape_string($koneksi, $_POST['jadwal_jammasuk']);
		$jadwal_jamkeluar		= mysqli_real_escape_string($koneksi, $_POST['jadwal_jamkeluar']);
		$jadwal_status			= mysqli_real_escape_string($koneksi,$_POST['jadwal_status']);
		$jadwal_realisasi		= mysqli_real_escape_string($koneksi, $_POST['jadwal_realisasi']);
		$guru_id1				= $_POST['guru_id'];
		$guru_id2				= $_POST['guru_id2'];
		
		$jdb = select("SELECT * FROM tb_kelas INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE tb_kelas.kelas_id = '$kelas_id'");
		$jdt = fetch($jdb);
		
		if($jdt['jurusan_id'] == '15'){
			$kode_jurusan = "RPL";
		}else if($jdt['jurusan_id'] == '16'){
			$kode_jurusan = "MMD";
		}else if($jdt['jurusan_id'] == '17'){
			$kode_jurusan = "MKT";
		}else if($jdt['jurusan_id'] == '18'){
			$kode_jurusan = "TPM";
		}else if($jdt['jurusan_id'] == '19'){
			$kode_jurusan = "TKI";
		}else if($jdt['jurusan_id'] == '20'){
			$kode_jurusan = "ANM";
		}
		
		$arr = explode(" ", $jdt['kelas_nama']);
		if($arr[0] == '10'){
			$angkatan = '1';
		}else if($arr[0] == '11'){
			$angkatan = '2';
		}else if($arr[0] == '12'){
			$angkatan = '3';
		}else if($arr[0] == '13'){
			$angkatan = '4';
		}
		
		$ndb 					= select("SELECT MAX(tb_jadwal.lognoreg) AS NoTerakhir FROM tb_jadwal INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id WHERE tb_kelas.jurusan_id = '$jdt[jurusan_id]'");
		$ndt 					= fetch($ndb);
		$lastno 				= $ndt['NoTerakhir'];
		$nourut 				= (int) $lastno;
		$nourut++;
		$lognoreg				= sprintf("%02s", $nourut);
		$jadwal_id				= $kode_jurusan."".$angkatan."".$lognoreg;
		
		$sql = insert("INSERT INTO tb_jadwal (jadwal_id, mapel_id, ruang_id, kelas_id, jadwal_hari, jadwal_jammasuk, jadwal_jamkeluar, lognoreg, jadwal_status, jadwal_realisasi) VALUES ('$jadwal_id', '$mapel_id', '$ruang_id', '$kelas_id', '$jadwal_hari', '$jadwal_jammasuk', '$jadwal_jamkeluar', '$lognoreg', '$jadwal_status', '$jadwal_realisasi')");
		
		if($sql == true){
			$_SESSION['success'] = 'Data Jadwal Berhasil Ditambahkan';
		}else{
			$_SESSION['error'] = 'Tambah Data Jadwal Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/jadwal'>";
		
	}else if($_GET['m'] == 'jadwaledit'){
		$jadwal_idlama			= mysqli_real_escape_string($koneksi, $_POST['jadwal_id']);
		$mapel_id				= mysqli_real_escape_string($koneksi, $_POST['mapel_id']);
		$ruang_id				= mysqli_real_escape_string($koneksi, $_POST['ruang_id']);
		$kelas_id				= mysqli_real_escape_string($koneksi, $_POST['kelas_id']);
		$jadwal_hari			= mysqli_real_escape_string($koneksi, $_POST['jadwal_hari']);
		$jadwal_jammasuk		= mysqli_real_escape_string($koneksi, $_POST['jadwal_jammasuk']);
		$jadwal_jamkeluar		= mysqli_real_escape_string($koneksi, $_POST['jadwal_jamkeluar']);
		$jadwal_status			= mysqli_real_escape_string($koneksi,$_POST['jadwal_status']);
		$jadwal_realisasi		= mysqli_real_escape_string($koneksi, $_POST['jadwal_realisasi']);
		
		$guru_id				= $_POST['guru_id'];
		
		$jdb = select("SELECT * FROM tb_kelas INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE tb_kelas.kelas_id = '$kelas_id'");
		$jdt = fetch($jdb);
		
		if($jdt['jurusan_id'] == '15'){
			$kode_jurusan = "RPL";
		}else if($jdt['jurusan_id'] == '16'){
			$kode_jurusan = "MMD";
		}else if($jdt['jurusan_id'] == '17'){
			$kode_jurusan = "MKT";
		}else if($jdt['jurusan_id'] == '18'){
			$kode_jurusan = "TPM";
		}else if($jdt['jurusan_id'] == '19'){
			$kode_jurusan = "TKI";
		}else if($jdt['jurusan_id'] == '20'){
			$kode_jurusan = "ANM";
		}
		
		$arr = explode(" ", $jdt['kelas_nama']);
		if($arr[0] == '10'){
			$angkatan = '1';
		}else if($arr[0] == '11'){
			$angkatan = '2';
		}else if($arr[0] == '12'){
			$angkatan = '3';
		}else if($arr[0] == '13'){
			$angkatan = '4';
		}
		
		$ndb 					= select("SELECT MAX(tb_jadwal.lognoreg) AS NoTerakhir FROM tb_jadwal INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id WHERE tb_kelas.jurusan_id = '$jdt[jurusan_id]'");
		$ndt 					= fetch($ndb);
		$lastno 				= $ndt['NoTerakhir'];
		$nourut 				= (int) $lastno;
		$nourut++;
		$lognoreg				= sprintf("%02s", $nourut);
		$jadwal_id				= $kode_jurusan."".$angkatan."".$lognoreg;
		
		$sql = update("UPDATE tb_jadwal SET
		mapel_id			= '$mapel_id',
		ruang_id			= '$ruang_id',
		kelas_id			= '$kelas_id',
		jadwal_hari			= '$jadwal_hari',
		jadwal_jammasuk		= '$jadwal_jammasuk',
		jadwal_jamkeluar	= '$jadwal_jamkeluar',
		jadwal_status		= '$jadwal_status',
		jadwal_realisasi	= '$jadwal_realisasi'
		WHERE jadwal_id		= '$jadwal_idlama'");
		
		if($sql == true){
			$_SESSION['success'] = 'Data Jadwal Berhasil Diubah!';
		}else{
			$_SESSION['error'] = 'Perubahan Data Jadwal Gagal!';
		}		
		echo "<meta http-equiv='refresh' content='0; url=/jadwal'>";	
	}else if($_GET['m'] == 'jadwalhapus'){
		$id = trim($_GET['id']);
		$pdb	= select("SELECT * FROM tb_presensi WHERE jadwal_id = '$id'"); 
		$pdt	= $pdb->fetch_array();
		$sql 	= hapus("DELETE FROM tb_jadwal WHERE jadwal_id = '$id'");
		$sql2 	= hapus("DELETE FROM tb_jadwal_guru WHERE jadwal_id = '$id'");
		$sql3 	= hapus("DELETE FROM tb_presensi WHERE jadwal_id = '$id'");
		$sql4 	= hapus("DELETE FROM tb_presensisiswa WHERE presensi_id = '$pdt[presensi_id]'");
		
		if($sql == true && $sql2){
			$_SESSION['success'] = 'Data Jadwal Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Jadwal Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/jadwal'>";
	}else if($_GET['m'] == 'jadwalgurutambah'){	
		$jadwal_id				= mysqli_real_escape_string($koneksi, $_POST['jadwal_id']);
		$nip					= mysqli_real_escape_string($koneksi, $_POST['nip']);
		$jdb 					= select("SELECT * FROM tb_jadwal_guru WHERE jadwal_id = '$jadwal_id' AND nip = '$nip'");
		$row					= mysqli_num_rows($jdb);
		
		if($row > 0){
			$_SESSION['error'] = 'Guru yang di inputkan sudah ada!';
			echo "<meta http-equiv='refresh' content='0; url=/jadwalguru-$jadwal_id'>";
		}else{
			$sql = insert("INSERT INTO tb_jadwal_guru (jadwal_id,nip) VALUES ('$jadwal_id','$nip')");
		
			if($sql == true){
				$_SESSION['success'] = 'Data Guru Berhasil Diinput!';
			}else{
				$_SESSION['error'] = 'Input Data Guru Gagal!';
			}
			echo "<meta http-equiv='refresh' content='0; url=/jadwalguru-$jadwal_id'>";
		}	
	}else if($_GET['m'] == 'jadwalguruhapus'){	
		$id  = $_GET['id'];
		$jdb = select("SELECT * FROM tb_jadwal_guru WHERE jadwal_guru_id = '$id'");
		$jdt = fetch($jdb);
		
		$sql = hapus("DELETE FROM tb_jadwal_guru WHERE jadwal_guru_id = '$id'");
		if($sql == true){
			$_SESSION['success'] = 'Data Guru Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Guru Gagal!';
		}
		echo "<meta http-equiv='refresh' content='0; url=/jadwalguru-$jdt[jadwal_id]'>";
		
	}
?>