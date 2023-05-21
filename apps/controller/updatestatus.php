<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../../config/database.php";
	
	$presensisiswa_status 	= $_POST['name'];
	$jadwal_id 				= $_POST['jadwal'];
	$presensisiswa_id		= $_GET['id'];
	$time				 	= date('H:i:s');
	
	$sql  = mysqli_query($koneksi, "UPDATE tb_presensisiswa SET presensisiswa_status = '$presensisiswa_status' WHERE presensisiswa_id = '$presensisiswa_id'")or die(mysqli_error($koneksi));
	
	if($sql == true){
		echo "<script>
			Swal.fire({
			  title: 'Sukses!',
			  text: 'Data kehadiran berhasil diubah!',
			  icon: 'success',
			  confirmButtonText: 'Ok'
			});
		</script>";
	}
	
	
?>