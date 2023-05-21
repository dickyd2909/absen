<title>Presensi QR-Code</title>
<div id="bgbodyrightcontent">
	<div class="qrcontenttit">
		<h3>QR-Code</h3>
		<span><a href="/jadwal-pelajaran">Jadwal Pelajaran</a> > QR-Code </span>
	</div>
	<div class="qrcodecontent">
		<?php 
			date_default_timezone_set("Asia/Jakarta");
			$date				= date('Y-m-d');
			$dateindo			= hariindo($date);
			$id 				= $_GET['id'];
			$db 				= select("SELECT * FROM tb_presensi INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_ruang ON tb_jadwal.ruang_id = tb_ruang.ruang_id INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jadwal_guru ON tb_jadwal.jadwal_id = tb_jadwal_guru.jadwal_id INNER JOIN tb_guru ON tb_jadwal_guru.nip = tb_guru.nip INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE tb_presensi.jadwal_id = '$id' AND presensi_status = 'Aktif' AND tb_jadwal.jadwal_hari = '$dateindo'");
			$dt 				= fetch($db);
			$row				= rows($db);
			
			$presensi_id		= $dt['presensi_id'];
			$jadwal_id			= $id;
			$presensi_tanggal	= $dt['presensi_tanggal'];
			$presensi_qrcode	= $dt['presensi_qrcode'];
			$presensi_token		= $dt['presensi_token'];
			$arr 				= explode(" ", $dt['kelas_nama']);
			$mapel_nama			= $dt['mapel_nama'];
			$kelas_nama			= $arr[0]." ".$dt['jurusan_nama']." ".$arr[1];
			$ruang_nama			= $dt['ruang_id'];
			$guru_nama			= $dt['guru_nama'];
			$jadwal_hari		= $dt['jadwal_hari'];
			
			if($row <= 0){
				$_SESSION['error'] = 'Anda belum melakukan generate Qr-Code Atau Token sudah hangus!';
				echo "<meta http-equiv='refresh' content='0; url=/jadwal-pelajaran'>";
			}
		?>
		
		<div class="bgqrcode">
			<div class="qrcode" id="qrcode">
				<div class="qrcodeimg">
					<img src="assets/files/<?= $presensi_qrcode ?>" alt="presensi smkn2 cimahi" title="presensi smkn2 cimahi">
				</div>
			</div>
			<div id="qrcodeform" class="clearfix">
				<form method="post">
					<div class="formleft">
						<div id="formbox" class="clearfix">
							<div class="forminput">
								<input type="text" name="mapel_nama" class="form-control" value="<?= $mapel_nama; ?>" readonly />
							</div>
						</div>
						<div id="formbox" class="clearfix">
							<div class="forminput">
								<input type="text" name="kelas_nama" class="form-control" value="<?= $kelas_nama; ?>" readonly />
							</div>
						</div>
						<div id="formbox" class="clearfix">
							<div class="forminput">
								<input type="text" name="presensi_tanggal" class="form-control"  value="<?= $presensi_tanggal; ?>" readonly />
							</div>
						</div>
					</div>
					<div class="formright">
						<div id="formbox" class="clearfix">
							<div class="forminput">
								<input type="text" name="guru_nama" class="form-control" value="<?= $guru_nama; ?>" readonly />
							</div>
						</div>
						<div id="formbox" class="clearfix">
							<div class="forminput">
								<input type="text" name="ruang_nama" class="form-control" value="<?= $ruang_nama; ?>" readonly />
							</div>
						</div>
						<div id="formbox" class="clearfix">
							<div class="forminput">
								<input type="text" name="jadwal_hari" class="form-control" value="<?= $jadwal_hari; ?>" readonly />
							</div>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var auto_refresh = setInterval(
	function () {
	   $('#qrcode').load('/qrcodetoken/<?= $id ?>/<?= $presensi_id ?>').fadeIn("slow");
	}, 30000); // refresh setiap 10000 milliseconds
</script>
<?php if(isset($_SESSION['success'])){ ?>
	<script>
		Swal.fire({
		  title: 'Sukses!',
		  text: '<?= $_SESSION['success']; ?>',
		  icon: 'success',
		  confirmButtonText: 'Ok'
		});
	</script>
<?php unset($_SESSION['success']);} ?>

<?php if(isset($_SESSION['error'])){ ?>
	<script>
		Swal.fire({
		  title: 'Gagal!',
		  text: '<?= $_SESSION['error']; ?>',
		  icon: 'error',
		  confirmButtonText: 'Ok'
		});
	</script>
<?php unset($_SESSION['error']);} ?>