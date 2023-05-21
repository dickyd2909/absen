<title>Profil | PRESENSI SMKN 2 CIMAHI</title>

<div id="profiltit" class="clearfix">
	<h3>User Profile</h3>
	<span><a href="/Dashboard">Home</a> > Profile </span>
</div>
<div id="bgbodyrightcontent">
	<?php
			$db = select("SELECT * FROM tb_admin INNER JOIN tb_adminlevel ON tb_admin.adminlevel_id = tb_adminlevel.adminlevel_id WHERE admin_id = '$_SESSION[admin_id]'");
			$dt = fetch($db);
	?>
	<div class="bgprofil">
		<div id="profilformtitbo" class="clearfix">
			<div class="profilformtit">
				Profil Information
			</div>
			<div class="profilformbtn">
				<a href="/admin-edit-profile" class="btnprofil" id="myBtn">Edit</a>
			</div>
		</div>	
		<div class="profilimg">
			<img src="cms/assets/images/admin/<?= $dt['admin_image']; ?>" title="presensi smkn 2 cimahi" alt="presensi smkn 2 cimahi">
		</div>
		<div class="profilform clearfix">
			<form action="/profiledit-<?= $dt['nisn'];?>" method="post">
				<div class="formprofilkiri">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							NAMA
						</div>
						<input type="disable" name="siswa_nama" value="<?= $dt['admin_nama']; ?>" class="form-profil" disabled />
						<input type="hidden" name="admin_id" value="<?= $dt['admin_id']; ?>" class="form-profil" />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							USERNAME
						</div>
						<input type="disable" name="admin_username" value="<?= $dt['admin_username']; ?>" class="form-profil" disabled />
					</div>
				</div>
				<div class="formprofilkanan">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							LEVEL
						</div>
						<input type="disable" name="adminlevel_id" value="<?= $dt['adminlevel_nama']; ?>" class="form-profil" disabled />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							STATUS
						</div>
						<input type="disable" name="admin_status" value="<?= $dt['admin_status']; ?>" class="form-profil" disabled />
					</div>
				</div>
			</form>
		</div>
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