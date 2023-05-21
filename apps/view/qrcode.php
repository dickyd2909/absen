<title>Scan QR-Code | SMKN 2 CIMAHI</title>
<div id="bgbodyrightcontent">
	<div class="bodyrightcontenttit">
		Scan QR-Code
	</div>
	<div class="bodyrightcontentqr">
		<div class="bodyrightcontentqrcam">
			<video id="previewKamera" style="display:none"></video>
		</div>
		<div class="bodyrightcontentqrsel">
			<select id="pilihKamera">
			</select>
		</div>
		<div class="bodyrightform">
			<form action="/qrcodeaction" method="post" id="form">
				<input name="qrcode" id="text" class="form-control" readonly />
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
<script>
	let selectedDeviceId = null;
		const codeReader 	= new ZXing.BrowserMultiFormatReader();
		const sourceSelect 	= $("#pilihKamera");
		var textval 		= document.getElementById('text');
		var i 				= document.getElementById("previewKamera");
		$(document).on('change','#pilihKamera',function(){
			selectedDeviceId = $(this).val();
			i.style.display = "block";
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
					sourceSelect.html('');
					const sourceOption = document.createElement('option')
					sourceOption.text = '- Pilih kamera -'
					sourceOption.value = '-pilih-'
					sourceOption.selected='selected'
					sourceSelect.append(sourceOption)
					if(selectedDeviceId == null){
						if(videoInputDevices.length > 1){
							selectedDeviceId = sourceOption.text
						} else {
							selectedDeviceId = videoInputDevices[0].deviceId
						}
					}
					 
					 
					if (videoInputDevices.length >= 1) {
						sourceSelect.html('');
						const sourceOption = document.createElement('option')
						sourceOption.text = '- Pilih kamera -'
						sourceOption.value = '-pilih-'
						sourceOption.selected='selected'
						sourceSelect.append(sourceOption)
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
								textval.value = result.text;
								document.getElementsByTagName('form')[0].submit();
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
		
		console.log(textval.value);
 
		if (navigator.mediaDevices) {
			initScanner()
		} else {
			alert('Cannot access camera.');
		}
</script>