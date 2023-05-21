<title>Mata Pelajaran</title>
<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Mata Pelajaran
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Mapel</a>
            </div>
        </div>
		<div id="table">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>NO</th>
						<th>NAMA</th>
						<th>JAM PELAJARAN</th>
						<th>STATUS</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$db = select("SELECT * FROM tb_mapel ORDER BY mapel_id ASC");
						while($dt = fetch($db)){
					?>
						<tr>
							<td width="1%"><?= $no; ?></td>
							<td><?= $dt['mapel_nama']; ?></td>
							<td><?= $dt['mapel_jampel']; ?></td>
							<td><?= $dt['mapel_status']; ?></td>
							<td><a href="#" id="myBtnEdit<?= $dt['mapel_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a>
							<a href="javascript:void(0)" title="Hapus" class="btnhapus" data-nama="<?= $dt['mapel_nama']; ?>" data-url="/mapel/hapus/<?= $dt['mapel_id']; ?>"><i class="fas fa-trash"></i></a></td>
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
			  <h2>Tambah Mata Pelajaran</h2>
			</div>
			<div class="modal-body">
			  <form method="post" action="mapel/tambah" enctype="multipart/form-data">
				<div id="formbox" class="clearfix">
					<div class="formlabel">Nama</div>
					<div class="forminput">
						<input name="mapel_nama" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Jam Pelajaran</div>
					<div class="forminput">
						<input name="mapel_jampel" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Status</div>
					<div class="forminput">
						<select name="mapel_status" class="form-control">
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
			$adb = select("SELECT * FROM tb_mapel ORDER BY mapel_id ASC");
			while($adt = fetch($adb)){
		?>
			<div id="myModalEdit<?= $adt['mapel_id']; ?>" class="modal">
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="closeedit" id="close<?= $adt['mapel_id']; ?>">&times;</span>
				  <h2>Edit Admin</h2>
				</div>
				<div class="modal-body">
				  <form method="post" action="mapel/update" enctype="multipart/form-data">
					<div id="formbox" class="clearfix">
						<div class="formlabel">Nama</div>
						<div class="forminput">
							<input name="mapel_id" value="<?= $adt['mapel_id']; ?>" type="hidden" class="form-control"/>
							<input name="mapel_nama" value="<?= $adt['mapel_nama']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Jam Pelajaran</div>
						<div class="forminput">
							<input name="mapel_jampel" value="<?= $adt['mapel_jampel']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Status</div>
						<div class="forminput">
							<select name="mapel_status" class="form-control">
								<option value="<?= $adt['mapel_status']; ?>"><?= $adt['mapel_status']; ?></value>
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
		$adb = select("SELECT * FROM tb_mapel ORDER BY mapel_id ASC");
		while($adt = fetch($adb)){
	?>
			var modaledit<?= $adt['mapel_id'];?> 	= document.getElementById("myModalEdit<?= $adt['mapel_id'];?>");
			var btnedit<?= $adt['mapel_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['mapel_id'];?>");
			var spanedit<?= $adt['mapel_id'];?> 	= document.getElementById("close<?= $adt['mapel_id'];?>");
			
			btnedit<?= $adt['mapel_id'];?>.onclick = function() {
			  modaledit<?= $adt['mapel_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['mapel_id'];?>.onclick = function() {
			  modaledit<?= $adt['mapel_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['mapel_id'];?>) {
				modaledit<?= $adt['mapel_id'];?>.style.display = "none";
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

