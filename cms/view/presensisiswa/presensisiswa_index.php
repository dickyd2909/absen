<title>Presensi Siswa | Presensi SMKN 2 CIMAHI</title>
<div id="bgtable">
	<div id="botable">
		<div id="tablebox" class="clearfix">
			<div class="tabletit">
				<h2>Presensi Siswa</h2>
			</div>
			<div class="tableadd">
				<a href="#" class="btnsecondary" id="myBtn">+ PRESENSI SISWA</a>
			</div>
		</div>	
		<div class="tablecont">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>NO</th>
						<th>NISN</th>
						<th>NAMA SISWA</th>
						<th>JAM MASUK</th>
						<th>JAM KELUAR</th>
						<th>STATUS</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$id = $_GET['id'];
						$db = select("SELECT * FROM tb_presensisiswa INNER JOIN tb_presensi ON tb_presensisiswa.presensi_id = tb_presensi.presensi_id INNER JOIN tb_siswa ON tb_presensisiswa.nisn = tb_siswa.nisn WHERE tb_presensisiswa.presensi_id ='$id' ");
						while($dt = fetch($db)){
					?>
						<tr>
							<td width="1%"><?= $no; ?></td>
							<td><?= $dt['nisn']; ?></td>
							<td><?= $dt['siswa_nama']; ?></td>
							<td><?= $dt['presensisiswa_jammasuk']; ?></td>
							<td><?= $dt['presensisiswa_jamkeluar']; ?></td>
							<td><?= $dt['presensisiswa_status']; ?></td>
							<td><a href="#" id="myBtnEdit<?= $dt['presensisiswa_id']; ?>" class="btnaction"><i class="fa fa-pen"></i></a>
							<a href="javascript:void(0)" title="Hapus" class="btnhapus" data-nama="<?= $dt['presensi_nama']; ?>" data-url="/presensi/hapus/<?= $dt['presensisiswa_id']; ?>"><i class="fas fa-trash"></i></a></td>
						</tr>
					<?php $no++;} ?>	
				</tbody>
			</table>
		</div>
		
		<!--MODAL TAMBAH DATA-->
		<div id="myModal" class="modal">
		  <div class="modal-content">
			<div class="modal-header">
			  <span class="close">&times;</span>
			  <h2>Tambah Presensi</h2>
			</div>
			<div class="modal-body">
			  <form method="post" action="presensisiswa/tambah" enctype="multipart/form-data">
				<div id="formbox" class="clearfix">
					<div class="formlabel">NISN</div>
					<div class="forminput">
						<input name="presensi_id" type="hidden" value="<?= $id; ?>" class="form-control" required />
						<select name="nisn" class="theSelect form-control">
							<option value="">- Pilih - </option>
							<?php
								$pdb = select("SELECT * FROM tb_siswa ORDER BY nisn ASC");
								while($pdt = fetch($pdb)){
							?>
								<option value="<?= $pdt['nisn']; ?>"><?= $pdt['nisn']; ?> - <?= $pdt['siswa_nama']; ?> </option>
							<?php } ?>	
						</select>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Jam Masuk</div>
					<div class="forminput">
						<input name="presensisiswa_jammasuk" type="time" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Jam Keluar</div>
					<div class="forminput">
						<input name="presensisiswa_jamkeluar" type="time" class="form-control" />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Status</div>
					<div class="forminput">
						<select name="presensisiswa_status" class="theSelect form-control">
							<option value="">- Pilih - </option>
							<option value="Hadir">Hadir</option>
							<option value="Tidak-Hadir">Tidak-Hadir</option>
						</select>
					</div>
				</div>
				<div class="formsubmit">
					<input name="submit" type="submit" value="Simpan" class="btnsubmit"></input>
				</div>
			  </form>
			</div>
		  </div>
		</div>
		
		<!--MODAL EDIT DATA-->
		<?php
			$adb = select("SELECT * FROM tb_presensisiswa INNER JOIN tb_presensi ON tb_presensisiswa.presensi_id = tb_presensi.presensi_id INNER JOIN tb_siswa ON tb_presensisiswa.nisn = tb_siswa.nisn WHERE tb_presensisiswa.presensi_id ='$id' ");
			while($adt = fetch($adb)){
		?>
			<div id="myModalEdit<?= $adt['presensisiswa_id']; ?>" class="modal">
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="closeedit" id="close<?= $adt['presensisiswa_id']; ?>">&times;</span>
				  <h2>Edit Presensi Siswa</h2>
				</div>
				<div class="modal-body">
				  <form method="post" action="presensisiswa/update" enctype="multipart/form-data">
					<div id="formbox" class="clearfix">
						<div class="formlabel">NISN</div>
						<div class="forminput">
							<?php
								$jdb = select("SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id WHERE tb_jadwal.jadwal_id = '$id'");
								$jdt = fetch($jdb);
							?>
							<input name="presensi_id" type="hidden" value="<?= $adt['presensi_id']; ?>" class="form-control" required />
							<input name="presensisiswa_id" type="hidden" value="<?= $adt['presensisiswa_id']; ?>" class="form-control" required />
							<select name="nisn" class="theSelect form-control">
								<option value="<?= $adt['nisn']; ?>"><?= $adt['nisn']; ?> - <?= $adt['siswa_nama']; ?> </option>
								<?php
									$pdb = select("SELECT * FROM tb_siswa ORDER BY nisn ASC");
									while($pdt = fetch($pdb)){
								?>
									<option value="<?= $pdt['nisn']; ?>"><?= $pdt['nisn']; ?> - <?= $pdt['siswa_nama']; ?> </option>
								<?php } ?>	
							</select>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Jam Masuk</div>
						<div class="forminput">
							<input name="presensisiswa_jammasuk" type="time" value="<?= $adt['presensisiswa_jammasuk'] ?>" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Jam Keluar</div>
						<div class="forminput">
							<input name="presensisiswa_jamkeluar" type="time" value="<?= $adt['presensisiswa_jamkeluar'] ?>" class="form-control" />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Status</div>
						<div class="forminput">
							<select name="presensisiswa_status" class="theSelect form-control">
								<option value="<?= $adt['presensisiswa_status'] ?>"><?= $adt['presensisiswa_status'] ?></option>
								<option value="Hadir">Hadir</option>
								<option value="Tidak-Hadir">Tidak-Hadir</option>
							</select>
						</div>
					</div>
					<div class="formsubmit">
						<input name="edit" type="submit" value="Update" class="btnsubmit"></input>
					</div>
				  </form>
				</div>
			  </div>
			</div>
		<?php } ?>	
		
	</div>
