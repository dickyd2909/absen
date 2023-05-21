<?php
	session_start();
	require_once "../config/database.php";
	$record = array();
	if(isset($_SESSION['nip'])){
		$db		= mysqli_query($koneksi,"SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_ruang ON tb_jadwal.ruang_id = tb_ruang.ruang_id INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jadwal_guru ON tb_jadwal.jadwal_id = tb_jadwal_guru.jadwal_id INNER JOIN tb_guru ON tb_jadwal_guru.nip = tb_guru.nip INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE tb_jadwal.jadwal_status = 'Aktif' AND tb_guru.nip = '$_SESSION[nip]'");
	}else{
		$db		= mysqli_query($koneksi,"SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_ruang ON tb_jadwal.ruang_id = tb_ruang.ruang_id INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jadwal_guru ON tb_jadwal.jadwal_id = tb_jadwal_guru.jadwal_id INNER JOIN tb_guru ON tb_jadwal_guru.nip = tb_guru.nip INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id INNER JOIN tb_presensi ON tb_jadwal.jadwal_id = tb_presensi.jadwal_id INNER JOIN tb_presensisiswa ON tb_presensi.presensi_id = tb_presensisiswa.presensi_id WHERE tb_jadwal.jadwal_status = 'Aktif' AND tb_presensisiswa.nisn = '$_SESSION[nisn]' GROUP BY tb_jadwal.jadwal_id");
	}
	while($dt = mysqli_fetch_array($db)){
		$jdb = mysqli_query($koneksi,"SELECT COUNT(*) as jumlah FROM tb_presensi WHERE jadwal_id = '$dt[jadwal_id]'");
		$jdt = mysqli_fetch_array($jdb);
		$hdb = mysqli_query($koneksi,"SELECT COUNT(*) as hadir FROM tb_presensi INNER JOIN tb_presensisiswa ON tb_presensi.presensi_id = tb_presensisiswa.presensi_id WHERE jadwal_id = '$dt[jadwal_id]' AND tb_presensisiswa.nisn = '".$_SESSION['nisn']."' AND tb_presensisiswa.presensisiswa_status = 'Hadir'");
		$hdt = mysqli_fetch_array($hdb);
		$tdb = mysqli_query($koneksi,"SELECT COUNT(*) as hadir FROM tb_presensi INNER JOIN tb_presensisiswa ON tb_presensi.presensi_id = tb_presensisiswa.presensi_id WHERE jadwal_id = '$dt[jadwal_id]' AND tb_presensisiswa.nisn = '".$_SESSION['nisn']."' AND tb_presensisiswa.presensisiswa_status = 'Tidak Hadir'");
		$tdt = mysqli_fetch_array($tdb);		
		$arr = explode(" ", $dt['kelas_nama']);
		$row = [
			'mapel_nama'				=> $dt['mapel_nama'],
			'kelas_nama' 				=> $arr[0].'-'.$dt['jurusan_nama'].'-'.$arr[1],
			'realisasi' 				=> $dt['jadwal_realisasi'],
			'terealisasi' 				=> $jdt['jumlah'],
			'jumlahhadir'				=> $hdt['hadir'],
			'jumlahtidak'				=> $tdt['hadir']
		];
		$record[] = $row;
		$no++;
	}
	$output = ["data" => $record];
	header('Content-Type: application/json');
	echo json_encode($output, JSON_PRETTY_PRINT);
	
?>