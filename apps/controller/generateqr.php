<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../libs/phpqrcode/qrlib.php";
	include "../../config/database.php";
	
	$id			= $_GET['id'];
	$dateindo	= hariindo(date('Y-m-d'));
	$date		= date("Y-m-d");
	$db			= mysqli_query($koneksi,"SELECT * FROM tb_presensi INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id WHERE tb_presensi.jadwal_id = '$id' AND presensi_tanggal = '$date' ") or die (mysqli_error($koneksi));
	$row		= mysqli_num_rows($db);
	$dt			= mysqli_fetch_array($db);
	$time		= date('H:i:s');
	$jdb		= mysqli_query($koneksi, "SELECT * FROM tb_jadwal WHERE jadwal_id = '$id'");
	$jdt		= $jdb->fetch_array();
	$date2 		= date_create($jdt['jadwal_jammasuk']);
	date_add($date2, date_interval_create_from_date_string('-30 minutes'));
	$date3 		= date_create($jdt['jadwal_jamkeluar']);
	date_add($date3, date_interval_create_from_date_string('-30 minutes'));
	
	
	if($row > 0){
		if($dt['jadwal_hari'] != $dateindo){
			$_SESSION['error'] = 'Qr-Code tidak bisa di generate, jadwal tidak sesuai dengan hari ini!';
			echo "<meta http-equiv='refresh' content='0; url=/jadwal-pelajaran'>";
		}elseif($time > $dt['jadwal_jamkeluar']  ){
			$_SESSION['error'] = 'Qr-Code tidak bisa di generate, waktu jadwal sudah habis!';
			echo "<meta http-equiv='refresh' content='0; url=/jadwal-pelajaran'>";
		}elseif($dt['presensi_tanggal'] == $date){
			$_SESSION['error'] = 'Qr-Code tidak bisa di generate, Qr-code Sudah ada!';
			echo "<meta http-equiv='refresh' content='0; url=/jadwal-pelajaran'>";
		}else{
			$_SESSION['error'] = 'Generate Qr-code Gagal!';
			echo "<meta http-equiv='refresh' content='0; url=/jadwal-pelajaran'>";
		}	
	}else{
		if($jdt['jadwal_hari'] != $dateindo){
			$_SESSION['error'] = 'Qr-Code tidak bisa di generate, jadwal tidak sesuai dengan hari ini!';
			echo "<meta http-equiv='refresh' content='0; url=/jadwal-pelajaran'>";
		}else if($time <= date_format($date2,'H:i:s') && $time >= date_format($date3,'H:i:s')){
			$_SESSION['error'] = 'Qr-Code tidak bisa di generate, waktu untuk jadwal tidak sesuai!';
			echo "<meta http-equiv='refresh' content='0; url=/jadwal-pelajaran'>";
		}else{
			$jadwal_id			= $id;
			$presensi_tanggal	= $date;
			$tempdir 			= "../../assets/files/";
			if (!file_exists($tempdir))
			mkdir($tempdir);
			$code		   			= md5(uniqid(rand()));
			$uniqcode				= substr(uniqid(rand()),0,5);
			$qrcode					= $code;
			$qrcode_file			= date("Ymd").$uniqcode.".png";
			$quality       			= "H";
			$ukuran            		= 5;
			$padding        		= 1;
			$presensi_token			= $code;
			$presensi_qrcode		= $qrcode_file;
			
			QRCode::png($qrcode, $tempdir.$qrcode_file, $quality, $ukuran, $padding);
			
			$sql = mysqli_query($koneksi,"INSERT INTO tb_presensi (presensi_id, jadwal_id, presensi_tanggal, presensi_qrcode, presensi_token, presensi_bap, presensi_status) VALUES (NULL, '$jadwal_id', '$presensi_tanggal', '$presensi_qrcode', '$presensi_token', '$presensi_bap', 'Aktif') ")or die(mysqli_error($koneksi));
			
			$presensi_id		= $koneksi->insert_id;
			
			$pdb				= mysqli_query($koneksi,"SELECT * FROM tb_presensi INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id WHERE presensi_id = '$presensi_id'")or die(mysqli_error($koneksi));
			$pdt				= mysqli_fetch_array($pdb);
			$kelas_id			= $pdt['kelas_id'];
			
			
			$sdb	 = mysqli_query($koneksi,"SELECT * FROM tb_siswa WHERE kelas_id = '$kelas_id'") or die(mysqli_error($koneksi));
			$prow	 = mysqli_num_rows($sdb);
			
			while($sdt = mysqli_fetch_array($sdb)){
				$nisn					= $sdt['nisn'];
				$presensisiswa_status	= 'Tidak Hadir';
				$sql2 					= mysqli_query($koneksi, "INSERT INTO tb_presensisiswa (presensisiswa_id, presensi_id, nisn, presensisiswa_jammasuk, presensisiswa_jamkeluar, presensisiswa_status) VALUES (NULL, '$presensi_id', '$nisn', '$presensisiswa_jammasuk', '$presensisiswa_jamkeluar', '$presensisiswa_status')") or die (mysqli_error($koneksi));
			}


			if($sql == true){
				$_SESSION['success'] = 'Generate Qrcode Berhasil!';
			}else{
				$_SESSION['error'] = 'Generate Qrcode Gagal!';
			}
		echo "<meta http-equiv='refresh' content='0; url=/presensi-$id'>";
		}
		
	}
	
	
	function hariindo($d){
		$hari = date_format(date_create($d), 'D');
	 
		switch($hari){
			case 'Sun':
				$hari_ini = "Minggu";
			break;
	 
			case 'Mon':			
				$hari_ini = "Senin";
			break;
	 
			case 'Tue':
				$hari_ini = "Selasa";
			break;
	 
			case 'Wed':
				$hari_ini = "Rabu";
			break;
	 
			case 'Thu':
				$hari_ini = "Kamis";
			break;
	 
			case 'Fri':
				$hari_ini = "Jumat";
			break;
	 
			case 'Sat':
				$hari_ini = "Sabtu";
			break;
			
			default:
				$hari_ini = "Tidak di ketahui";		
			break;
		}
	 
		return $hari_ini;
	 
	}
?>