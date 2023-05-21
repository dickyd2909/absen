<title>Absensi Kehadiran</title>
<div id="bgbodyrightcontent">
	<div class="bodyrightcontenttit">
		Absensi Kehadiran
	</div>
	<div class="tablecont">
		<div class="tabledesktop">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>MATA PELAJARAN</th>
						<th>KELAS</th>
						<th>REALISASI</th>
						<th>TEREALISASI</th>
						<th>HADIR</th>
						<th>TIDAK HADIR</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if(isset($_SESSION['nip'])){
							$db		= select("SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_ruang ON tb_jadwal.ruang_id = tb_ruang.ruang_id INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jadwal_guru ON tb_jadwal.jadwal_id = tb_jadwal_guru.jadwal_id INNER JOIN tb_guru ON tb_jadwal_guru.nip = tb_guru.nip INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE tb_jadwal.jadwal_status = 'Aktif' AND tb_guru.nip = '$_SESSION[nip]'");
						}else{
							$db		= select("SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_ruang ON tb_jadwal.ruang_id = tb_ruang.ruang_id INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jadwal_guru ON tb_jadwal.jadwal_id = tb_jadwal_guru.jadwal_id INNER JOIN tb_guru ON tb_jadwal_guru.nip = tb_guru.nip INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id INNER JOIN tb_presensi ON tb_jadwal.jadwal_id = tb_presensi.jadwal_id INNER JOIN tb_presensisiswa ON tb_presensi.presensi_id = tb_presensisiswa.presensi_id WHERE tb_jadwal.jadwal_status = 'Aktif' AND tb_presensisiswa.nisn = '$_SESSION[nisn]' GROUP BY tb_jadwal.jadwal_id");
						}
						
						while($dt = fetch($db)){
						$arr = explode(" ", $dt['kelas_nama']);
						$jdb = select("SELECT COUNT(*) as jumlah FROM tb_presensi WHERE jadwal_id = '$dt[jadwal_id]'");
						$jdt = fetch($jdb);
						$hdb = select("SELECT COUNT(*) as hadir FROM tb_presensi INNER JOIN tb_presensisiswa ON tb_presensi.presensi_id = tb_presensisiswa.presensi_id WHERE jadwal_id = '$dt[jadwal_id]' AND tb_presensisiswa.nisn = '".$_SESSION['nisn']."' AND tb_presensisiswa.presensisiswa_status = 'Hadir'");
						$hdt = fetch($hdb);
						$tdb = select("SELECT COUNT(*) as hadir FROM tb_presensi INNER JOIN tb_presensisiswa ON tb_presensi.presensi_id = tb_presensisiswa.presensi_id WHERE jadwal_id = '$dt[jadwal_id]' AND tb_presensisiswa.nisn = '".$_SESSION['nisn']."' AND tb_presensisiswa.presensisiswa_status = 'Tidak Hadir'");
						$tdt = fetch($tdb);		
					?>
						<tr>
							<td><?= $dt['mapel_nama']; ?></td>
							<td><?= $arr[0];?> - <?= $dt['jurusan_nama']; ?> - <?= $arr[1]; ?></td>
							<td width="1%" align="center"><?= $dt['jadwal_realisasi']; ?></td>
							<td width="1%" align="center"><?= $jdt['jumlah']; ?></td>
							<td width="1%" align="center"><?= $hdt['hadir']; ?></td>
							<td width="5%" align="center"><?= $tdt['hadir']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="tablemobile">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example2">
				<thead>
					<tr align="left">
						<th width="1%"></th>
						<th>MATA PELAJARAN</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
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
<script type="text/javascript">
	$(document).ready( function () {
		$('#example').DataTable();
	} );


function format ( d ) {
		return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" width="10%">'+
			'<tr>'+
				'<td width="2%">Kelas:</td>'+
				'<td>'+d.kelas_nama+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td width="2%">Realisasi:</td>'+
				'<td>'+d.realisasi+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td width="2%">Terealisasi:</td>'+
				'<td>'+d.terealisasi+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td width="2%">Hadir:</td>'+
				'<td>'+d.jumlahhadir+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td width="2%">Tidak Hadir:</td>'+
				'<td>'+d.jumlahtidak+'</td>'+
			'</tr>'+
		'</table>';
	}
 
	$(document).ready(function () {
    var table = $('#example2').DataTable({
        ajax: '/absenjson',
       "columns": [
				{
					"className":      'dt-control',
					"orderable":      false,
					"data":           null,
					"defaultContent": ''
				},
				{ "data": "mapel_nama" }
			],
        order: [[1, 'asc']],
    });
 
    // Add event listener for opening and closing details
    $('#example2 tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
 
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
	
});
</script>