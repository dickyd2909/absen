<title>Admin | Presesnsi SMKN 2 CIMAHI</title>
<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Admin
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Admin</a>
            </div>
        </div>
		<div id="table">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th>NO</th>
						<th>NAMA</th>
						<th>USERNAME</th>
						<th>IMAGE</th>
						<th>STATUS</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$db = select("SELECT * FROM tb_admin ORDER BY admin_id ASC");
						while($dt = fetch($db)){
							
						if(!empty($dt['admin_image'])){ 
							$image = '<img src="cms/assets/images/admin/'.$dt['admin_image'].'" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" width="80">'; 
						}else{ 
							$image =  '<img src="cms/assets/images/no-image.png" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" width="80">';
						}	
							
					?>
						<tr>
							<td width="1%"><?= $no; ?></td>
							<td><?= $dt['admin_nama']; ?></td>
							<td><?= $dt['admin_username']; ?></td>
							<td><?= $image;?></td>
							<td><?= $dt['admin_status']; ?></td>
							<td><a href="#" id="myBtnEdit<?= $dt['admin_id']; ?>" class="btnedit"><i class="fa fa-pen"></i></a>
							<a href="javascript:void(0)" title="Hapus" class="btnhapus" data-nama="<?= $dt['admin_nama']; ?>" data-url="/admin/hapus/<?= $dt['admin_id']; ?>"><i class="fas fa-trash"></i></a></td>
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
			  <h2>Tambah Admin</h2>
			</div>
			<div class="modal-body">
			  <form method="post" action="admin/tambah" enctype="multipart/form-data">
				<div id="formbox" class="clearfix">
					<div class="formlabel">Nama</div>
					<div class="forminput">
						<input name="admin_nama" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Username</div>
					<div class="forminput">
						<input name="admin_username" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Password</div>
					<div class="forminput">
						<input name="admin_password" type="password" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Level</div>
					<div class="forminput">
						<select name="adminlevel_id" class="form-control">
							<option value="">- Pilih -</value>
							<?php
								$ldb = select("SELECT * FROM tb_adminlevel ORDER BY adminlevel_id ASC");
								while($ldt = fetch($ldb)){
							?>
								<option value="<?= $ldt['adminlevel_id']; ?>"><?= $ldt['adminlevel_nama']; ?></value>
							<?php } ?>	
						</select>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Image</div>
					<div class="forminput">
						<input name="admin_image"  type="file" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Status</div>
					<div class="forminput">
						<select name="admin_status" class="form-control">
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
			$adb = select("SELECT * FROM tb_admin ORDER BY admin_id ASC");
			while($adt = fetch($adb)){
		?>
			<div id="myModalEdit<?= $adt['admin_id']; ?>" class="modal">
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="closeedit" id="close<?= $adt['admin_id']; ?>">&times;</span>
				  <h2>Edit Admin</h2>
				</div>
				<div class="modal-body">
				  <form method="post" action="admin/update" enctype="multipart/form-data">
					<div id="formbox" class="clearfix">
						<div class="formlabel">Nama</div>
						<div class="forminput">
							<input name="admin_id" value="<?= $adt['admin_id']; ?>" type="hidden" class="form-control"/>
							<input name="admin_nama" value="<?= $adt['admin_nama']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Username</div>
						<div class="forminput">
							<input name="admin_username" value="<?= $adt['admin_username']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Level</div>
						<div class="forminput">
							<select name="adminlevel_id" class="form-control">
								<?php
									$sldb = select("SELECT * FROM tb_adminlevel WHERE adminlevel_id = '$adt[adminlevel_id]'");
									$sldt = fetch($sldb);
								?>
								<option value="<?= $sldt['adminlevel_id']; ?>"><?= $sldt['adminlevel_nama']; ?></value>
								<?php
									$ldb = select("SELECT * FROM tb_adminlevel ORDER BY adminlevel_id ASC");
									while($ldt = fetch($ldb)){
								?>
									<option value="<?= $ldt['adminlevel_id']; ?>"><?= $ldt['adminlevel_nama']; ?></value>
								<?php } ?>	
							</select>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Upload</div>
						<div class="forminput">
							<input name="admin_image" type="file" class="form-control"/>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Image</div>
						<div class="forminput">
							<?php if(!empty($adt['admin_image'])){ ?>
								<img src="cms/assets/images/admin/<?= $adt['admin_image']; ?>" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" width="120">
							<?php }else{ ?>
								<img src="cms/assets/images/no-image.png" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" width="120">
							<?php } ?>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Status</div>
						<div class="forminput">
							<select name="admin_status" class="form-control">
								<option value="<?= $adt['admin_status']; ?>"><?= $adt['admin_status']; ?></value>
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
		$adb = select("SELECT * FROM tb_admin ORDER BY admin_id ASC");
		while($adt = fetch($adb)){
	?>
			var modaledit<?= $adt['admin_id'];?> 	= document.getElementById("myModalEdit<?= $adt['admin_id'];?>");
			var btnedit<?= $adt['admin_id'];?> 	= document.getElementById("myBtnEdit<?= $adt['admin_id'];?>");
			var spanedit<?= $adt['admin_id'];?> 	= document.getElementById("close<?= $adt['admin_id'];?>");
			
			btnedit<?= $adt['admin_id'];?>.onclick = function() {
			  modaledit<?= $adt['admin_id'];?>.style.display = "block";
			}
			
			spanedit<?= $adt['admin_id'];?>.onclick = function() {
			  modaledit<?= $adt['admin_id'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['admin_id'];?>) {
				modaledit<?= $adt['admin_id'];?>.style.display = "none";
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

