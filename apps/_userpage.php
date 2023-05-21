<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include "../libs/function.php";?>
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
		<link href="assets/images/smk2logo.png" rel="shortcut icon" type="image/x-icon" />
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
		<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
		<script type="text/javascript" src="assets/js/jquery-3.6.1.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
	</head>
	<Body>
		<div id="bocontutama" class="clearfix">
			<div class="bodyleft" id="toggleleft">
					<?php echo view("bodyleft"); ?>
			</div>
			<div class="bodyright" id="toggleright">
				<?php echo view("bodyright"); ?>
				<?php
					switch($_GET['page']){
						case 'qrcode': view("qrcode"); break; 
						case 'jadwalpelajaran': view("jadwalpelajaran"); break;
					}
				?>
			</div>
		</div>
	</Body>
	<script>
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
		
		let selectedDeviceId = null;
		const codeReader = new ZXing.BrowserMultiFormatReader();
		const sourceSelect = $("#pilihKamera");
 
		$(document).on('change','#pilihKamera',function(){
			selectedDeviceId = $(this).val();
			if(codeReader){
				codeReader.reset()
				initScanner()
			}
		})
 
		function initScanner() {
			codeReader
			.listVideoInputDevices()
			.then(videoInputDevices => {
				videoInputDevices.forEach(device =>
					console.log(`${device.label}, ${device.deviceId}`)
				);
 
				if(videoInputDevices.length > 0){
					 
					if(selectedDeviceId == null){
						if(videoInputDevices.length > 1){
							selectedDeviceId = videoInputDevices[1].deviceId
						} else {
							selectedDeviceId = videoInputDevices[0].deviceId
						}
					}
					 
					 
					if (videoInputDevices.length >= 1) {
						sourceSelect.html('');
						videoInputDevices.forEach((element) => {
							const sourceOption = document.createElement('option')
							sourceOption.text = element.label
							sourceOption.value = element.deviceId
							if(element.deviceId == selectedDeviceId){
								sourceOption.selected = 'selected';
							}
							sourceSelect.append(sourceOption)
						})
				 
					}
 
					codeReader
						.decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
						.then(result => {
 
								//hasil scan
								console.log(result.text)
								$("#hasilscan").val(result.text);
							 
								if(codeReader){
									codeReader.reset()
								}
						})
						.catch(err => console.error(err));
					 
				} else {
					alert("Camera not found!")
				}
			})
			.catch(err => console.error(err));
		}
 
 
		if (navigator.mediaDevices) {
			 
 
			initScanner()
			 
 
		} else {
			alert('Cannot access camera.');
		}
	</script>
</html>	