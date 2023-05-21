<div id="bodyrighttop" class="clearfix">
	<div class="bodyrightimg">
		<a href="#" id="tooglebutton" onClick="openNav();"><i class="fas fa-bars" id="icon"></i></i></a>
		<a href="#" id="tooglebutton2" onClick="openNav2();"><i class="fas fa-bars" id="icon"></i></i></a>
	</div>
	<div class="bodyrightava">
		<div id="bodyrightavacon" class="clearfix">
			<div class="avatar">
				<img src="assets/images/smk2logo.png" alt="Presensi SMKN 2 CIMAHI" title="Presensi SMKN 2 CIMAHI">
				<div class="dropdown-content">
					<h3>Manage Profile</h3>
					<ul>
						<a href="#"><li><i class="far fa-user"></i> Profile Setting</li></a>
						<a href="/logoutadmin"><li><i class="fas fa-power-off"></i> Logout</li></a>
					</ul>	
				</div>
			</div>
			<div class="avatartext">
				<div class="avatartit">
					<?php echo $_SESSION['admin_nama'];?>
				</div>
				<div class="avatarsubtit">
					<?php 
						$adb = select("SELECT * FROM tb_adminlevel WHERE adminlevel_id = '$_SESSION[adminlevel_id]'");
						$adt = fetch($adb);
						echo $adt['adminlevel_nama'];
					?>
				</div>
			</div>
		</div>
	</div>
</div>