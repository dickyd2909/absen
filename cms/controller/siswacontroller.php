<?php
	session_start();
	include "../config/function.php";
	include "../config/database.php";
	date_default_timezone_set('Asia/Jakarta');
	echo "<title>Loading..</title>";
	if($_GET['m'] == 'siswatambah'){	
		$nisn					= mysqli_real_escape_string($koneksi, $_POST['nisn']);
		$siswa_nama				= mysqli_real_escape_string($koneksi, $_POST['siswa_nama']);
		$siswa_tempatlahir		= mysqli_real_escape_string($koneksi, $_POST['siswa_tempatlahir']);
		$siswa_tanggallahir		= mysqli_real_escape_string($koneksi, $_POST['siswa_tanggallahir']);
		$siswa_gender			= mysqli_real_escape_string($koneksi, $_POST['siswa_gender']);
		$siswa_email			= mysqli_real_escape_string($koneksi, $_POST['siswa_email']);
		$siswa_notelp			= mysqli_real_escape_string($koneksi, $_POST['siswa_notelp']);
		$siswa_emailortu		= mysqli_real_escape_string($koneksi, $_POST['siswa_emailortu']);
		$siswa_notelportu		= mysqli_real_escape_string($koneksi, $_POST['siswa_notelportu']);
		$siswa_status			= mysqli_real_escape_string($koneksi, $_POST['siswa_status']);
		$siswa_password			= md5(mysqli_real_escape_string($koneksi, $_POST['siswa_password']));
		$kelas_id				= mysqli_real_escape_string($koneksi, $_POST['kelas_id']);
		
		$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
		$code		   		= md5(uniqid(rand()));
		$gencode			= substr($code, 0, 5);
		$replace			= strtolower(str_replace($stringreplace,'_',$siswa_nama));
		$nama_file 			= $_FILES["siswa_image"]["name"];
		$tipe_file 			= $_FILES["siswa_image"]["type"];
		$alamat 			= $_FILES["siswa_image"]["tmp_name"];
		$nama_baru 			= "siswa_".$replace."_".$gencode.".".end((explode(".", $nama_file)));
		$tujuan 			= "../assets/images/siswa/$nama_baru";
		
		if(empty($nama_file))
		{
			$sql = insert("INSERT INTO tb_siswa (nisn, kelas_id, siswa_nama, siswa_tempatlahir, siswa_tanggallahir, siswa_gender, siswa_email, siswa_password, siswa_notelp,  siswa_emailortu, siswa_notelportu, siswa_status) VALUES ('$nisn', '$kelas_id', '$siswa_nama', '$siswa_tempatlahir', '$siswa_tanggallahir', '$siswa_gender', '$siswa_email', '$siswa_password', '$siswa_notelp',  '$siswa_emailortu', '$siswa_notelportu', '$siswa_status')");
		
			if($sql == true){
				$_SESSION['success'] = 'Data Siswa Berhasil Ditambahkan';
			}else{
				$_SESSION['error'] = 'Tambah Data Siswa Gagal!';
			}	
			echo "<meta http-equiv='refresh' content='0; url=/siswa'>";
		}elseif (!empty($nama_file))
		{
			if ($tipe_file != "image/gif" AND $tipe_file != "image/jpg" AND $tipe_file != "image/jpeg" AND $tipe_file != "image/png") {
				$_SESSION['error'] = 'Format Image tidak didukung!';
				echo "<meta http-equiv='refresh' content='0; url=/siswa'>";
			}else{
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				$sql = insert("INSERT INTO tb_siswa (nisn, kelas_id, siswa_nama, siswa_tempatlahir, siswa_tanggallahir, siswa_gender, siswa_email, siswa_notelp,  siswa_emailortu, siswa_notelportu, siswa_status, siswa_image) VALUES ('$nisn', '$kelas_id', '$siswa_nama', '$siswa_tempatlahir', '$siswa_tanggallahir', '$siswa_gender', '$siswa_email', '$siswa_notelp',  '$siswa_emailortu', '$siswa_notelportu', '$siswa_status', '$nama_baru')");
				if($sql == true){
					$_SESSION['success'] = 'Data Siswa Berhasil Ditambahkan';
				}else{
					$_SESSION['error'] = 'Tambah Data Siswa Gagal!';
				}
				echo "<meta http-equiv='refresh' content='0; url=/siswa'>";
			}
		}
	}else if($_GET['m'] == 'siswaedit'){
		$nisn					= mysqli_real_escape_string($koneksi, $_POST['nisn']);
		$nisnlama				= mysqli_real_escape_string($koneksi, $_POST['nisnlama']);
		$siswa_nama				= mysqli_real_escape_string($koneksi, $_POST['siswa_nama']);
		$siswa_tempatlahir		= mysqli_real_escape_string($koneksi, $_POST['siswa_tempatlahir']);
		$siswa_tanggallahir		= mysqli_real_escape_string($koneksi, $_POST['siswa_tanggallahir']);
		$siswa_gender			= mysqli_real_escape_string($koneksi, $_POST['siswa_gender']);
		$siswa_email			= mysqli_real_escape_string($koneksi, $_POST['siswa_email']);
		$siswa_notelp			= mysqli_real_escape_string($koneksi, $_POST['siswa_notelp']);
		$siswa_emailortu		= mysqli_real_escape_string($koneksi, $_POST['siswa_emailortu']);
		$siswa_notelportu		= mysqli_real_escape_string($koneksi, $_POST['siswa_notelportu']);
		$siswa_status			= mysqli_real_escape_string($koneksi, $_POST['siswa_status']);
		$kelas_id				= mysqli_real_escape_string($koneksi, $_POST['kelas_id']);
		$siswa_password			= md5(mysqli_real_escape_string($koneksi, $_POST['siswa_password']));
		
		$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
		$code		   		= md5(uniqid(rand()));
		$gencode			= substr($code, 0, 5);
		$replace			= strtolower(str_replace($stringreplace,'_',$siswa_nama));
		$nama_file 			= $_FILES["siswa_image"]["name"];
		$tipe_file 			= $_FILES["siswa_image"]["type"];
		$alamat 			= $_FILES["siswa_image"]["tmp_name"];
		$nama_baru 			= "siswa_".$replace."_".$gencode.".".end((explode(".", $nama_file)));
		$tujuan 			= "../assets/images/siswa/$nama_baru";
		if(empty($nama_file)){
			$sql = update("UPDATE tb_siswa SET
			nisn				= '$nisn',
			kelas_id			= '$kelas_id',
			siswa_nama			= '$siswa_nama',
			siswa_tempatlahir	= '$siswa_tempatlahir',
			siswa_tanggallahir	= '$siswa_tanggallahir',
			siswa_gender		= '$siswa_gender',
			siswa_email			= '$siswa_email',
			siswa_notelp		= '$siswa_notelp',
			siswa_emailortu		= '$siswa_emailortu',
			siswa_notelportu	= '$siswa_notelportu',
			siswa_status		= '$siswa_status'
			WHERE nisn			= '$nisnlama'");
			
			if($sql == true){
				$_SESSION['success'] = 'Data Siswa Berhasil Diubah!';
			}else{
				$_SESSION['error'] = 'Perubahan Siswa Kelas Gagal!';
			}	
			echo "<meta http-equiv='refresh' content='0; url=/siswa'>";	
		}elseif (!empty($nama_file))
		{
			if ($tipe_file != "image/gif" AND $tipe_file != "image/jpg" AND $tipe_file != "image/jpeg" AND $tipe_file != "image/png") {
				$_SESSION['error'] = 'Format Image tidak didukung!';
				echo "<meta http-equiv='refresh' content='0; url=/siswa'>";
			}else{
				$db = select("SELECT * FROM tb_siswa WHERE nisn='$nisnlama'");
				if (mysqli_num_rows($db) > 0 ) {
					$dt = mysqli_fetch_array($db);
					@unlink('../assets/images/siswa/'.$dt['siswa_image']);
				}
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				$sql = update("UPDATE tb_siswa SET
				nisn				= '$nisn',
				kelas_id			= '$kelas_id',
				siswa_nama			= '$siswa_nama',
				siswa_tempatlahir	= '$siswa_tempatlahir',
				siswa_tanggallahir	= '$siswa_tanggallahir',
				siswa_gender		= '$siswa_gender',
				siswa_email			= '$siswa_email',
				siswa_notelp		= '$siswa_notelp',
				siswa_emailortu		= '$siswa_emailortu',
				siswa_notelportu	= '$siswa_notelportu',
				siswa_status		= '$siswa_status',
				siswa_image			= '$nama_baru'
				WHERE nisn			= '$nisnlama'");
				
				if($sql == true){
					$_SESSION['success'] = 'Data Siswa Berhasil Diubah!';
				}else{
					$_SESSION['error'] = 'Perubahan Siswa Kelas Gagal!';
				}	
				echo "<meta http-equiv='refresh' content='0; url=/siswa'>";	
			}
		}
		
		
		
		
	}else if($_GET['m'] == 'siswahapus'){
		$id = trim($_GET['id']);
		
		$db = select("SELECT * FROM tb_siswa WHERE nisn='$id'");
		if (mysqli_num_rows($db) > 0 ) {
			$dt = mysqli_fetch_array($db);
			@unlink('../assets/images/siswa/'.$dt['siswa_image']);
		}
		$sql = hapus("DELETE FROM tb_siswa WHERE nisn = '$id'");
		if($sql == true){
			$_SESSION['success'] = 'Data Siswa Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Siswa Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/siswa'>";
	}
?>