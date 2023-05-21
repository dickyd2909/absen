<title>Presensi Siswa | Presesnsi SMKN 2 CIMAHI</title>

<?php
	$id	= $_GET['id'];
	$jdb = select("SELECT * FROM tb_presensisiswa INNER JOIN tb_presensi ON tb_presensisiswa.presensi_id = tb_presensi.presensi_id INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id  WHERE tb_presensi.presensi_id = '$id'");
	$jdt = fetch($jdb);
?>
<div id="bgtable">
	<div id="botable">
		<div id="tabletop" class="clearfix">
			<div class="tabletoptit">
				<h2>Presensi Siswa <?= $jdt['mapel_nama']; ?></h2>
			</div>
		</div>
		<div id="table">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>NO</th>
						<th>NISN</th>
						<th>SISWA</th>
						<th>JAM MASUK</th>
						<th>JAM KELUAR</th>
						<th>KEHADIRAN</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$db = select("SELECT * FROM tb_presensisiswa INNER JOIN tb_presensi ON tb_presensisiswa.presensi_id = tb_presensi.presensi_id INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_siswa ON tb_presensisiswa.nisn = tb_siswa.nisn WHERE tb_presensi.presensi_id = '$id'");
						while($dt = fetch($db)){
					?>
						<tr>
							<td width="1%"><?= $no; ?></td>
							<td><?= $dt['nisn']; ?></td>
							<td><?= $dt['siswa_nama']; ?></td>
							<td><?= $dt['presensisiswa_jammasuk']; ?></td>
							<td><?= $dt['presensisiswa_jamkeluar']; ?></td>
							<td><?= $dt['presensisiswa_status']; ?></td>
						</tr>
					<?php $no++;} ?>	
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready( function () {
		$('#example').DataTable();
	} );
</script>
