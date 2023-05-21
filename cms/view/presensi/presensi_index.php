<title>Presensi | Presensi SMKN 2 CIMAHI</title>
<div id="bgtable">
	<div id="botable">
		<div id="tablebox" class="clearfix">
			<div class="tabletit">
				<h2>Presensi</h2>
			</div>
			<div class="tableadd">
				<a href="#" class="btnsecondary" id="myBtn">+ PRESENSI</a>
			</div>
		</div>	
		<div class="tablecont">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>NO</th>
						<th>JADWAL</th>
						<th>TGL.PRESENSI</th>
						<th>QRCODE</th>
						<th>BA</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$id = $_GET['id'];
						$db = select("SELECT * FROM tb_presensi INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id WHERE tb_jadwal.jadwal_id ='$id' ");
						while($dt = fetch($db)){
					?>
						<tr>
							<td width="1%"><?= $no; ?></td>
							<td><?= $dt['mapel_nama']; ?></td>
							<td><?= $dt['presensi_tanggal']; ?></td>
							<td><?php if(empty($dt['presensi_qrcode'])){
										echo "Belum Generate QR Code";
									}else{
										echo $dt['presensi_qrcode'];	
									}
								?>	
							</td>
							<td><?= $dt['presensi_ba']; ?></td>
							<td><a href="#" id="myBtnEdit<?= $dt['presensi_id']; ?>" class="btnaction"><i class="fa fa-pen"></i></a>
							<a href="javascript:void(0)" title="Hapus" class="btnhapus" data-nama="<?= $dt['presensi_nama']; ?>" data-url="/presensi/hapus/<?= $dt['presensi_id']; ?>"><i class="fas fa-trash"></i></a> <a href="/presensisiswa-<?= $dt['presensi_id']; ?>" class="btnaction"> <i class="fa fa-plus"></i></a></td>
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
			  <form method="post" action="presensi/tambah" enctype="multipart/form-data">
				<div id="formbox" class="clearfix">
					<div class="formlabel">Jadwal</div>
					<div class="forminput">
						<?php
							$jdb = select("SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id WHERE tb_jadwal.jadwal_id = '$id'");
							$jdt = fetch($jdb);
						?>
						<input name="jadwal_id" type="hidden" value="<?= $jdt['jadwal_id']; ?>" class="form-control" required />
						<input name="jadwal_nama" type="text" value="<?= $jdt['mapel_nama']; ?>" class="form-control" required readonly />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Tanggal Presensi</div>
					<div class="forminput">
						<input name="presensi_tanggal" type="date" class="form-control" required />
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
			$adb = select("SELECT * FROM tb_presensi INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id WHERE tb_jadwal.jadwal_id ='$id'");
			while($adt = fetch($adb)){
		?>
			<div id="myModalEdit<?= $adt['presensi_id']; ?>" class="modal">
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="closeedit" id="close<?= $adt['presensi_id']; ?>">&times;</span>
				  <h2>Edit Presensi</h2>
				</div>
				<div class="modal-body">
				  <form method="post" action="presensi/update" enctype="multipart/form-data">
					<div id="formbox" class="clearfix">
						<div class="formlabel">Jadwal</div>
						<div class="forminput">
							<?php
								$jdb = select("SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id WHERE tb_jadwal.jadwal_id = '$id'");
								$jdt = fetch($jdb);
							?>
							<input name="presensi_id" type="hidden" value="<?= $adt['presensi_id']; ?>" class="form-control" required />
							<input name="jadwal_id" type="hidden" value="<?= $jdt['jadwal_id']; ?>" class="form-control" required />
							<input name="jadwal_nama" type="text" value="<?= $jdt['mapel_nama']; ?>" class="form-control" required readonly />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Tanggal Presensi</div>
						<div class="forminput">
							<input name="presensi_tanggal" type="date" value="<?= $adt['presensi_tanggal']; ?>" class="form-control" required />
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
		$adb = select("SELECT * FROM tb_presensi INNER JOIN tb_jadwal ON tb_presensi.jadwal_id = tb_jadwal.jadwal_id INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id WHERE tb_jadwal.jadwal_id ='$id'");
		while($adt = fetch($adb)){
	?>
			var modaledit<?= $adt['presensi_id'];?> 	= document.getElementById("myModalEdit<?= $adt['presensi_id'];?>");
			var btnedit<?= $adt['presensi_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['presensi_id'];?>");
			var spanedit<?= $adt['presensi_id'];?> 	= document.getElementById("close<?= $adt['presensi_id'];?>");
			
			btnedit<?= $adt['presensi_id'];?>.onclick = function() {
			  modaledit<?= $adt['presensi_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['presensi_id'];?>.onclick = function() {
			  modaledit<?= $adt['presensi_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['presensi_id'];?>) {
				modaledit<?= $adt['presensi_id'];?>.style.display = "none";
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
