<?php
	session_start();
	require_once "../config/database.php";
	$record = array();
	$id 	= $_GET['id'];
	$db		= mysqli_query($koneksi,"SELECT * FROM tb_presensi INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jadwal_guru ON tb_jadwal.jadwal_id = tb_jadwal_guru.jadwal_id INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id INNER JOIN tb_guru ON tb_jadwal_guru.nip = tb_guru.nip INNER JOIN tb_presensisiswa ON tb_presensi.presensi_id = tb_presensisiswa.presensi_id WHERE tb_presensi.jadwal_id = '$id' AND tb_presensisiswa.nisn = '$_SESSION[nisn]' GROUP BY tb_mapel.mapel_id") or die(mysqli_error($koneksi));
	$no     = 1;
	while($dt = mysqli_fetch_array($db)){
		$arr = explode(" ", $dt['kelas_nama']);
		$row = [
			'mapel_nama'				=> $dt['mapel_nama'],
			'kelas_nama' 				=> $arr[0].'-'.$dt['jurusan_nama'].'-'.$arr[1],
			'guru_nama' 				=> $dt['guru_nama'],
			'presensisiswa_jammasuk' 	=> $dt['presensisiswa_jammasuk'],
			'presensisiswa_jamkeluar'	=> $dt['presensisiswa_jamkeluar']
		];
		$record[] = $row;
		$no++;
	}
	$output = ["data" => $record];
	header('Content-Type: application/json');
	echo json_encode($output, JSON_PRETTY_PRINT);
	
?>