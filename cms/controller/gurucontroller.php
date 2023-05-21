<?php
	session_start();
	include "../config/function.php";
	include "../config/database.php";
	date_default_timezone_set('Asia/Jakarta');
	
	if($_GET['m'] == 'gurutambah'){		
		$nip				= mysqli_real_escape_string($koneksi,$_POST['nip']);
		$guru_nama			= mysqli_real_escape_string($koneksi,$_POST['guru_nama']);
		$guru_notelp		= mysqli_real_escape_string($koneksi,$_POST['guru_notelp']);
		$guru_email			= mysqli_real_escape_string($koneksi,$_POST['guru_email']);
		$guru_gender		= mysqli_real_escape_string($koneksi,$_POST['guru_gender']);
		$guru_alamat		= mysqli_real_escape_string($koneksi,$_POST['guru_alamat']);
		$guru_username		= mysqli_real_escape_string($koneksi,$_POST['guru_username']);
		$guru_status		= mysqli_real_escape_string($koneksi,$_POST['guru_status']);
		$guru_password		= md5(mysqli_real_escape_string($koneksi,$_POST['guru_password']));
		
		$gdb = select("SELECT * FROM tb_guru WHERE nip = '$nip'");
		$gdt = mysqli_num_rows($gdb);
		if($gdt == '0'){
			$sql = insert("INSERT INTO tb_guru (nip, guru_nama, guru_notelp, guru_email, guru_gender, guru_alamat, guru_username, guru_password, guru_status) VALUES ('$nip', '$guru_nama', '$guru_notelp', '$guru_email', '$guru_gender', '$guru_alamat', '$guru_username', '$guru_password', '$guru_status')");
		
			if($sql == true){
				$_SESSION['success'] = 'Data Guru Berhasil Ditambahkan';
			}else{
				$_SESSION['error'] = 'Tambah Data Guru Gagal!';
			}
		}else{
			$_SESSION['error'] = 'Tambah Data Guru Gagal!, Nip sudah digunakan!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/guru'>";
	}else if($_GET['m'] == 'guruedit'){
		$nip				= mysqli_real_escape_string($koneksi,$_POST['nip']);
		$niplama			= mysqli_real_escape_string($koneksi,$_POST['niplama']);
		$guru_nama			= mysqli_real_escape_string($koneksi,$_POST['guru_nama']);
		$guru_notelp		= mysqli_real_escape_string($koneksi,$_POST['guru_notelp']);
		$guru_email			= mysqli_real_escape_string($koneksi,$_POST['guru_email']);
		$guru_gender		= mysqli_real_escape_string($koneksi,$_POST['guru_gender']);
		$guru_alamat		= mysqli_real_escape_string($koneksi,$_POST['guru_alamat']);
		$guru_username		= mysqli_real_escape_string($koneksi,$_POST['guru_username']);
		$guru_status		= mysqli_real_escape_string($koneksi,$_POST['guru_status']);
		
		$gdb = select("SELECT * FROM tb_guru WHERE nip = '$nip'");
		$gdt = mysqli_num_rows($gdb);
		if($gdt == '0'){
			$sql = update("UPDATE tb_guru SET
			nip					= '$nip',
			guru_nama			= '$guru_nama',
			guru_notelp			= '$guru_notelp',
			guru_email			= '$guru_email',
			guru_gender			= '$guru_gender',
			guru_alamat			= '$guru_alamat',
			guru_username		= '$guru_username',
			guru_status			= '$guru_status'
			WHERE nip			= '$niplama'");
			
			if($sql == true){
				$_SESSION['success'] = 'Data Guru Berhasil Diubah!';
			}else{
				$_SESSION['error'] = 'Perubahan Data Guru Gagal!';
			}	
		}else{
			$_SESSION['error'] = 'Ubah Data Guru Gagal!, Nip sudah digunakan!';
		}
		
		echo "<meta http-equiv='refresh' content='0; url=/guru'>";	
	}else if($_GET['m'] == 'guruhapus'){
		$id = trim($_GET['id']);
		
		$sql = hapus("DELETE FROM tb_guru WHERE nip = '$id'");
		if($sql == true){
			$_SESSION['success'] = 'Data Guru Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Guru Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/guru'>";
	}
?>