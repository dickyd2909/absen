<title>Input Guru | Presesnsi SMKN 2 CIMAHI</title>
<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Input Guru
            </div>
        </div>
		<div id="table">
			<div class="tableform">
				<?php
					$id = $_GET['id'];
				?>
				<form method="post" action="jadwalguru/tambah" enctype="multipart/form-data">
					<div id="formbox" class="clearfix">
						<div class="formlabel">Guru</div>
						<div class="forminput">
							<select name="nip" class="theSelect form-control">
								<option value="">- Pilih - </option>
								<?php
									$mdb = select("SELECT * FROM tb_guru WHERE guru_status = 'Aktif'");
									while($mdt = fetch($mdb)){
								?>
										<option value="<?= $mdt['nip']; ?>"><?= $mdt['guru_nama']; ?></option>
								<?php } ?>	
							</select>
							<input name="jadwal_id" type="hidden" value="<?= $id; ?>" class="form-control" required />
						</div>
					</div>
					<div class="formsubmit">
						<input name="submit" type="submit" value="Simpan" class="btnsubmit"></input>
					</div>
				</form>
			</div>	
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>NO</th>
						<th>MATA PELAJARAN</th>
						<th>NIP</th>
						<th>GURU</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$db = select("SELECT * FROM tb_jadwal_guru INNER JOIN tb_jadwal ON tb_jadwal_guru.jadwal_id = tb_jadwal.jadwal_id INNER JOIN tb_guru ON tb_jadwal_guru.nip = tb_guru.nip INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id WHERE tb_jadwal.jadwal_id = '$id'");
						while($dt = fetch($db)){
					?>
						<tr>
							<td width="1%" align="center"><?= $no; ?></td>
							<td><?= $dt['mapel_nama']; ?></td>
							<td><?= $dt['nip']; ?></td>
							<td><?= $dt['guru_nama']; ?></td>
							<td><a href="javascript:void(0)" title="Hapus" class="btnhapus" data-nama="<?= $dt['guru_nama']; ?>" data-url="/jadwalguru/hapus-<?= $dt['jadwal_guru_id']; ?>"><i class="fas fa-trash"></i></a></td>
						</tr>
					<?php $no++;} ?>	
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript" src="cms/assets/js/select.js"></script>
<link rel="stylesheet" href="cms/assets/css/select.css">
<script>
	$(".theSelect").select2();
</script>
<script type="text/javascript">
	$(document).ready( function () {
		$('#example').DataTable();
	} );
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
<script type="text/javascript" lang="javascript">
    $('.btnhapus').click(function(e) {
        let nama = $(this).data('nama'), url = $(this).data('url')
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Apakah anda yakin ingin menghapus ${nama}?`,
            icon: 'question',
            showCancelButton: true,
        }).then(result => {
            if (result.value) {
                window.location = url
            }
        })
    })
</script>
