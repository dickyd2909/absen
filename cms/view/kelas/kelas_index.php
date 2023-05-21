<title>Kelas | Presensi SMKN 2 CIMAHI</title>
<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Kelas
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Kelas</a>
            </div>
        </div>
		<div id="table">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>NO</th>
						<th>ID</th>
						<th>NAMA</th>
						<th>JURUSAN</th>
						<th>WALI KELAS</th>
						<th>TAHUN AJARAN</th>
						<th>STATUS</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$db = select("SELECT * FROM tb_kelas INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id INNER JOIN tb_guru ON tb_kelas.nip = tb_guru.nip ORDER BY tb_kelas.kelas_id ASC");
						while($dt = fetch($db)){
					?>
						<tr>
							<td width="1%"><?= $no; ?></td>
							<td width="1%"><?= $dt['kelas_id']; ?></td>
							<td><?= $dt['kelas_nama']; ?></td>
							<td><?= $dt['jurusan_nama']; ?></td>
							<td><?= $dt['guru_nama']; ?></td>
							<td><?= $dt['kelas_tahunajaran']; ?></td>
							<td><?= $dt['kelas_status']; ?></td>
							<td><div class="aflex"><a href="#" id="myBtnEdit<?= $dt['kelas_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a>
							<a href="javascript:void(0)" title="Hapus" class="btnhapus" data-nama="<?= $dt['kelas_nama']; ?>" data-url="/kelas/hapus/<?= $dt['kelas_id']; ?>"><i class="fas fa-trash"></i></a></div></td>
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
			  <h2>Tambah Kelas</h2>
			</div>
			<div class="modal-body">
			  <form method="post" action="kelas/tambah" enctype="multipart/form-data">
				<div id="formbox" class="clearfix">
					<div class="formlabel">Nama</div>
					<div class="forminput">
						<input name="kelas_nama" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Tahun Ajaran</div>
					<div class="forminput">
						<input name="kelas_tahunajaran" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Jurusan</div>
					<div class="forminput">
						<select name="jurusan_id" class="form-control" required>
							<option value="">- Pilih -</value>
							<?php
								$jdb = select("SELECT * FROM tb_jurusan ORDER BY jurusan_id ASC");
								while($jdt = fetch($jdb)){
							?>
								<option value="<?= $jdt['jurusan_id']; ?>"><?= $jdt['jurusan_nama']; ?></value>
							<?php } ?>
						</select>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Wali Kelas</div>
					<div class="forminput">
						<select name="nip" class="form-control" required>
							<option value="">- Pilih -</value>
							<?php
								$gdb = select("SELECT * FROM tb_guru WHERE guru_hashwali = '0' ORDER BY nip ASC");
								while($gdt = fetch($gdb)){
							?>
								<option value="<?= $gdt['nip']; ?>"><?= $gdt['guru_nama']; ?></value>
							<?php } ?>
						</select>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Status</div>
					<div class="forminput">
						<select name="kelas_status" class="form-control">
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
			$adb = select("SELECT * FROM tb_kelas INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id INNER JOIN tb_guru ON tb_kelas.nip = tb_guru.nip ORDER BY tb_kelas.kelas_id ASC");
			while($adt = fetch($adb)){
		?>
			<div id="myModalEdit<?= $adt['kelas_id']; ?>" class="modal">
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="closeedit" id="close<?= $adt['kelas_id']; ?>">&times;</span>
				  <h2>Edit Kelas</h2>
				</div>
				<div class="modal-body">
				  <form method="post" action="kelas/update" enctype="multipart/form-data">
					<div id="formbox" class="clearfix">
						<div class="formlabel">ID</div>
						<div class="forminput">
							<input name="kelas_id" value="<?= $adt['kelas_id']; ?>" type="text" class="form-control"/>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Nama</div>
						<div class="forminput">
							<input name="kelas_idlama" value="<?= $adt['kelas_id']; ?>" type="hidden" class="form-control"/>
							<input name="kelas_nama" value="<?= $adt['kelas_nama']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Tahun Ajaran</div>
						<div class="forminput">
							<input name="kelas_tahunajaran" value="<?= $adt['kelas_tahunajaran']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Jurusan</div>
						<div class="forminput">
							<select name="jurusan_id" class="form-control" required>
								<option value="<?= $adt['jurusan_id']; ?>"><?= $adt['jurusan_nama']; ?></value>
								<?php
									$jdb = select("SELECT * FROM tb_jurusan ORDER BY jurusan_id ASC");
									while($jdt = fetch($jdb)){
								?>
									<option value="<?= $jdt['jurusan_id']; ?>"><?= $jdt['jurusan_nama']; ?></value>
								<?php } ?>
							</select>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Wali Kelas</div>
						<div class="forminput">
							<input name="niplama" value="<?= $adt['nip']; ?>" type="hidden" class="form-control" required />
							<select name="nip" class="form-control" required>
								<option value="<?= $adt['nip']; ?>"><?= $adt['guru_nama']; ?></value>
								<?php
									$gdb = select("SELECT * FROM tb_guru WHERE guru_hashwali = '0' ORDER BY nip ASC");
									while($gdt = fetch($gdb)){
								?>
									<option value="<?= $gdt['nip']; ?>"><?= $gdt['guru_nama']; ?></value>
								<?php } ?>
							</select>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Status</div>
						<div class="forminput">
							<select name="kelas_status" class="form-control">
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
		$adb = select("SELECT * FROM tb_kelas ORDER BY kelas_id ASC");
		while($adt = fetch($adb)){
	?>
			var modaledit<?= $adt['kelas_id'];?> 	= document.getElementById("myModalEdit<?= $adt['kelas_id'];?>");
			var btnedit<?= $adt['kelas_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['kelas_id'];?>");
			var spanedit<?= $adt['kelas_id'];?> 	= document.getElementById("close<?= $adt['kelas_id'];?>");
			
			btnedit<?= $adt['kelas_id'];?>.onclick = function() {
			  modaledit<?= $adt['kelas_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['kelas_id'];?>.onclick = function() {
			  modaledit<?= $adt['kelas_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['kelas_id'];?>) {
				modaledit<?= $adt['kelas_id'];?>.style.display = "none";
			  }
			}
	<?php } ?>	
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
