<?php
	require_once "../config/database.php";
	$record = array();
	$db		= mysqli_query($koneksi,"SELECT * FROM tb_siswa INNER JOIN tb_kelas ON tb_siswa.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id ORDER BY nisn ASC") or die(mysqli_error($koneksi));
	$no     = 1;
	while($dt = mysqli_fetch_array($db)){
		$arr = explode(" ", $dt['kelas_nama']);
		if(!empty($dt['siswa_image'])){ 
			$image = '<img src="cms/assets/images/siswa/'.$dt['siswa_image'].'" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" width="120">'; 
		}else{ 
			$image =  '<img src="cms/assets/images/no-image.png" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" width="120">';
		}
		$row = [
			'nisn' 					=> $dt['nisn'],
			'siswa_nama' 			=> $dt['siswa_nama'],
			'siswa_tempatlahir' 	=> $dt['siswa_tempatlahir'],
			'siswa_tanggallahir' 	=> $dt['siswa_tanggallahir'],
			'siswa_gender' 			=> $dt['siswa_gender'],
			'siswa_email' 			=> $dt['siswa_email'],
			'siswa_notelp' 			=> $dt['siswa_notelp'],
			'siswa_emailortu'		=> $dt['siswa_emailortu'],
			'siswa_notelportu'		=> $dt['siswa_notelportu'],
			'siswa_status'			=> $dt['siswa_status'],
			'siswa_image'			=> $image,
			'kelas_nama'			=> $arr[0]." ".$dt['jurusan_nama']." ".$arr[1],
			'action'				=> '<a href="#" id="myBtnEdit'.$dt['nisn'].'" onclick="click'.$dt['nisn'].'()" class="btnedit"><i class="fa fa-pen"></i></a> <a href="javascript:void(0)" title="Hapus" class="btnhapus" data-nama="'.$dt['siswa_nama'].'" data-url="/siswa/hapus/'.$dt['nisn'].'"><i class="fas fa-trash"></i></a>'
		];
		$record[] = $row;
		$no++;
	}
	$output = ["data" => $record];
	header('Content-Type: application/json');
	echo json_encode($output, JSON_PRETTY_PRINT);
	
?>