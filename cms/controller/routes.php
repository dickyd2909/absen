<?php
	switch($_GET['m'])
	{
		case 'dashboard': views("main/dashboard"); break; 
		
		//admin
		case 'admin': views("admin/admin_index"); break; 
		case 'adminprofile': views("admin/adminprofile"); break; 
		case 'admineditprofile': views("admin/adminprofileedit"); break; 
		//mapel
		case 'mapel': views("mapel/mapel_index"); break; 
		//kelas
		case 'kelas': views("kelas/kelas_index"); break; 
		//Guru
		case 'guru': views("guru/guru_index"); break; 
		//Jurusan
		case 'jurusan': views("jurusan/jurusan_index"); break; 
		//Ruang
		case 'ruang': views("ruang/ruang_index"); break; 
		//Jadwal
		case 'jadwal': views("jadwal/jadwal_index"); break;
		case 'jadwalguru': views("jadwal/jadwal_guru"); break;
		//Siswa
		case 'siswa': views("siswa/siswa_index"); break; 
		//Coba
		case 'coba': views("coba/coba_index"); break; 
		//Presensi
		case 'presensi': views("presensi/presensi_index"); break; 
		//Presensi Siswa
		case 'presensisiswa': views("presensisiswa/presensisiswa_index"); break; 
		//Presensi Siswa
		case 'jadwalpresensi': views("jadwal/jadwalpresensi_index"); break; 
		case 'jadwalpresensisiswa': views("jadwal/jadwalpresensisiswa_index"); break; 
	}
?>
