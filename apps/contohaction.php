asdasd
<?php
	$token		= mysqli_real_escape_string($koneksi,$_POST['qrcode']);
	$db			= mysqli_query($koneksi,"SELECT * FROM tb_presensi WHERE presensi_token = '$token'");
	$dt			= mysqli_fetch_array($db);
	$row		= mysqli_num_rows($db);
	echo $token;
	
	if($row > 0){
		$pdb 	= mysqli_query($koneksi,"SELECT * FROM tb_presensisiswa WHERE presensi_id = '$dt[presensi_id]' AND nisn = '$_SESSION[nisn]'");
		$pdt	= mysqli_fetch_array($pdb);
		$time	= date("H:i:s");
		if($pdt['presensisiswa_jammasuk'] == '00:00:00'){
			$sql	= mysqli_query($koneksi,"UPDATE tb_presensisiswa SET
			'presensisiswa_jammasuk' 	= '$time',
			'presensisiswa_status'		= 'Hadir'
			WHERE presensi_id = '$dt[presensi_id]' AND nisn = '$_SESSION[nisn]'");
			if($sql == true){
				$_SESSION['success'] = 'Presensi Berhasil!';
			}else{
				$_SESSION['error'] = 'Presensi Gagal!';
			}
			echo "<meta http-equiv='refresh' content='0; url=/beranda'>";
		}else{
			$sql	= mysqli_query($koneksi,"UPDATE tb_presensisiswa SET
			'presensisiswa_jamkeluar' 	= '$time',
			'presensisiswa_status'		= 'Hadir'
			WHERE presensi_id = '$dt[presensi_id]' AND nisn = '$_SESSION[nisn]'");
			if($sql == true){
				$_SESSION['success'] = 'Presensi Berhasil!';
			}else{
				$_SESSION['error'] = 'Presensi Gagal!';
			}
			echo "<meta http-equiv='refresh' content='0; url=/beranda'>";
		}
	}else{
		$_SESSION['error'] = 'Token Presensi expired!';
		echo "<meta http-equiv='refresh' content='0; url=/beranda'>";
	}
?>