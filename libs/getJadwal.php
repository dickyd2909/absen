<?php
	session_start();
	require_once "../config/database.php";
	require_once "class.phpmailer.php";
	require_once "class.smtp.php";
	$record = array();
	$user_ip = $_SERVER['REMOTE_ADDR'];
	$postdate = date('Y-m-d');
	if(isset($_SESSION['nip'])){
		$db		= mysqli_query($koneksi,"SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_ruang ON tb_jadwal.ruang_id = tb_ruang.ruang_id INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jadwal_guru ON tb_jadwal.jadwal_id = tb_jadwal_guru.jadwal_id INNER JOIN tb_guru ON tb_jadwal_guru.nip = tb_guru.nip INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE tb_jadwal.jadwal_status = 'Aktif' AND tb_guru.nip = '$_SESSION[nip]'") or die(mysqli_error($koneksi));
	}else{
		$db		= mysqli_query($koneksi,"SELECT * FROM tb_jadwal INNER JOIN tb_mapel ON tb_jadwal.mapel_id = tb_mapel.mapel_id INNER JOIN tb_ruang ON tb_jadwal.ruang_id = tb_ruang.ruang_id INNER JOIN tb_kelas ON tb_jadwal.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jadwal_guru ON tb_jadwal.jadwal_id = tb_jadwal_guru.jadwal_id INNER JOIN tb_guru ON tb_jadwal_guru.nip = tb_guru.nip INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id INNER JOIN tb_presensi ON tb_jadwal.jadwal_id = tb_presensi.jadwal_id INNER JOIN tb_presensisiswa ON tb_presensi.presensi_id = tb_presensisiswa.presensi_id WHERE tb_jadwal.jadwal_status = 'Aktif' AND tb_presensisiswa.nisn = '$_SESSION[nisn]' GROUP BY tb_jadwal.jadwal_id") or die(mysqli_error($koneksi));
	}
	$no     = 1;
	while($dt = mysqli_fetch_array($db)){
		if($_SESSION['nip']){
			$action		=  '<div class="actiondropdown">
								<div class="btndropdown" onclick="btndropdown'.$dt['jadwal_id'].'()" id="btndropdown'.$dt['jadwal_id'].'">
									<i class="fas fa-search"></i>
									<i class="fas fa-chevron-down"></i>
								</div>
								<div class="actioncontentdropdown" id="dropdownitem'.$dt['jadwal_id'].'">
										<ul>
											<li><a href="/generateqr/'.$dt['jadwal_id'].'">Generate QR-Code</a></li>
											<li><a href="/presensi-'.$dt['jadwal_id'].'">View Qr-Code</a></li>
											<li><a href="/detail-'.$dt['jadwal_id'].'">Detail</a></li>
										</ul>
									</div>
							</div>';
		}else{
			$action		= '<div class="actiondropdown">
								<div class="btndropdown" onclick="btndropdown'.$dt['jadwal_id'].'()" id="btndropdown'.$dt['jadwal_id'].'">
									<i class="fas fa-search"></i>
									<i class="fas fa-chevron-down"></i>
								</div>
								<div class="actioncontentdropdown" id="dropdownitem'.$dt['jadwal_id'].'">
										<ul>
											<li><a href="/kehadirankuliah-'.$dt['jadwal_id'].'">Kehadiran Kuliah</a></li>
										</ul>
									</div>
							</div>';
		}
		$arr = explode(" ", $dt['kelas_nama']);
		$jdb = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM tb_presensi WHERE jadwal_id = '$dt[jadwal_id]'");
		$jdt = mysqli_fetch_array($jdb);
		$row = [
			'mapel_nama' 			=> $dt['jadwal_id']."-".$dt['mapel_nama'],
			'jadwal_hari' 			=> $dt['jadwal_hari'],
			'jadwal_jam' 			=> date_format(date_create($dt['jadwal_jammasuk']),'H:i')." - ".date_format(date_create($dt['jadwal_jamkeluar']),'H:i'),
			'guru_nama' 			=> $dt['guru_nama'],
			'ruang_nama' 			=> $dt['ruang_id'],
			'jadwal_realisasi' 		=> $dt['jadwal_realisasi'],
			'terealisasi' 			=> $jdt['jumlah'],
			'kelas_nama'			=> $arr[0]." ".$dt['jurusan_nama']." ".$arr[1],
			'action'				=> $action										
		];
		$record[] = $row;
		$no++;
		$tdb = mysqli_query($koneksi,"SELECT COUNT(*) as hadir FROM tb_presensi INNER JOIN tb_presensisiswa ON tb_presensi.presensi_id = tb_presensisiswa.presensi_id WHERE jadwal_id = '$dt[jadwal_id]' AND tb_presensisiswa.nisn = '".$_SESSION['nisn']."' AND tb_presensisiswa.presensisiswa_status = 'Tidak Hadir'");
		$tdt = mysqli_fetch_array($tdb);
		$hdb = mysqli_query($koneksi,"SELECT COUNT(*) as hadir FROM tb_presensi INNER JOIN tb_presensisiswa ON tb_presensi.presensi_id = tb_presensisiswa.presensi_id WHERE jadwal_id = '$dt[jadwal_id]' AND tb_presensisiswa.nisn = '".$_SESSION['nisn']."' AND tb_presensisiswa.presensisiswa_status = 'Hadir'");
		$hdt = mysqli_fetch_array($hdb);
		
		
		if($tdt['hadir'] == '3'){
			require_once "class.phpmailer.php";
			require_once "class.smtp .php";
			$mail = new PHPMailer();
			$mail->Host = "localhost";
			$mail->SMTPAuth = true;
			$mail->Username = "darmawandicky@gmail.com";
			$mail->Password = "sawahlega02";

			$mail->CharSet = "UTF-8";
			$mail->setFrom('darmawandicky59@gmail.com', 'PRESENSI ONLINE SMKN 2 CIMAHI');
			$mail->addAddress("".$dt['siswa_emailortu']."", "".$dt['siswa_nama']."");
			$mail->Subject = "Pemberitahuan absensi a.n : ".$dt['siswa_nama']." ";
			$mail->Body = "
			<body style='width:100%;max-width:90%;font-family:Arial;color:#000;padding:5%;margin:auto;background:#f2f2f2;line-height:1.6;'>
				<div style='max-width:50%;margin:0 auto;padding:10px;font-family:Arial;background:#fff;line-height:1.6;'>
					<table width='100%' border='0' style='font-family:Arial;color:#F47722;padding:3%;text-align:left;font-weight:400;line-height:1.6;'>
						<tr>
							<td align='center'>
								<img src='https://www.presensi.maliniart.id/assets/images/snj2logo.png' width='100'><br>
								PRESENSI ONLINE SMKN 2 CIMAHI
							</td>
						</tr>
					</table>
					
					<table width='100%' border='0' style='font-family:Arial;background:#fff;padding:2%;font-weight:400;line-height:1.6;'>
						<tr>
							<td>
								Yang terhormat Bapak/Ibu Orang Tua Dari,<br>
								<b>".$dt['siswa_nama']."</b>
								<br>
								<br>
								Kami beritahukan kepada orang tua / wali siswa/i atas nama ".$dt['siswa_nama']." sudah tidak menghadiri pembelajarandengan rincian sebagai berikut pada mata pelajaran ".$dt['mapel_nama'].":
								<br>
								<br>
								<br>
								<br>
								<br>
								<tr>
									<td>Hadir</td>
									<td>:</td>
									<td>".$hdt['hadir']."</td>
								</tr>
								<tr>
									<td>Tidak Hadir</td>
									<td>:</td>
									<td>".$tdt['hadir']."</td>
								</tr>
								<br>
								<br>
								<br>
								<br>
								dari rincian diatas kami harapkan para orang tua/wali siswa/siswi dapat lebih memperhatikan kembali kehadiran anaknya dalam mata pelajaran tersebut
								<br>
								<br>
								Demikian informasi ini Kami sampaikan. Terima kasih atas perhatiannya.
								<br>
								<br>
								Hormat Kami,
								<br>
								<b>SMKN 2 CIMAHI</b>
								<br>
								Badan Pengelola Apartemen Taman Rasuna
								<br>
								<br>
								<br>
								<div style='border-top:1px solid #ddd;border-bottom:1px solid #ddd;color:#999;font-weight:400;font-size:13px;line-height:1.6;'>
									<ul style='margin:0;padding:5px 15px;'>
										<li>Anda menerima email ini sebagai pemberitahuan tentang seluruh data absensi yang terdapat pada layanan PRESENSI ONLINE SMKN 2 CIMAHI.</li>
										<li>Jangan balas email ini. Kami tidak dapat memberikan tanggapan atas pertanyaan yang di kirimkan ke alamat ini.</li>
										<li>Untuk jawaban langsung atas pertanyaan Anda, silahkan hubungi pihak SMKN 2 CIMAHI</li>
									</ul>
								</div>
							</td>
						</tr>
					</table>
					
					<table width='100%' border='0' style='font-family:Arial;color:#666;padding:0 0 2%;text-align:left;font-weight:400;font-size:13px;line-height:1.6;'>
						<tr>
							<td align='center'>
								<div style='color:#ccc'>Email ini di kirim melalui IP address ".$user_ip." pada ".date_format(date_create($postdated), 'd-m-Y H:i:s')."</div>
								Copyright &copy; ".date('Y')." <a href='https://www.tamanrasuna.id' style='color:#F47722;text-decoration:none;line-height:1.6;'>SMKN 2 CIMAHI</a> - All Rights Reserved<br>
								Hak cipta dilindungi oleh undang-undang
							</td>
						</tr>
					</table>
				</div>
			</body>";

			$mail->isHTML(true);

			if (!$mail->Send()) {
				echo "Message could not be sent. <p>";
				echo "Mailer Error: " . $mail->ErrorInfo;
				exit;
			}
		}
	}
	$output = ["data" => $record];
	header('Content-Type: application/json');
	echo json_encode($output, JSON_PRETTY_PRINT);
	
?>