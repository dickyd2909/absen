<div class="bobodyleft" id="bodytoggleleft">
	<div id="bodyleftcont" class="clearfix">
		<div class="bodyleftimg">
			<img src="assets/images/smk2logo.png" alt="Presensi SMKN 2 CIMAHI" title="Presensi SMKN 2 CIMAHI">
		</div>
		<div class="bodylefttext">
			Sistem Presensi
		</div>
		<div id="bodylefttog" onClick="closeNav()">
			<i class="fas fa-times"></i>
		</div>
		<div id="bodylefttog2" onClick="closeNav2()">
			<i class="fas fa-times"></i>
		</div>
	</div>
	<div id="bodyleftnavtit">
		PRESENSI SMKN 2 CIMAHI
	</div>
	<div id="bodyleftnav">
		<ul class="nav-item">
			<li id="nav"><a href="/beranda" class="menu__link"><i class="fas fa-qrcode"></i> Scan QR-Code</a></li>
			<li id="nav"><a href="/jadwal-pelajaran" class="menu__link"><i class="fas fa-clipboard-list"></i> Jadwal Pelajaran</a></li>
			<li><a href="/jadwal-ujian" class="menu__link"><i class="fas fa-calendar"></i></i> Jadwal Ujian</a></li>
		</ul>
	</div>
</div>
<script>
	$(document).ready(function() {
		if(location.pathname != "/") {
			$('#nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
		} else $('#nav a:eq(0)').addClass('active');
	});
</script>