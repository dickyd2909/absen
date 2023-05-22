<title>Ruang | Presesnsi SMKN 2 CIMAHI</title>
<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Ruang
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Ruang</a>
            </div>
        </div>
		<div id="table">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>NO</th>
						<th>ID</th>
						<th>NAMA</th>
						<th>GEDUNG</th>
						<th>STATUS</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$db = select("SELECT * FROM tb_ruang ORDER BY ruang_id ASC");
						while($dt = fetch($db)){
					?>
						<tr>
							<td width="1%"><?= $no; ?></td>
							<td><?= $dt['ruang_id']; ?></td>
							<td><?= $dt['ruang_nama']; ?></td>
							<td><?= $dt['ruang_gedung']; ?></td>
							<td><?= $dt['ruang_status']; ?></td>
							<td><a href="#" id="myBtnEdit<?= $dt['ruang_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a>
							<a href="javascript:void(0)" title="Hapus" class="btnhapus" data-nama="<?= $dt['ruang_nama']; ?>" data-url="/ruang/hapus/<?= $dt['ruang_id']; ?>"><i class="fas fa-trash"></i></a></td>
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
			  <h2>Tambah Ruang</h2>
			</div>
			<div class="modal-body">
			  <form method="post" action="ruang/tambah" enctype="multipart/form-data">
				<div id="formbox" class="clearfix">
					<div class="formlabel">Nama</div>
					<div class="forminput">
						<input name="ruang_nama" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Gedung</div>
					<div class="forminput">
						<input name="ruang_gedung" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Status</div>
					<div class="forminput">
						<select name="ruang_status" class="form-control">
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
			$adb = select("SELECT * FROM tb_ruang ORDER BY ruang_id ASC");
			while($adt = fetch($adb)){
		?>
			<div id="myModalEdit<?= $adt['ruang_id']; ?>" class="modal">
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="closeedit" id="close<?= $adt['ruang_id']; ?>">&times;</span>
				  <h2>Edit Admin</h2>
				</div>
				<div class="modal-body">
				  <form method="post" action="ruang/update" enctype="multipart/form-data">
					<div id="formbox" class="clearfix">
						<div class="formlabel">Nama</div>
						<div class="forminput">
							<input name="ruang_id" value="<?= $adt['ruang_id']; ?>" type="hidden" class="form-control"/>
							<input name="ruang_nama" value="<?= $adt['ruang_nama']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Gedung</div>
						<div class="forminput">
							<input name="ruang_gedung" value="<?= $adt['ruang_gedung']; ?>" type="text" class="form-control" required />
						</div>
					</div>
				
					<div id="formbox" class="clearfix">
						<div class="formlabel">Status</div>
						<div class="forminput">
							<select name="ruang_status" class="form-control">
								<option value="<?= $adt['ruang_status']; ?>"><?= $adt['ruang_status']; ?></value>
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
		$adb = select("SELECT * FROM tb_ruang ORDER BY ruang_id ASC");
		while($adt = fetch($adb)){
	?>
			var modaledit<?= $adt['ruang_id'];?> 	= document.getElementById("myModalEdit<?= $adt['ruang_id'];?>");
			var btnedit<?= $adt['ruang_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['ruang_id'];?>");
			var spanedit<?= $adt['ruang_id'];?> 	= document.getElementById("close<?= $adt['ruang_id'];?>");
			
			btnedit<?= $adt['ruang_id'];?>.onclick = function() {
			  modaledit<?= $adt['ruang_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['ruang_id'];?>.onclick = function() {
			  modaledit<?= $adt['ruang_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['ruang_id'];?>) {
				modaledit<?= $adt['ruang_id'];?>.style.display = "none";
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

