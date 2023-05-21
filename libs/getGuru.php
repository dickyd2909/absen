<?php
	require_once "../config/database.php";
	$record = array();
	$db		= mysqli_query($koneksi,"SELECT * FROM tb_guru ORDER BY nip ASC") or die(mysqli_error($koneksi));
	$no     = 1;
	while($dt = mysqli_fetch_array($db)){
		$row = [
			'nip' 					=> $dt['nip'],
			'guru_nama' 			=> $dt['guru_nama'],
			'guru_notelp' 			=> $dt['guru_notelp'],
			'guru_email' 			=> $dt['guru_email'],
			'guru_gender' 			=> $dt['guru_gender'],
			'guru_alamat' 			=> $dt['guru_alamat'],
			'guru_username' 		=> $dt['guru_username'],
			'guru_password'			=> $dt['guru_password'],
			'guru_status'			=> $dt['guru_status'],
			'no'					=> $no,
			'action'				=> '<a href="#" id="myBtnEdit'.$dt['nip'].'" onclick="click'.$dt['nip'].'()" class="btnedit"><i class="fa fa-pen"></i></a> <a href="javascript:void(0)" title="Hapus" class="btnhapus" data-nama="'.$dt['guru_nama'].'" data-url="/guru/hapus/'.$dt['nip'].'"><i class="fas fa-trash"></i></a>'
		];
		$record[] = $row;
		$no++;
	}
	$output = ["data" => $record];
	header('Content-Type: application/json');
	echo json_encode($output, JSON_PRETTY_PRINT);
	
?>