<?php session_start();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include "../libs/phpqrcode/qrlib.php"; ?>
		<?php include "../libs/function.php";?>
		<?php include "../config/database.php";?>
		<?php
			if(isset($_SESSION['guru_username'])){
				$guru_username=$_SESSION['guru_username'];
			}elseif(isset($_SESSION['siswa_nama'])){
				$siswa_nama=$_SESSION['siswa_nama'];
			}else{
				die ("<meta http-equiv='refresh' content='0; url=/sessiontimeout'>");
			}
		?>
		<meta charset="UTF-8">
		<meta name="generator" content="cmas-phpnative">
		<meta name="robots" content="index, follow">
		<meta name="developer" content="informatikaitenas">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="Presensi Online - SMKN 2 CIMAHI">
		<meta name="keywords" content="presensi smk 2, presensi smkn2 cimahi, presensi smk 2 cimahi, online absen, absen online, smkn 2 cimahi">
		<meta name="author" content="ddfmaymh">
		<meta name="copyright" content="Copyright © 2022 - PT. Bumi Wisata Indonesia">
		<link href="assets/images/smk2logo.png" rel="shortcut icon" type="image/x-icon">
		<meta property="fb:app_id" content="2185073585064315">
		<meta property="og:type" content="website">
		<meta property="article:tag" content="smkn 2 cimahi">
		<meta property="article:tag" content="smkn 2 ">
		<meta property="article:tag" content="smk negeri 2 ">
		<meta property="article:tag" content="smk negeri 2 cimahi">
		<meta property="article:tag" content="presensi smk 2 cimahi">
		<meta property="article:tag" content="presensi online smk 2 cimahi">
		<meta property="article:tag" content="presensi smkn 2 ">
		<meta property="article:tag" content="presensi smkn 2 cimahi ">
		<link rel="stylesheet" href="cms/assets/libs/sweetalert2.min.css">
		<link href="assets/images/smk2logo.png" rel="shortcut icon" type="image/x-icon" />
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
		<script type="text/javascript" src="assets/js/jquery-3.6.1.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
		<script src="cms/assets/libs/sweetalert2.min.js"></script>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@300;400;500;600&family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
	</head>
	<Body id="bg">
		<div id="bgcontent" class="clearfix">
			<div class="contentleft" id="contentleft">
				<div id="contentop" class="clearfix">
					<a href="/beranda">
						<div class="conttoptit">
							<div class="conttopimg">
								<img src="assets/images/smk2logo.png">
							</div>
							<h1>Presensi</h1>
						</div>
					</a>
					<i class="fas fa-times" onclick="btntoogle();"></i>
				</div>
				<div id="contentmid">
					<h2>PRESENSI SMKN 2 CIMAHI</h2>
					<p>...</p>
				</div>
				<div id="contentbottom">
					<ul class="nav-item">
						<?php if(isset($_SESSION['nisn'])){ ?>
							<li id="nav"><a href="/beranda" class="menu__link"><i class="fas fa-qrcode"></i> <span class="navtitle">Scan QR-Code</span></a></li>
							<li id="nav"><a href="/jadwal-pelajaran" class="menu__link"><i class="far fa-calendar-plus"></i> <span class="navtitle">Jadwal Pelajaran</span></a></li>
							<li id="nav"><a href="/absensikehadiran" class="menu__link"><i class="far fa-calendar"></i> <span class="navtitle">Absensi Kehadiran</span></a></li>
						<?php }else{ ?>
							<li id="nav"><a href="/jadwal-pelajaran" class="menu__link"><i class="far fa-calendar-plus"></i> <span class="navtitle">Jadwal Pelajaran</span></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="layer" id="layer"></div>
			<div class="contentright" id="content">
				<div id="contrighttop" class="clearfix">
					<div class="contrighttopimg">
						<img src="assets/images/file.png" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" onclick="btntoogle()">
					</div>
					<div class="conttopava">
						<div class="conttopavaimg">
							<?php if(isset($_SESSION['nip'])){ ?>
								<img src="cms/assets/images/no-image.png" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" onclick="btnimg()">
							<?php }else{ ?>
								<?php 
									$sdb = select("SELECT * FROM tb_siswa WHERE nisn = '$_SESSION[nisn]' ");
									$sdt = fetch($sdb);
									if(!empty($sdt['siswa_image'])){
								?>	
									<img src="cms/assets/images/siswa/<?= $sdt['siswa_image']; ?>" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" onclick="btnimg()">
								<?php }else{ ?>
									<img src="cms/assets/images/no-image.png" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" onclick="btnimg()">
								<?php } ?>
							<?php } ?>	
							<div class="dropdown-content" id="dropdown">
								<?php if(isset($_SESSION['nip'])){ ?>
									<h3><?= $_SESSION['guru_nama']; ?></h3>	
								<?php }else{?>
									<h3><?= $_SESSION['siswa_nama']; ?></h3>	
								<?php } ?>
								<ul>
									<a href="/profil"><li><i class="far fa-user"></i> Profile Setting</li></a>
									<a href="/logoutaction"><li><i class="fas fa-power-off"></i> Logout</li></a>
								</ul>	
							</div>
						</div>	
					</div>
				</div>
				
				<?php
					switch($_GET['page']){
						//view
						case 'qrcode': view("qrcode"); break; 
						case 'jadwalpelajaran': view("jadwalpelajaran"); break;
						case 'presensi': view("presensi"); break;
						case 'detail': view("detail"); break;
						case 'kehadirankuliah': view("kehadirankuliah"); break;
						case 'absensikehadiran': view("absensikehadiran"); break;
						case 'profil': view("profil"); break;
						//action
						case 'qrcodeaction': controller("qrcodeaction"); break;
					}
				?>
			</div>
			<div class="footer" id="footer">
				<p>Copyright &copy 2022 <a href="https://hmif.itenas.ac.id" target="_blank"> Informatika Itenas</a>, All Right Reserved</p>
			</div>
			
		</div>
	</Body>
</html>

<script>
	$(document).ready(function() {
		if(location.pathname != "/") {
			$('#nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
		} else $('#nav a:eq(0)').addClass('active');
	});
	function btnimg(){
		var dropdown = document.getElementById("dropdown");
		dropdown.classList.toggle("active");
	}
	
	
	
	function btntoogle(){
		var nav = document.getElementById("nav");
		var contentleft = document.getElementById("contentleft");
		var dropdown = document.getElementById("dropdown");
		var layer = document.getElementById("layer");
		var footer = document.getElementById("footer");
		contentleft.classList.toggle("active");
		content.classList.toggle("active");
		dropdown.classList.remove("active");
		layer.classList.toggle("active");
		footer.classList.toggle("active");
	}
</script>

