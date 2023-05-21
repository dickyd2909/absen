<title>Siswa | Presensi SMKN 2 CIMAHI</title>
<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Siswa
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Siswa</a>
            </div>
        </div>
		<div id="table">
			<table id="example" class="display" style="width:100%">
				<thead>
					<tr>
						<th width="1%"></th>
						<th>NISN</th>
						<th>NAMA</th>
						<th>GENDER</th>
						<th>KELAS</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
		
		<!--MODAL TAMBAH DATA-->
		<div id="myModal" class="modal">
		  <div class="modal-content">
			<div class="modal-header">
			  <span class="close">&times;</span>
			  <h2>Tambah Siswa</h2>
			</div>
			<div class="modal-body">
			  <form method="post" action="siswa/tambah" name="form1" enctype="multipart/form-data">
				<div id="formbox" class="clearfix">
					<div class="formlabel">NISN</div>
					<div class="forminput">
						<input name="nisn" type="text" maxlength="10" onkeypress="return hanyaAngka(event)" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Nama</div>
					<div class="forminput">
						<input name="siswa_nama" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Kelas</div>
					<div class="forminput">
						<select name="kelas_id" class="theSelect form-control">
							<option value="">- Pilih - </option>
							<?php
								$mdb = select("SELECT * FROM tb_kelas INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE tb_kelas.kelas_status = 'Aktif'");
								while($mdt = fetch($mdb)){
									$arr = explode(" ", $mdt['kelas_nama']);
							?>
									<option value="<?= $mdt['kelas_id']; ?>"><?= $arr[0]; ?> - <?= $mdt['jurusan_nama']; ?> - <?= $arr[1]; ?>  <?= $mdt['kelas_tahunajaran']; ?></option>
							<?php } ?>	
						</select>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Tempat Lahir</div>
					<div class="forminput">
						<input name="siswa_tempatlahir" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Tanggal Lahir</div>
					<div class="forminput">
						<input name="siswa_tanggallahir" type="date" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Gender</div>
					<div class="forminput">
						<select name="siswa_gender" class="form-control">
							<option value="Laki-Laki">Laki-Laki</value>
							<option value="Perempuan">Perempuan</value>
						</select>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Email</div>
					<div class="forminput">
						<input name="siswa_email" type="email" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">No.Telp</div>
					<div class="forminput">
						<input name="siswa_notelp" onkeypress="return hanyaAngka(event)" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Email Orang Tua</div>
					<div class="forminput">
						<input name="siswa_emailortu" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">No.Telp Orang Tua</div>
					<div class="forminput">
						<input name="siswa_notelportu" max="12" onkeypress="return hanyaAngka(event)" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Password</div>
					<div class="forminput">
						<input name="siswa_password"  type="password" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Image</div>
					<div class="forminput">
						<input name="siswa_image"  type="file" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Status</div>
					<div class="forminput">
						<select name="siswa_status" class="form-control">
							<option value="Aktif">Aktif</value>
							<option value="Non-aktif">Non-aktif</value>
						</select>
					</div>
				</div>
				<div class="formsubmit">
					<input name="submit" type="submit" value="Simpan" class="btnsubmit"></input>
				</div>
			  </form>
			</div>
		  </div>
		</div>
		
		<!--MODAL EDIT DATA-->
		<?php
			$adb = select("SELECT * FROM tb_siswa INNER JOIN tb_kelas ON tb_siswa.kelas_id = tb_kelas.kelas_id INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id ORDER BY nisn ASC");
			while($adt = fetch($adb)){
		?>
			<div id="myModalEdit<?= $adt['nisn']; ?>" class="modal">
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="closeedit" id="close<?= $adt['nisn']; ?>" onclick="spanClick<?= $adt['nisn']; ?>()">&times;</span>
				  <h2>Edit Siswa</h2>
				</div>
				<div class="modal-body">
				  <form method="post" action="siswa/update" enctype="multipart/form-data">
					<div id="formbox" class="clearfix">
						<div class="formlabel">NISN</div>
						<div class="forminput">
							<input name="nisn" type="text" onkeypress="return hanyaAngka(event)" value="<?= $adt['nisn']; ?>" class="form-control" required />
							<input name="nisnlama" type="hidden" value="<?= $adt['nisn']; ?>" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Nama</div>
						<div class="forminput">
							<input name="siswa_nama" type="text" value="<?= $adt['siswa_nama']; ?>" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Kelas</div>
						<div class="forminput">
							<select name="kelas_id" class="theSelect form-control">
								<?php
									$arr = explode(" ", $adt['kelas_nama']);
								?>
									<option value="<?= $adt['kelas_id']; ?>"><?= $arr[0]; ?> - <?= $adt['jurusan_nama']; ?> - <?= $arr[1]; ?> <?= $adt['kelas_tahunajaran'] ?></option>
								<?php
									$mdb = select("SELECT * FROM tb_kelas INNER JOIN tb_jurusan ON tb_kelas.jurusan_id = tb_jurusan.jurusan_id WHERE tb_kelas.kelas_status = 'Aktif'");
									while($mdt = fetch($mdb)){
										$arr = explode(" ", $mdt['kelas_nama']);
								?>
										<option value="<?= $mdt['kelas_id']; ?>"><?= $arr[0]; ?> - <?= $mdt['jurusan_nama']; ?> - <?= $arr[1]; ?>  <?= $mdt['kelas_tahunajaran']; ?></option>
								<?php } ?>	
							</select>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Tempat Lahir</div>
						<div class="forminput">
							<input name="siswa_tempatlahir" type="text" value="<?= $adt['siswa_tempatlahir']; ?>" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Tanggal Lahir</div>
						<div class="forminput">
							<input name="siswa_tanggallahir" type="date" value="<?= $adt['siswa_tanggallahir']; ?>" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Gender</div>
						<div class="forminput">
							<select name="siswa_gender" class="form-control">
							
								<option value="<?= $adt['siswa_gender']; ?>"><?= $adt['siswa_gender']; ?></value>
								<option value="Laki-Laki">Laki-Laki</value>
								<option value="Perempuan">Perempuan</value>
							</select>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Email</div>
						<div class="forminput">
							<input name="siswa_email" type="email" class="form-control" value="<?= $adt['siswa_email']; ?>" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">No.Telp</div>
						<div class="forminput">
							<input name="siswa_notelp" onkeypress="return hanyaAngka(event)" type="text" value="<?= $adt['siswa_notelp']; ?>" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Email Orang Tua</div>
						<div class="forminput">
							<input name="siswa_emailortu" type="text" value="<?= $adt['siswa_emailortu']; ?>" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">No.Telp Orang Tua</div>
						<div class="forminput">
							<input name="siswa_notelportu" onkeypress="return hanyaAngka(event)" value="<?= $adt['siswa_notelportu']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Upload</div>
						<div class="forminput">
							<input name="siswa_image" type="file" class="form-control"/>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Image</div>
						<div class="forminput">
							<?php if(!empty($adt['siswa_image'])){ ?>
								<img src="cms/assets/images/siswa/<?= $adt['siswa_image']; ?>" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" width="120">
							<?php }else{ ?>
								<img src="cms/assets/images/no-image.png" alt="presensi smkn 2 cimahi" title="presensi smkn 2 cimahi" width="120">
							<?php } ?>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Status</div>
						<div class="forminput">
							<select name="siswa_status" class="form-control">
								<option value="<?= $adt['siswa_status']; ?>"><?= $adt['siswa_status']; ?></value>
								<option value="Aktif">Aktif</value>
								<option value="Non-aktif">Non-aktif</value>
							</select>
						</div>
					</div>
					<div class="formsubmit">
						<input name="edit" type="submit" value="Update" class="btnsubmit"></input>
					</div>
				  </form>
				</div>
			  </div>
			</div>
		<?php } ?>	
		
	</div>
