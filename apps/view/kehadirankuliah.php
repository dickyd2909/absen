<title>Kehadiran Kuliah</title>
<div id="bgbodyrightcontent">
	<div class="bodyrightcontenttit">
		Kehadiran Kuliah
	</div>
	<div class="tablecont">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
				<tr align="left">
					<th>MATA PELAJARAN</th>
					<th>KELAS</th>
					<th>GURU</th>
					<th>JAM MASUK</th>
					<th>JAM KELUAR</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$id = $_GET['id'];
					$db = select("SELECT * FROM tb_presensi INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jadwal_guru ON tb_jadwal.jadwal_id = tb_jadwal_guru.jadwal_id INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id INNER JOIN tb_guru ON tb_jadwal_guru.nip = tb_guru.nip INNER JOIN tb_presensisiswa ON tb_presensi.presensi_id = tb_presensisiswa.presensi_id WHERE tb_presensi.jadwal_id = '$id' AND tb_presensisiswa.nisn = '$_SESSION[nisn]' GROUP BY tb_mapel.mapel_id");
					while($dt = fetch($db)){
					$arr = explode(" ", $dt['kelas_nama']);
				?>
					<tr>
						<td><?= $dt['mapel_nama']; ?></td>
						<td><?= $arr[0] ?> - <?= $dt['jurusan_nama']; ?> - <?= $arr[1]; ?> </td>
						<td><?= $dt['guru_nama'];?></td>
						<td><?= date_format(date_create($dt['presensisiswa_jammasuk']), 'H:i:s');?></td>
						<td><?= date_format(date_create($dt['presensisiswa_jamkeluar']), 'H:i:s');?></td>
					</tr>	
				<?php } ?>	
			</tbody>
		</table>
	</div>
</div>
<script>
		$(document).ready( function () {
			$('#example').DataTable();
		} );
</script>