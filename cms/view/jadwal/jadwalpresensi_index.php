<title>Presensi | Presesnsi SMKN 2 CIMAHI</title>

<?php
	$id	= $_GET['id'];
	$jdb = select("SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id WHERE jadwal_id = '$id'");
	$jdt = fetch($jdb);
?>
<div id="bgtable">
	<div id="botable">
		<div id="tabletop" class="clearfix">
			<div class="tabletoptit">
				<h2>Presensi <?= $jdt['mapel_nama']; ?></h2>
			</div>
		</div>
		<div id="table">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>NO</th>
						<th>HARI</th>
						<th>TANGGAL</th>
						<th>BAP</th>
						<th>SISWA</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$db = select("SELECT * FROM tb_presensi INNER JOIN tb_jadwal on tb_presensi.jadwal_id = tb_jadwal.jadwal_id WHERE tb_jadwal.jadwal_id = '$id'");
						while($dt = fetch($db)){
					?>
						<tr>
							<td width="1%"><?= $no; ?></td>
							<td><?= $dt['jadwal_hari']; ?></td>
							<td><?= $dt['presensi_tanggal']; ?></td>
							<td><?= $dt['presensi_bap']; ?></td>
							<td><a href="/jadwalpresensisiswa-<?= $dt['presensi_id']; ?>" id="myBtnEdit<?= $dt['jadwal_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a></td>
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
