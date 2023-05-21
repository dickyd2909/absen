<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../config/database.php";
	$token		= $_POST['qrcode'];
	$db			= mysqli_query($koneksi,"SELECT * FROM tb_presensi INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id WHERE presensi_token = '$token'");
	$dt			= mysqli_fetch_array($db);
	$row		= mysqli_num_rows($db);
	if($row > 0){
		$pdb 	= mysqli_query($koneksi,"SELECT * FROM tb_presensisiswa WHERE presensi_id = '$dt[presensi_id]' AND nisn = '$_SESSION[nisn]'");
		$pdt	= mysqli_fetch_array($pdb);
		$time	= date("H:i:s");
		$prow	= mysqli_num_rows($pdb);
		if($prow > 0){
			if($pdt['presensisiswa_jammasuk'] == '00:00:00'){
				$sql = mysqli_query($koneksi, "UPDATE tb_presensisiswa SET
				presensisiswa_jammasuk 		= '$time',
				presensisiswa_status 		= 'hadir'
				WHERE presensi_id = '$dt[presensi_id]' AND nisn = '$_SESSION[nisn]'") or die (mysqli_error($koneksi));
				if($sql == true){
					$_SESSION['success'] = 'Presensi Berhasil!';
				}else{
					$_SESSION['error'] = 'Presensi Gagal!';
				}
				echo "<meta http-equiv='refresh' content='0; url=/beranda'>";
			}else{
				$date 			= date_create($dt['jadwal_jamkeluar']);
				date_add($date, date_interval_create_from_date_string('-30 minutes'));
				if($time >= date_format($date,'H:i:s')){
					date_format($date, 'Y-m-d H:i:s');
					$sql	= mysqli_query($koneksi,"UPDATE tb_presensisiswa SET
					presensisiswa_jamkeluar 	= '$time',
					presensisiswa_status		= 'Hadir'
					WHERE presensi_id = '$dt[presensi_id]' AND nisn = '$_SESSION[nisn]'");
					if($sql == true){
						$_SESSION['success'] = 'Presensi Berhasil!';
					}else{
						$_SESSION['error'] = 'Presensi Gagal !';
					}
					echo "<meta http-equiv='refresh' content='0; url=/beranda'>";
				}else{
					$_SESSION['error'] = 'Presensi Gagal, Anda sudah melakukan presensi hari ini!';
					echo "<meta http-equiv='refresh' content='0; url=/beranda'>";
				}				
			}
		}else{
			$_SESSION['error'] = 'Anda tidak terdaftar disini!';
			echo "<meta http-equiv='refresh' content='0; url=/beranda'>";
		}			
	}else{
		$_SESSION['error'] = 'Token Presensi expired!';
		echo "<meta http-equiv='refresh' content='0; url=/beranda'>";
	}
?>