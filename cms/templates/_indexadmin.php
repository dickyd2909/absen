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
	<Body>
		<div id="bgtop">
			<div id="botop" class="clearfix">
				<div class="topleft">
					<div id="topleftcont" class="clearfix">
						<a href="/dashboard">
							<div class="topleftlogo">
								<div class="topleftlogoimg">
									<img src="cms/assets/images/smk2logo.png" title="presensi smkn 2 cimahi" alt="presensi smkn 2 cimahi">
								</div>
							</div>
							<div class="toplefttit">
								<h1>SISTEM PRESENSI</h1>
								<p>SMKN 2 CIMAHI</p>
							</div>
						</a>
						<div class="toplefttog">
							<i class="fa fa-bars" id="togglebtn" onclick="btntoogle()"></i>
						</div>
					</div>
				</div>
				<div class="topright">
					<div id="toprightcont"	class="clearfix">
						<div class="toprighttit">
							<h2><?= $sdt['admin_nama'] ?></h2>
							<p><?= $sdt['adminlevel_nama'] ?></p>
						</div>
						<div class="toprightlogo">
							<div class="toprightlogoimg">
								<img src="cms/assets/images/no-image.png" title="presensi smkn 2 cimahi" alt="presensi smkn 2 cimahi" onclick="btnimg()">
								<div class="dropdown-content" id="dropdown">
									<h3>Manage Profile</h3>
									<ul>
										<a href="#"><li><i class="far fa-user"></i> Profile Setting</li></a>
										<a href="/logoutadmin"><li><i class="fas fa-power-off"></i> Logout</li></a>
									</ul>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="bgcontent" class="clearfix">
			<div class="navbar" id="nav">
				<div class="navbartit">
					<h2>PRESENSI SMKN 2 CIMAHI</h2>
				</div>
				<div class="navbarnav">
					<ul class="nav-item">
						<li id="nav"><a href="/admin" class="menu__link"><i class="far fa-user"></i> Admin</a></li>
						<li id="nav"><a href="/guru" class="menu__link"><i class="fas fa-user-tie"></i> Guru</a></li>
						<li id="nav"><a href="/siswa" class="menu__link"><i class="fas fa-users"></i> Siswa</a></li>
						<li id="nav"><a href="/mapel" class="menu__link"><i class="far fa-clipboard"></i> Mata Pelajaran</a></li>
						<li id="nav"><a href="/jadwal" class="menu__link"><i class="far fa-calendar"></i> Jadwal</a></li>							
						<li id="nav"><a href="/jurusan" class="menu__link"><i class="fas fa-desktop"></i> Jurusan</a></li>
						<li id="nav"><a href="/kelas" class="menu__link"><i class="fas fa-school"></i> Kelas</a></li>
						<li id="nav"><a href="/ruang" class="menu__link"><i class="far fa-building"></i> Ruang</a></li>											
					</ul>
				</div>
			</div>
			<div class="contentbody" id="content">
				<?= controller("routes");?>
			</div>
		</div>
	</Body>
	<script>
		$(document).ready(function() {
			if(location.pathname != "/") {
				$('#nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
			} else $('#nav a:eq(0)').addClass('active');
		});
		
		function btntoogle(){
			var nav = document.getElementById("nav");
			var content = document.getElementById("content");
			var dropdown = document.getElementById("dropdown");
			nav.classList.toggle("active");
			content.classList.toggle("active");
			dropdown.classList.remove("active");
		}
		
		function btnimg(){
			var dropdown = document.getElementById("dropdown");
			dropdown.classList.toggle("active");
		}
		
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
</html>	