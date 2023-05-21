<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../config/database.php";
	
	$presensi_bap	= mysqli_real_escape_string($koneksi, $_POST['presensi_bap']);
	$presensi_id	= mysqli_real_escape_string($koneksi, $_POST['presensi_id']);
	$jadwal_id		= mysqli_real_escape_string($koneksi, $_POST['jadwal_id']);
	
	
	$db 					= mysqli_query($koneksi, "SELECT * FROM tb_presensi WHERE presensi_id='$presensi_id'");
	$row					= mysqli_num_rows($db);
	if( $row > 0 ) {
		$dt = mysqli_fetch_array($db);
		@unlink('../../assets/files/'.$dt['presensi_qrcode']);
	}
	$sql		= mysqli_query($koneksi, "UPDATE tb_presensi SET
	presensi_bap 	= '$presensi_bap',
	presensi_status = 'Non-Aktif',
	presensi_token	= ''
	WHERE presensi_id = '$presensi_id'")or die(mysqli_error($koneksi));
	
	$db 			= mysqli_query($koneksi, "SELECT * FROM tb_presensisiswa INNER JOIN tb_siswa ON tb_presensisiswa.nisn = tb_siswa.nisn WHERE presensi_id='$presensi_id'")or die(mysqli_error($koneksi));
	
	$sql2 = null;
	while($dt = mysqli_fetch_array($db)){
		$sql2 = mysqli_query($koneksi,"UPDATE tb_presensisiswa SET presensisiswa_status ='Tidak Hadir' WHERE presensisiswa_id ='$dt[presensisiswa_id]' AND presensisiswa_jamkeluar = '00:00:00' ")or die(mysqli_error($konesi));
	}
	
	if($sql == true && $sql2 == true){
		$_SESSION['success'] = 'BAP berhasil di submit!';
	}else{
		$_SESSION['error'] = 'BAP gagal di submit!';
	}
	
	echo "<meta http-equiv='refresh' content='0; url=/jadwal-pelajaran'>";
?>	