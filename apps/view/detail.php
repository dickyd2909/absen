<div class="alertbox">
	<div class="alert">
	  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
	  <strong>Welcome!</strong> Selamat Datang di Presensi SMKN 2 CIMAHI.
	</div>
</div>
<?php
	date_default_timezone_set("Asia/Jakarta");
	$id 			= $_GET['id'];
	$datenow		= date('Y-m-d');
	$db 			= select("SELECT * FROM tb_presensi INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id WHERE tb_jadwal.jadwal_id = '$id' AND presensi_status = 'Aktif' AND presensi_tanggal = '$datenow'");
	$dt 			= fetch($db);
	$row			= rows($db);
	$presensi_id	= $dt['presensi_id'];
	if($row <= 0){
		$_SESSION['error'] = 'Detail Absen sudah ditutup silahkan lakukan generate qr terbaru!';
		echo "<meta http-equiv='refresh' content='0; url=/jadwal-pelajaran'>";
	}
?>
<title>Detail & BAP <?= $dt['mapel_nama']; ?></title>
<div id="bgbodyrightcontent">
	<div class="bodyrightcontenttit">
		BAP <?= $dt['mapel_nama']; ?> <?= $dt['presensi_tanggal'];?>
	</div>
	<div class="qrcodecontent">
		<form action="/konfirmasibap" method="post">
			<div id="formbox" class="clearfix">
				<div class="formbo">
					<h4>Isian BAP</h4>
					<?php if(empty($dt['presensi_bap'])){ ?>
						<textarea name="presensi_bap"></textarea>
					<?php }else{ ?>	
						<textarea name="presensi_bap" readonly ><?= $dt['presensi_bap']; ?></textarea>
					<?php } ?>	
					<input type="hidden" name="presensi_id" value="<?= $presensi_id ?>" />
					<input type="hidden" name="jadwal_id" value="<?= $id ?>" />
				</div>
			</div>
			<?php if(empty($dt['presensi_bap'])){ ?>
				<div class="formbobtn">
					<button type="submit" name="submit" class="btnbap">Submit BAP </button>
				</div>
			<?php } ?>	
		</form>
	</div>
</div>

<?php
	$tdb = select("SELECT * FROM tb_presensisiswa WHERE presensi_id='$dt[presensi_id]'");
	$hdb = select("SELECT * FROM tb_presensisiswa WHERE presensi_id='$dt[presensi_id]' AND presensisiswa_status = 'Hadir'");
	$adb = select("SELECT * FROM tb_presensisiswa WHERE presensi_id='$dt[presensi_id]' AND presensisiswa_status = 'Tidak Hadir'");
	$total = mysqli_num_rows($tdb);
	$hadir = mysqli_num_rows($hdb);
	$tidak = mysqli_num_rows($adb);
?>

<div id="bgcard" class="clearfix">
	<div class="card">
		<div class="cardicon1"><i class="fas fa-users"></i></div>
		<div class="cardjumlah"><?= $total;?></div>
		<div class="cardtit">Total Siswa</div>
	</div>
	
	<div class="card">
		<div class="cardicon2"><i class="fas fa-user-plus"></i></div>
		<div class="cardjumlah"><?= $hadir; ?></div>
		<div class="cardtit">Jumlah Siswa Hadir</div>
	</div>
	
	<div class="card">
		<div class="cardicon3"><i class="fas fa-user-minus"></i></div>
		<div class="cardjumlah"><?= $tidak; ?></div>
		<div class="cardtit">Jumlah Siswa Tidak Hadir</div>
	</div>
</div>

<div id="bgbodyrightcontent">
	<div class="bodyrightcontenttit">
		Kehadiran <?= $dt['mapel_nama']; ?>
	</div>
	<div class="tablecont">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
				<tr align="left">
					<th>NISN</th>
					<th>NAMA</th>
					<th>KEHADIRAN</th>
					<th>WAKTU ABSEN MASUK</th>
					<th>WAKTU ABSEN KELUAR</th>
					<?php if(empty($dt['presensi_bap'])){ ?>
						<th></th>
					<?php } ?>	
				</tr>
			</thead>
			<tbody>
				<?php
					$kdb = select("SELECT * FROM tb_presensisiswa INNER JOIN tb_siswa ON tb_presensisiswa.nisn = tb_siswa.nisn WHERE presensi_id='$dt[presensi_id]'");
					while($kdt = fetch($kdb)){
				?>
					<tr>
						<td><?= $kdt['nisn']; ?></td>
						<td><?= $kdt['siswa_nama']; ?></td>
						<?php if($kdt['presensisiswa_status'] == 'Hadir'){ ?>
							<td><span class="hadir"><?= $kdt['presensisiswa_status']; ?></span></td>
						<?php }else{ ?>	
							<td><span class="tidakhadir"><?= $kdt['presensisiswa_status']; ?></span></td>
						<?php } ?>
						<td><?= $kdt['presensisiswa_jammasuk']; ?></td>
						<td><?= $kdt['presensisiswa_jamkeluar']; ?></td>
						<?php if(empty($dt['presensi_bap'])){ ?>
							<td width="1%">
								<form action="" method="post">
									<div class="form-switch">
										<label class="switch">
											<?php if($kdt['presensisiswa_status'] == 'Hadir'){ ?>
												<input type="checkbox" name="presensisiswa_status" id="update<?= $kdt['presensisiswa_id']; ?>" value="Tidak Hadir" checked />
											<?php }else{ ?>
												<input type="checkbox" name="presensisiswa_status" id="update<?= $kdt['presensisiswa_id']; ?>" value="Hadir"/>
											<?php } ?>
											<span class="slider"></span>
										</label>	
										<input type="hidden" name="jadwal_id" id="jadwal_id<?= $kdt['presensisiswa_id']; ?>" value="<?= $_GET['id']; ?>"/>									
									</div>	
								</form>
							</td>
						<?php } ?>	
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready( function () {
		$('#example').DataTable();
	} );
</script>

<?php
	$kdb = select("SELECT * FROM tb_presensisiswa INNER JOIN tb_siswa ON tb_presensisiswa.nisn = tb_siswa.nisn WHERE presensi_id='$dt[presensi_id]'");
	while($kdt = fetch($kdb)){
?>
<script>
	$(document).ready(function(){
		$("#update<?= $kdt['presensisiswa_id'];?>").click(function(){
			var name=$("#update<?= $kdt['presensisiswa_id'];?>").val();
			var jadwal=$("#jadwal_id<?= $kdt['presensisiswa_id'];?>").val();
			$.ajax({
				url:'/updatestatus/<?= $kdt['presensisiswa_id']; ?>',
				method:'POST',
				data:{
					name:name,
					jadwal:jadwal
				},
				success:function(response){
					window.location.reload();
					response;
				}
			});
		});
	});
</script>
<?php } ?>