<title>Jurusan | Presesnsi SMKN 2 CIMAHI</title>
<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Jurusan
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Jurusan</a>
            </div>
        </div>
		<div id="table">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>NO</th>
						<th>ID</th>
						<th>NAMA</th>
						<th>STATUS</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$db = select("SELECT * FROM tb_jurusan ORDER BY jurusan_id ASC");
						while($dt = fetch($db)){
					?>
						<tr id="<?php echo $dt['jurusan_id']; ?>">
							<td width="1%"><?= $no; ?></td>
							<td width="1%"><?= $dt['jurusan_id']; ?></td>
							<td><?= $dt['jurusan_nama']; ?></td>
							<td><?= $dt['jurusan_status']; ?></td>
							<td><a href="#" id="myBtnEdit<?= $dt['jurusan_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a>
							<a href="javascript:void(0)" title="Hapus" class="btnhapus" data-nama="<?= $dt['jurusan_nama']; ?>" data-url="/jurusan/hapus/<?= $dt['jurusan_id']; ?>"><i class="fas fa-trash"></i></a></td>
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
			  <h2>Tambah Jurusan</h2>
			</div>
			<div class="modal-body">
			  <form method="post" action="jurusan/tambah" enctype="multipart/form-data">
				<div id="formbox" class="clearfix">
					<div class="formlabel">ID</div>
					<div class="forminput">
						<input name="jurusan_id" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Nama</div>
					<div class="forminput">
						<input name="jurusan_nama" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Status</div>
					<div class="forminput">
						<select name="jurusan_status" class="form-control">
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
			$adb = select("SELECT * FROM tb_jurusan ORDER BY jurusan_id ASC");
			while($adt = fetch($adb)){
		?>
			<div id="myModalEdit<?= $adt['jurusan_id']; ?>" class="modal">
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="closeedit" id="close<?= $adt['jurusan_id']; ?>">&times;</span>
				  <h2>Edit Jurusan</h2>
				</div>
				<div class="modal-body">
				  <form method="post" action="jurusan/update" enctype="multipart/form-data">
					<div id="formbox" class="clearfix">
						<div class="formlabel">Nama</div>
						<div class="forminput">
							<input name="jurusan_id" value="<?= $adt['jurusan_id']; ?>" type="hidden" class="form-control"/>
							<input name="jurusan_idlama" value="<?= $adt['jurusan_id']; ?>" type="hidden" class="form-control"/>
							<input name="jurusan_nama" value="<?= $adt['jurusan_nama']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Status</div>
						<div class="forminput">
							<select name="jurusan_status" class="form-control">
								<option value="<?= $adt['jurusan_status']; ?>"><?= $adt['jurusan_status']; ?></value>
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
		$adb = select("SELECT * FROM tb_jurusan ORDER BY jurusan_id ASC");
		while($adt = fetch($adb)){
	?>
			var modaledit<?= $adt['jurusan_id'];?> 	= document.getElementById("myModalEdit<?= $adt['jurusan_id'];?>");
			var btnedit<?= $adt['jurusan_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['jurusan_id'];?>");
			var spanedit<?= $adt['jurusan_id'];?> 	= document.getElementById("close<?= $adt['jurusan_id'];?>");
			
			btnedit<?= $adt['jurusan_id'];?>.onclick = function() {
			  modaledit<?= $adt['jurusan_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['jurusan_id'];?>.onclick = function() {
			  modaledit<?= $adt['jurusan_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['jurusan_id'];?>) {
				modaledit<?= $adt['jurusan_id'];?>.style.display = "none";
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
<script type="text/javascript">
	$(document).ready( function () {
		$('#example').DataTable();
	} );
</script>
