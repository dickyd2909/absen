<?php session_start();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include "../config/function.php";?>
	<?php include "../../config/database.php";?>
	<?php include "head.php";?>
	<?php
		if(isset($_GET['admin_username'])){
			$admin_username=$_GET['admin_username'];
		}
		if(empty($_GET['admin_username'])){
			$admin_username=$_SESSION['admin_username'];
		}
		if(!isset($_SESSION['admin_username'])){
			die ("<meta http-equiv='refresh' content='0; url=/session'>");
		}else{
			$admin_username=$_SESSION['admin_username'];
		}
		
		$sdb = select("SELECT * FROM tb_admin INNER JOIN tb_adminlevel ON tb_admin.adminlevel_id = tb_adminlevel.adminlevel_id WHERE admin_username = '$admin_username' ");
		$sdt = fetch($sdb);
	?>
</head>
<body>
	<div id="bgfirst">
        <div id="bofirst" class="clearfix">
			<div class="firstbackground">
				<div class="sidebar" id="sidebar">
					<div class="closebar" onclick="btntoogle();">
						<i class="fa fa-times"></i>
					</div>
					<div class="sidebarimg" >
						<img src="cms/assets/images/smk2logo.png" alt="">
					</div>
					<div class="sidebarlink" id="nav">
						<ul>
							<?php
								if(isset($_GET['m'])){
									if($_GET['m'] == 'dashboard'){
										$db = "active";
									}else{
										$db = "";
									}

									if($_GET['m'] == 'admin'){
										$ad = "active";
									}else{
										$ad = "";
									}
									
									if($_GET['m'] == 'guru'){
										$gr = "active";
									}else{
										$gr = "";
									}

									if($_GET['m'] == 'siswa'){
										$sw = "active";
									}else{
										$sw = "";
									}

									if($_GET['m'] == 'mapel'){
										$mp = "active";
									}else{
										$mp = "";
									}

									if($_GET['m'] == 'jadwal'){
										$jd = "active";
									}else{
										$jd = "";
									}

									if($_GET['m'] == 'jurusan'){
										$js = "active";
									}else{
										$js = "";
									}

									if($_GET['m'] == 'kelas'){
										$kl = "active";
									}else{
										$kl = "";
									}
									if($_GET['m'] == 'ruang'){
										$ru = "active";
									}else{
										$ru = "";
									}
								}
							?>
							<li ><a href="/dashboard" class="navlink <?= $db; ?>"> Dashboard</a></li>
							<li ><a href="/admin" class="navlink <?= $ad; ?>"> Admin</a></li>
							<li ><a href="/guru" class="navlink <?= $gr; ?>"> Guru</a></li>
							<li ><a href="/siswa" class="navlink <?= $sw; ?>"> Siswa</a></li>
							<li ><a href="/mapel" class="navlink <?= $mp; ?>"> Mata Pelajaran</a></li>
							<li ><a href="/jadwal" class="navlink <?= $jd; ?>"> Jadwal</a></li>							
							<li ><a href="/jurusan" class="navlink <?= $js; ?>"> Jurusan</a></li>
							<li ><a href="/kelas" class="navlink <?= $kl; ?>"> Kelas</a></li>
							<li ><a href="/ruang" class="navlink <?= $ru; ?>"> Ruang</a></li>
						</ul>
					</div>
					<div class="sidebarlogout">
						<a href="/logoutadmin" class="btnlogout">Logout</a>
					</div>
				</div>
				<div class="content">
					<div id="bgtop">
						<div id="botop" class="clearfix">
							<div class="tooglebar">
								<i class="fa fa-bars" onclick="btntoogle();"></i> <span>Dashboard</span> 
							</div>
							<div class="avatar">
								<div class="avatarimg">
									<img src="cms/assets/images/admin/<?= $sdt['admin_image']; ?>" alt="">
									<div class="dropdown-content">
									  <div class="dropdown-title">Manage Profile</div>
									  <a href="/admin-profile">Profile Setting</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- section content yang bisa diubah -->
					<div id="bgcont">
						<div id="bocont">
							<?= controller("routes");?>
						</div>
					</div>
				</div>
			</div>	
        </div>
    </div>
</body>
<script type="text/javascript">
	// Add active class to the current button (highlight it)
	var header = document.getElementById("nav");
	var btns = header.getElementsByClassName("navlink");
	for (var i = 0; i < btns.length; i++) {
	  btns[i].addEventListener("click", function() {
	  var current = document.getElementsByClassName("active");
	  current[0].className = current[0].className.replace(" active", "");
	  this.className += " active";
	  });
	}

	function btntoogle(){
		var nav = document.getElementById("sidebar");
		nav.classList.toggle("active");
	}
</script>
</html>