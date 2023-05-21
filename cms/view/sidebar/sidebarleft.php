<div class="bobodyleft" id="bodytoggleleft">
	<div id="bodyleftcont" class="clearfix">
		<div class="bodyleftimg">
			<img src="assets/images/smk2logo.png" alt="Presensi SMKN 2 CIMAHI" title="Presensi SMKN 2 CIMAHI">
		</div>
		<div class="bodylefttext">
			DASHBOARD ADMIN
		</div>
		<div id="bodylefttog" onClick="closeNav()">
			<i class="fas fa-times"></i>
		</div>
		<div id="bodylefttog2" onClick="closeNav2()">
			<i class="fas fa-times"></i>
		</div>
	</div>
	<div id="bodyleftnavtit">
		MASTER DATA
	</div>
	<div id="bodyleftnav">
		<ul class="nav-item">
			<li id="nav"><a href="/admin" class="menu__link"><i class="fas fa-user"></i> Admin</a></li>
			<li id="nav"><a href="/mapel" class="menu__link"><i class="fas fa-clipboard-list"></i> Mata Pelajaran</a></li>
			<li id="nav"><a href="/guru" class="menu__link"><i class="fas fa-chalkboard-teacher"></i> Guru</a></li>
			<li id="nav"><a href="/jurusan" class="menu__link"><i class="fas fa-graduation-cap"></i> Jurusan</a></li>
			
			<li id="nav"><a href="/kelas" class="menu__link"><i class="fas fa-layer-group"></i> Kelas</a></li>
		</ul>
	</div>
</div>
<script>
	$(document).ready(function() {
		if(location.pathname != "/") {
			$('#nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
		} else $('#nav a:eq(0)').addClass('active');
	});
	function openNav(){
			var x = document.getElementById("tooglebutton");
			var i = document.getElementById("toggleleft");
			var y = document.getElementById("toggleright");
			i.style.display = "block";
			y.style.width = "80%";
			y.style.transition ="width 0.2s";
			x.style.display = "none";
		}
		
		function openNav2(){
			var x = document.getElementById("tooglebutton2");
			var i = document.getElementById("toggleleft");
			var y = document.getElementById("toggleright");
			var t = document.getElementById("bodytoggleleft");
			i.style.display = "block";
			i.style.width = "70%";
			t.style.display = "block";
			y.style.transition ="width 0.2s";
			x.style.display = "block";
		}
		
		function closeNav(){
			var x = document.getElementById("tooglebutton");
			var i = document.getElementById("toggleleft");
			var y = document.getElementById("toggleright");
			i.style.display = "none";
			y.style.width = "100%";
			y.style.transition ="width 0.2s";
			x.style.display = "block";
		}
		
		function closeNav2(){
			var x = document.getElementById("tooglebutton");
			var i = document.getElementById("toggleleft");
			var y = document.getElementById("toggleright");
			i.style.display = "none";
			y.style.width = "100%";
			y.style.transition ="width 0.2s";
			x.style.display = "none";
		}
</script>