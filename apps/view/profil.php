<title>Profil | PRESENSI SMKN 2 CIMAHI</title>

<div id="profiltit">
	<h3>User Profile</h3>
	<span><a href="/beranda">Home</a> > Profile </span>
</div>
<div id="bgbodyrightcontent">
	<?php
			$db = select("SELECT * FROM tb_siswa INNER JOIN tb_kelas ON tb_siswa.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE nisn = '$_SESSION[nisn]'");
			$dt = fetch($db);
	?>
	<div class="bgprofil">
		<div class="profilformtit">
			Profil Information
		</div>
		<div class="profilimg">
			<img src="cms/assets/images/siswa/<?= $dt['siswa_image']; ?>" title="presensi smkn 2 cimahi" alt="presensi smkn 2 cimahi">
		</div>
		<div class="profilform clearfix">
			<form action="/profiledit-<?= $dt['nisn'];?>" method="post">
				<div class="formbgprofil">
					<div class="formbgprofiltit">
						NISN
					</div>
					<input type="hidden" name="nisnlama" value="<?= $dt['nisn']; ?>" class="form-profil" />
					<input type="text" name="nisn" value="<?= $dt['nisn']; ?>" class="form-profil" disabled />
				</div>
				<div class="formbgprofil">
					<div class="formbgprofiltit">
						NAMA
					</div>
					<input type="disable" name="siswa_nama" value="<?= $dt['siswa_nama']; ?>" class="form-profil" disabled />
				</div>
				<div class="formprofilkiri">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							EMAIL
						</div>
						<input type="disable" name="siswa_email" value="<?= $dt['siswa_email']; ?>" class="form-profil" disabled />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							KELAS
						</div>
						<input type="disable" name="kelas_nama" value="<?= $dt['kelas_nama']; ?>" class="form-profil" disabled />
					</div>
				</div>
				<div class="formprofilkanan">
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							NO.TELP
						</div>
						<input type="disable" name="siswa_notelp" value="<?= $dt['siswa_notelp']; ?>" class="form-profil" disabled />
					</div>
					<div class="formbgprofil">
						<div class="formbgprofiltit">
							GENDER
						</div>
						<input type="disable" name="siswa_gender" value="<?= $dt['siswa_gender']; ?>" class="form-profil" disabled />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>