</div>
<script>
	<?php  
		$adb = select("SELECT * FROM tb_presensisiswa INNER JOIN tb_presensi ON tb_presensisiswa.presensi_id = tb_presensi.presensi_id INNER JOIN tb_siswa ON tb_presensisiswa.nisn = tb_siswa.nisn WHERE tb_presensisiswa.presensi_id ='$id' ");
		while($adt = fetch($adb)){
	?>
			var modaledit<?= $adt['presensisiswa_id'];?> 	= document.getElementById("myModalEdit<?= $adt['presensisiswa_id'];?>");
			var btnedit<?= $adt['presensisiswa_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['presensisiswa_id'];?>");
			var spanedit<?= $adt['presensisiswa_id'];?> 	= document.getElementById("close<?= $adt['presensisiswa_id'];?>");
			
			btnedit<?= $adt['presensisiswa_id'];?>.onclick = function() {
			  modaledit<?= $adt['presensisiswa_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['presensisiswa_id'];?>.onclick = function() {
			  modaledit<?= $adt['presensisiswa_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['presensisiswa_id'];?>) {
				modaledit<?= $adt['presensisiswa_id'];?>.style.display = "none";
			  }
			}
	<?php } ?>	
	$(document).ready(function () {
		  $('select').selectize({
			  sortField: 'text'
		  });
	  });
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
<script type="text/javascript">
	$(document).ready( function () {
		$('#example').DataTable();
	} );
</script>
<script type="text/javascript" src="cms/assets/js/select.js"></script>
<link rel="stylesheet" href="cms/assets/css/select.css">
<script>
	$(".theSelect").select2();
</script>