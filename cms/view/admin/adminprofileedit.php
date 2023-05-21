<title>Profil | PRESENSI SMKN 2 CIMAHI</title>

<div id="profiltit" class="clearfix">
	<h3>User Profile</h3>
	<span><a href="/dashboard">Home</a> > Profile </span>
</div>
<div id="bgbodyrightcontent">
	<?php
			$db = select("SELECT * FROM tb_admin INNER JOIN tb_adminlevel ON tb_admin.adminlevel_id = tb_adminlevel.adminlevel_id WHERE admin_id = '$_SESSION[admin_id]'");
			$dt = fetch($db);
	?>
	<div class="bgprofil">
		<form action="/admin/update/profile" method="post" enctype="multipart/form-data">
			<div id="profilformtitbo" class="clearfix">
				<div class="profilformtit">
					Profil Information
				</div>
				<div class="profilformbtn">
					<input type="submit" name="simpan" value="Simpan" class="btnprofil" />
				</div>
			</div>	
			<div class="profilimg">
				<img src="cms/assets/images/admin/<?= $dt['admin_image']; ?>" title="presensi smkn 2 cimahi" alt="presensi smkn 2 cimahi">
			</div>
			<div class="formbgprofil">
				<input type="file" name="admin_image" class="form-control" />
			</div>
			<div class="profilform clearfix">
				<div class="formprofilkiri">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							NAMA
						</div>
						<input type="text" name="admin_nama" value="<?= $dt['admin_nama']; ?>" class="form-control" />
						<input type="hidden" name="admin_id" value="<?= $dt['admin_id']; ?>" class="form-profil" />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							USERNAME
						</div>
						<input type="text" name="admin_username" value="<?= $dt['admin_username']; ?>" class="form-control" />
					</div>
				</div>
				<div class="formprofilkanan">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							LEVEL
						</div>
						<select name="adminlevel_id" class="form-control">
							<option value="<?= $dt['adminlevel_id']; ?>"><?= $dt['adminlevel_nama']; ?></option>
							<?php
								$ldb = select("SELECT * FROM tb_adminlevel");
								while($ldt = fetch($ldb)){
							?>
								<option value="<?= $ldt['adminlevel_id']; ?>"><?= $ldt['adminlevel_nama']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							STATUS
						</div>
						<select name="admin_status" class="form-control">
							<option value="<?= $dt['admin_status']; ?>"><?= $dt['admin_status']; ?></option>
							<option value="Aktif">Aktif</option>
							<option value="Non-Aktif">Non-Aktif</option>
						</select>
					</div>
				</div>
			</div>
			<div class="formbgprofil">
				<span class="adminpass">*Optional</span>
				<div class="formbgprofiltit">
					PASSWORD
				</div>
				<input type="password" name="admin_password" class="form-control" />
			</div>
		</form>
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