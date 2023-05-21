<?php

	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../libs/phpqrcode/qrlib.php";
	include "../../config/database.php";
	
	$id				= $_GET['id'];
	$presensi_id	= $_GET['presensi_id'];
	
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
	
	$db 					= mysqli_query($koneksi, "SELECT * FROM tb_presensi WHERE presensi_id='$presensi_id'");
	$row					= mysqli_num_rows($db);
	if( $row > 0 ) {
		$dt = mysqli_fetch_array($db);
		@unlink('../../assets/files/'.$dt['presensi_qrcode']);
	}
	
	$sql = mysqli_query($koneksi, "UPDATE tb_presensi SET
	presensi_token 		= '$presensi_token',
	presensi_qrcode 	= '$presensi_qrcode'
	WHERE presensi_id 	= '$presensi_id'") or die (mysqli_error($koneksi));
?>

<div class="qrcodeimg">
	<img src="assets/files/<?= $presensi_qrcode ?>" alt="presensi smkn2 cimahi" title="presensi smkn2 cimahi">
</div>