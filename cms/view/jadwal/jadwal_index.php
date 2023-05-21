<title>Jadwal | Presesnsi SMKN 2 CIMAHI</title>
<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Jadwal
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Jadwal</a>
            </div>
        </div>
		<div id="table">
			<table width="120%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>NO</th>
						<th>MATA PELAJARAN</th>
						<th>KELAS</th>
						<th>RUANGAN</th>
						<th>HARI</th>
						<th>JAM</th>
						<th>REALISASI</th>
						<th>GURU</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$db = select("SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id INNER JOIN tb_ruang ON tb_jadwal.ruang_id = tb_ruang.ruang_id ORDER BY jadwal_id ASC");
						while($dt = fetch($db)){
							$jdb = select("SELECT * FROM tb_jurusan WHERE jurusan_id = '$dt[jurusan_id]'");
							$jdt = fetch($jdb);
							$arr = explode(" ", $dt['kelas_nama']);
					?>
						<tr>
							<td width="1%" align="center"><?= $no; ?></td>
							<td><?= $dt['jadwal_id']; ?> <?= $dt['mapel_nama']; ?></td>
							<td><?= $arr[0]; ?> <?= $jdt['jurusan_nama']; ?> <?= $arr[1]; ?></td>
							<td><?= $dt['ruang_id']; ?></td>
							<td width="1%" align="center"><?= $dt['jadwal_hari']; ?></td>
							<td><?= date_format(date_create($dt['jadwal_jammasuk']),'H:i'); ?> - <?= date_format(date_create($dt['jadwal_jamkeluar']), 'H:i'); ?></td>
							<td width="1%" align="center"><?= $dt['jadwal_realisasi']; ?></td>
							<td width="1%"><div class="aflex"><a href="/jadwalguru-<?= $dt['jadwal_id']; ?>" class="btnedit"><i class="fa fa-plus"></i></a></td>
							<td><a href="#" id="myBtnEdit<?= $dt['jadwal_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a>
							<a href="javascript:void(0)" title="Hapus" class="btnhapus" data-nama="<?= $dt['jadwal_nama']; ?>" data-url="/jadwal/hapus/<?= $dt['jadwal_id']; ?>"><i class="fas fa-trash"></i></a></div></td>
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
			  <h2>Tambah Jadwal</h2>
			</div>
			<div class="modal-body">
			  <form method="post" action="jadwal/tambah" enctype="multipart/form-data">
				<div id="formbox" class="clearfix">
					<div class="formlabel">Mata Pelajaran</div>
					<div class="forminput">
						<select name="mapel_id" class="theSelect form-control">
							<option value="">- Pilih - </option>
							<?php
								$mdb = select("SELECT * FROM tb_mapel WHERE mapel_status = 'Aktif'");
								while($mdt = fetch($mdb)){
							?>
								<option value="<?= $mdt['mapel_id']; ?>"><?= $mdt['mapel_nama']; ?></option>
							<?php } ?>	
						</select>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Kelas</div>
					<div class="forminput">
						<select name="kelas_id" class="theSelect form-control">
							<option value="">- Pilih - </option>
							<?php
								$mdb = select("SELECT * FROM tb_kelas INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE tb_kelas.kelas_status = 'Aktif'");
								while($mdt = fetch($mdb)){
									$arr = explode(" ", $mdt['kelas_nama']);
							?>
									<option value="<?= $mdt['kelas_id']; ?>"><?= $arr[0]; ?> - <?= $mdt['jurusan_nama']; ?> - <?= $arr[1]; ?>  <?= $mdt['kelas_tahunajaran']; ?></option>
							<?php } ?>	
						</select>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Ruangan</div>
					<div class="forminput">
						<select name="ruang_id" class="form-control">
							<option value="">- Pilih - </option>
							<?php
								$rdb = select("SELECT * FROM tb_ruang WHERE ruang_status = 'Aktif'");
								while($rdt = fetch($rdb)){
							?>
								<option value="<?= $rdt['ruang_id']; ?>"><?= $rdt['ruang_id']; ?></option>
							<?php } ?>	
						</select>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Hari</div>
					<div class="forminput">
						<select name="jadwal_hari" class="form-control" required>
							<option value="">- Pilih - </option>
							<option value="Senin">Senin</value>
							<option value="Selasa">Selasa</value>
							<option value="Rabu">Rabu</value>
							<option value="Kamis">Kamis</value>
							<option value="Jumat">Jumat</value>
							<option value="Sabtu">Sabtu</value>
							<option value="Minggu">Minggu</value>
						</select>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Jam Masuk</div>
					<div class="forminput">
						<input name="jadwal_jammasuk" type="time" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Jam Keluar</div>
					<div class="forminput">
						<input name="jadwal_jamkeluar" type="time" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Realisasi</div>
					<div class="forminput">
						<input name="jadwal_realisasi" type="number" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Status</div>
					<div class="forminput">
						<select name="jadwal_status" class="form-control">
							<option value="Aktif">Aktif</value>
							<option value="Non-aktif">Non-aktif</value>
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
			$adb = select("SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id INNER JOIN tb_ruang ON tb_jadwal.ruang_id = tb_ruang.ruang_id INNER JOIN tb_jadwal_guru ON tb_jadwal.jadwal_id = tb_jadwal_guru.jadwal_id INNER JOIN tb_guru ON tb_jadwal_guru.nip = tb_guru.nip ORDER BY tb_jadwal.jadwal_id ASC");
			while($adt = fetch($adb)){
		?>
			<div id="myModalEdit<?= $adt['jadwal_id']; ?>" class="modal">
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="closeedit" id="close<?= $adt['jadwal_id']; ?>">&times;</span>
				  <h2>Edit Jadwal</h2>
				</div>
				<div class="modal-body">
				  <form method="post" action="jadwal/update" enctype="multipart/form-data">
					<div id="formbox" class="clearfix">
						<div class="formlabel">Mata Pelajaran</div>
						<div class="forminput">
							<input name="jadwal_id" type="hidden" class="form-control" value="<?= $adt['jadwal_id']; ?>" required />
							<select name="mapel_id" class="theSelect form-control">
								<option value="<?= $adt['mapel_id']; ?>"><?= $adt['mapel_nama']; ?></option>
								<?php
									$mdb = select("SELECT * FROM tb_mapel WHERE mapel_status = 'Aktif'");
									while($mdt = fetch($mdb)){
								?>
									<option value="<?= $mdt['mapel_id']; ?>"><?= $mdt['mapel_nama']; ?></option>
								<?php } ?>	
							</select>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Kelas</div>
						<div class="forminput">
							<select name="kelas_id" class="form-control">
								<?php 
									$kdb = select("SELECT * FROM tb_kelas INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE tb_kelas.kelas_id = '$adt[kelas_id]'");
									$kdt = fetch($kdb);
									$arr = explode(" ", $kdt['kelas_nama']);
								?>
									<option value="<?= $adt['kelas_id']; ?>"><?= $arr[0]; ?> - <?= $kdt['jurusan_nama']; ?> - <?= $arr[1]; ?> <?= $kdt['kelas_tahunajaran'] ?></option>
								<?php
									$mdb = select("SELECT * FROM tb_kelas INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE tb_kelas.kelas_status = 'Aktif'");
									while($mdt = fetch($mdb)){
										$arr = explode(" ", $mdt['kelas_nama']);
								?>
										<option value="<?= $mdt['kelas_id']; ?>"><?= $arr[0]; ?> - <?= $mdt['jurusan_nama']; ?> - <?= $arr[1]; ?>  <?= $mdt['kelas_tahunajaran']; ?></option>
								<?php } ?>	
							</select>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Ruangan</div>
						<div class="forminput">
							<select name="ruang_id" class="form-control">
								<option value="<?= $adt['ruang_id']; ?>"><?= $adt['ruang_id']; ?></option>
								<?php
									$rdb = select("SELECT * FROM tb_ruang WHERE ruang_status = 'Aktif'");
									while($rdt = fetch($rdb)){
								?>
									<option value="<?= $rdt['ruang_id']; ?>"><?= $rdt['ruang_id']; ?></option>
								<?php } ?>	
							</select>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Hari</div>
						<div class="forminput">
							<select name="jadwal_hari" class="form-control">
								<option value="<?= $adt['jadwal_hari']; ?>"><?= $adt['jadwal_hari']; ?></value>
								<option value="Senin">Senin</value>
								<option value="Selasa">Selasa</value>
								<option value="Rabu">Rabu</value>
								<option value="Kamis">Kamis</value>
								<option value="Jumat">Jumat</value>
								<option value="Sabtu">Sabtu</value>
								<option value="Minggu">Minggu</value>
							</select>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Jam Masuk</div>
						<div class="forminput">
							<input name="jadwal_jammasuk" type="time" class="form-control" value="<?= $adt['jadwal_jammasuk']; ?>" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Jam Keluar</div>
						<div class="forminput">
							<input name="jadwal_jamkeluar" type="time" class="form-control" value="<?= $adt['jadwal_jamkeluar']; ?>" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Realisasi</div>
						<div class="forminput">
							<input name="jadwal_realisasi" type="number" value ="<?= $adt['jadwal_realisasi']; ?>" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Status</div>
						<div class="forminput">
							<select name="jadwal_status" class="form-control">
								<option value="<?= $adt['kelas_status']; ?>"><?= $adt['kelas_status']; ?></value>
								<option value="Aktif">Aktif</value>
								<option value="Non-aktif">Non-aktif</value>
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
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0]; 
    btn.onclick = function() {
        modal.style.display = "block";
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<script>
	<?php  
		$adb = select("SELECT * FROM tb_jadwal ORDER BY jadwal_id ASC");
		while($adt = fetch($adb)){
	?>
			var modaledit<?= $adt['jadwal_id'];?> 	= document.getElementById("myModalEdit<?= $adt['jadwal_id'];?>");
			var btnedit<?= $adt['jadwal_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['jadwal_id'];?>");
			var spanedit<?= $adt['jadwal_id'];?> 	= document.getElementById("close<?= $adt['jadwal_id'];?>");
			
			btnedit<?= $adt['jadwal_id'];?>.onclick = function() {
			  modaledit<?= $adt['jadwal_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['jadwal_id'];?>.onclick = function() {
			  modaledit<?= $adt['jadwal_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['jadwal_id'];?>) {
				modaledit<?= $adt['jadwal_id'];?>.style.display = "none";
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
<script type="text/javascript">
	$(document).ready(function() {
		$("#tambahGuru").click(function() {
			var html = $("#guruBaru").html();
			$(".after-add-more").after(html);
		});

		$("body").on("click", "#hapusGuru", function() {
			$(this).parents("#guru").remove();
		});
	});
</script>
