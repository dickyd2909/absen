<?php
	session_start();
	include "../config/function.php";
	include "../config/database.php";

	date_default_timezone_set('Asia/Jakarta');
	if($_GET['m'] == 'admintambah'){		
		$admin_nama			= $_POST['admin_nama'];
		$admin_username		= $_POST['admin_username'];
		$admin_password		= md5($_POST['admin_password']);
		$admin_status		= $_POST['admin_status'];
		$adminlevel_id		= $_POST['adminlevel_id'];
		
		$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
		$code		   		= md5(uniqid(rand()));
		$gencode			= substr($code, 0, 5);
		$replace			= strtolower(str_replace($stringreplace,'_',$admin_nama));
		$nama_file 			= $_FILES["admin_image"]["name"];
		$tipe_file 			= $_FILES["admin_image"]["type"];
		$alamat 			= $_FILES["admin_image"]["tmp_name"];
		$nama_baru 			= "admin_".$replace."_".$gencode.".".end((explode(".", $nama_file)));
		$tujuan 			= "../assets/images/admin/$nama_baru";
		
		if(empty($nama_file))
		{
			
			$sql = insert("INSERT INTO tb_admin (admin_id, admin_nama, admin_username, admin_password, admin_status, adminlevel_id) VALUES (NULL, '$admin_nama', '$admin_username', '$admin_password', '$admin_status', '$adminlevel_id')");
		
			if($sql == true){
				$_SESSION['success'] = 'Data Admin Berhasil Ditambahkan';
			}else{
				$_SESSION['error'] = 'Tambah Data Admin Gagal!';
			}	
			echo "<meta http-equiv='refresh' content='0; url=/admin'>";
		}elseif (!empty($nama_file)){
			if ($tipe_file != "image/gif" AND $tipe_file != "image/jpg" AND $tipe_file != "image/jpeg" AND $tipe_file != "image/png") {
				$_SESSION['error'] = 'Format Image tidak didukung!';
				echo "<meta http-equiv='refresh' content='0; url=/admin'>";
			}else{
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				$sql = insert("INSERT INTO tb_admin (admin_id, admin_nama, admin_username, admin_password, admin_image, admin_status, adminlevel_id) VALUES (NULL, '$admin_nama', '$admin_username', '$admin_password', '$nama_baru','$admin_status', '$adminlevel_id')");
		
				if($sql == true){
					$_SESSION['success'] = 'Data Admin Berhasil Ditambahkan';
				}else{
					$_SESSION['error'] = 'Tambah Data Admin Gagal!';
				}	
				echo "<meta http-equiv='refresh' content='0; url=/admin'>";
			}
		}			
	}else if($_GET['m'] == 'adminedit'){
		$admin_id			= $_POST['admin_id'];
		$admin_nama			= $_POST['admin_nama'];
		$admin_username		= $_POST['admin_username'];
		$admin_status		= $_POST['admin_status'];
		$adminlevel_id		= $_POST['adminlevel_id'];
		$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
		$code		   		= md5(uniqid(rand()));
		$gencode			= substr($code, 0, 5);
		$replace			= strtolower(str_replace($stringreplace,'_',$admin_nama));
		$nama_file 			= $_FILES["admin_image"]["name"];
		$tipe_file 			= $_FILES["admin_image"]["type"];
		$alamat 			= $_FILES["admin_image"]["tmp_name"];
		$nama_baru 			= "admin_".$replace."_".$gencode.".".end((explode(".", $nama_file)));
		$tujuan 			= "../assets/images/admin/$nama_baru";
		
		if(empty($nama_file)){
			$sql = update("UPDATE tb_admin SET
			admin_nama			= '$admin_nama',
			admin_username		= '$admin_username',
			admin_status		= '$admin_status',
			adminlevel_id		= '$adminlevel_id'
			WHERE admin_id		= '$admin_id'");
			
			if($sql == true){
				$_SESSION['success'] = 'Data Admin Berhasil Diubah!';
			}else{
				$_SESSION['error'] = 'Perubahan Data Admin Gagal!';
			}	
			
			echo "<meta http-equiv='refresh' content='0; url=/admin'>";	
		}else{
			if ($tipe_file != "image/gif" AND $tipe_file != "image/jpg" AND $tipe_file != "image/jpeg" AND $tipe_file != "image/png") {
				$_SESSION['error'] = 'Format Image tidak didukung!';
				echo "<meta http-equiv='refresh' content='0; url=/admin'>";
			}else{
				$db = select("SELECT * FROM tb_admin WHERE admin_id='$admin_id'");
				if (mysqli_num_rows($db) > 0 ) {
					$dt = mysqli_fetch_array($db);
					@unlink('../assets/images/admin/'.$dt['admin_image']);
				}
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				$sql = update("UPDATE tb_admin SET
				admin_nama			= '$admin_nama',
				admin_username		= '$admin_username',
				admin_image		= '$nama_baru',
				admin_status		= '$admin_status',
				adminlevel_id		= '$adminlevel_id'
				WHERE admin_id		= '$admin_id'");
				if($sql == true){
				$_SESSION['success'] = 'Data Admin Berhasil Diubah!';
				}else{
					$_SESSION['error'] = 'Perubahan Data Admin Gagal!';
				}	
				
				echo "<meta http-equiv='refresh' content='0; url=/admin'>";	
			}
		}			
	}else if($_GET['m'] == 'adminhapus'){
		$id = trim($_GET['id']);
		$db = select("SELECT * FROM tb_admin WHERE admin_id='$id'");
		if (mysqli_num_rows($db) > 0 ) {
			$dt = mysqli_fetch_array($db);
			@unlink('../assets/images/admin/'.$dt['admin_image']);
		}
		$sql = hapus("DELETE FROM tb_admin WHERE admin_id = '$id'");
		if($sql == true){
			$_SESSION['success'] = 'Data Admin Berhasil Dihapus!';
		}else{
			$_SESSION['error'] = 'Hapus Data Admin Gagal!';
		}	
		echo "<meta http-equiv='refresh' content='0; url=/admin'>";
	}else if($_GET['m'] == 'updateprofile'){
		$admin_id			= $_POST['admin_id'];
		$admin_nama			= $_POST['admin_nama'];
		$admin_username		= $_POST['admin_username'];
		$admin_status		= $_POST['admin_status'];
		$admin_password		= md5($_POST['admin_password']);
		$adminlevel_id		= $_POST['adminlevel_id'];
		$stringreplace 		= array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+',' ','_');
		$code		   		= md5(uniqid(rand()));
		$gencode			= substr($code, 0, 5);
		$replace			= strtolower(str_replace($stringreplace,'_',$admin_nama));
		$nama_file 			= $_FILES["admin_image"]["name"];
		$tipe_file 			= $_FILES["admin_image"]["type"];
		$alamat 			= $_FILES["admin_image"]["tmp_name"];
		$nama_baru 			= "admin_".$replace."_".$gencode.".".end((explode(".", $nama_file)));
		$tujuan 			= "../assets/images/admin/$nama_baru";
		
		if(empty($nama_file)){
			if(empty($_POST['admin_password'])){
				$sql = update("UPDATE tb_admin SET
				admin_nama			= '$admin_nama',
				admin_username		= '$admin_username',
				admin_status		= '$admin_status',
				adminlevel_id		= '$adminlevel_id'
				WHERE admin_id		= '$admin_id'");
			}else{
				$sql = update("UPDATE tb_admin SET
				admin_nama			= '$admin_nama',
				admin_username		= '$admin_username',
				admin_status		= '$admin_status',
				admin_password		= '$admin_password',
				adminlevel_id		= '$adminlevel_id'
				WHERE admin_id		= '$admin_id'");
			}				
			
			if($sql == true){
				$_SESSION['success'] = 'Data Admin Berhasil Diubah!';
			}else{
				$_SESSION['error'] = 'Perubahan Data Admin Gagal!';
			}	
			
			echo "<meta http-equiv='refresh' content='0; url=/admin-profile'>";	
		}else{
			if ($tipe_file != "image/gif" AND $tipe_file != "image/jpg" AND $tipe_file != "image/jpeg" AND $tipe_file != "image/png") {
				$_SESSION['error'] = 'Format Image tidak didukung!';
				echo "<meta http-equiv='refresh' content='0; url=/admin-profile'>";
			}else{
				$db = select("SELECT * FROM tb_admin WHERE admin_id='$admin_id'");
				if (mysqli_num_rows($db) > 0 ) {
					$dt = mysqli_fetch_array($db);
					@unlink('../assets/images/admin/'.$dt['admin_image']);
				}
				$gambar_baru = move_uploaded_file($alamat, $tujuan);
				if(empty($_POST['admin_password'])){
					$sql = update("UPDATE tb_admin SET
					admin_nama			= '$admin_nama',
					admin_username		= '$admin_username',
					admin_image			= '$nama_baru',
					admin_status		= '$admin_status',
					adminlevel_id		= '$adminlevel_id'
					WHERE admin_id		= '$admin_id'");
				}else{
					$sql = update("UPDATE tb_admin SET
					admin_nama			= '$admin_nama',
					admin_username		= '$admin_username',
					admin_image			= '$nama_baru',
					admin_status		= '$admin_status',
					admin_password		= '$admin_password',
					adminlevel_id		= '$adminlevel_id'
					WHERE admin_id		= '$admin_id'");
				}					
				if($sql == true){
				$_SESSION['success'] = 'Data Admin Berhasil Diubah!';
				}else{
					$_SESSION['error'] = 'Perubahan Data Admin Gagal!';
				}	
				
				echo "<meta http-equiv='refresh' content='0; url=/admin-profile'>";	
			}
		}			
	}
?>