</div>
<script>
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
<script>
	<?php  
		$adb = select("SELECT * FROM tb_siswa ORDER BY nisn ASC");
		$no = 1;
		while($adt = fetch($adb)){
	?>
			var modaledit<?= $adt['nisn'];?> 	= document.getElementById("myModalEdit<?= $adt['nisn'];?>");
			var btnedit<?= $adt['nisn'];?> 	= document.getElementById("myBtnEdit<?= $adt['nisn'];?>");
			var spanedit<?= $adt['nisn'];?> 	= document.getElementById("close<?= $adt['nisn'];?>");
			
			function click<?=$adt['nisn'] ?>() {
			  modaledit<?= $adt['nisn'];?>.style.display = "block";
			}
			
			
			function spanClick<?=$adt['nisn'] ?>() {
			  modaledit<?= $adt['nisn'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['nisn'];?>) {
				modaledit<?= $adt['nisn'];?>.style.display = "none";
			  }
			}
	<?php $no++;} ?>
	$(document).ready(function () {
		  $('select').selectize({
			  sortField: 'text'
		  });
	  });	
</script>
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
<script type="text/javascript" lang="javascript">
	
	function hanyaAngka(event) {
		var angka = (event.which) ? event.which : event.keyCode
		if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
			return false;
		return true;
	}
</script>
<script type="text/javascript">
	function format ( d ) {
		return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" width="10%">'+
			'<tr>'+
				'<td>Tempat & Tanggal Lahir:</td>'+
				'<td>'+d.siswa_tempatlahir+','+d.siswa_tanggallahir+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Email:</td>'+
				'<td>'+d.siswa_email+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>No Telp:</td>'+
				'<td>'+d.siswa_notelp+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Email Ortu:</td>'+
				'<td>'+d.siswa_emailortu+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>No Telp Ortu:</td>'+
				'<td>'+d.siswa_notelportu+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Image:</td>'+
				'<td>'+d.siswa_image+'</td>'+
			'</tr>'+
		'</table>';
	}
 
	$(document).ready(function () {
    var table = $('#example').DataTable({
        ajax: 'libs/getSiswa.php',
       "columns": [
				{
					"className":      'dt-control',
					"orderable":      false,
					"data":           null,
					"defaultContent": ''
				},
				{ "data": "nisn" },
				{ "data": "siswa_nama" },
				{ "data": "siswa_gender" },
				{ "data": "kelas_nama"},
				{ "data": "action"}
			],
        order: [[1, 'asc']],
    });
 
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
 
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
	
	$('#example tbody').on('click', '.btnhapus', function (e) {
       let nama = $(this).data('nama'), url = $(this).data('url')
		Swal.fire({
            title: 'Anda Yakin?',
            text: `Apakah anda yakin ingin menghapus ${nama}?`,
            icon: 'question',
            showCancelButton: true,
        }).then(result => {
            if (result.value) {
                window.location = url
            }
        })
       
    });
	
	$('#example tbody').on('click', '.btnhapus', function (e) {
       let nama = $(this).data('nama'), url = $(this).data('url')
		Swal.fire({
            title: 'Anda Yakin?',
            text: `Apakah anda yakin ingin menghapus ${nama}?`,
            icon: 'question',
            showCancelButton: true,
        }).then(result => {
            if (result.value) {
                window.location = url
            }
        })
       
    });
	
});
</script>

<script type="text/javascript" src="cms/assets/js/select.js"></script>
<link rel="stylesheet" href="cms/assets/css/select.css">
<script>
	$(".theSelect").select2();
</script>