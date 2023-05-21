<title>Guru | Presesnsi SMKN 2 CIMAHI</title>
<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Data Guru
            </div>
            <div class="tabletopbtn">
                <a href="#" id="myBtn">+ Guru</a>
            </div>
        </div>
		<div id="table">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr align="left">
						<th width="1%"></th>
						<th width="1%" align="center">NO</th>
						<th>NIP</th>
						<th>NAMA</th>
						<th>NO.TELP</th>
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
			  <h2>Tambah Guru</h2>
			</div>
			<div class="modal-body">
			  <form method="post" action="guru/tambah" enctype="multipart/form-data">
				<div id="formbox" class="clearfix">
					<div class="formlabel">NIP</div>
					<div class="forminput">
						<input name="nip" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Nama</div>
					<div class="forminput">
						<input name="guru_nama" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">No. Telp</div>
					<div class="forminput">
						<input name="guru_notelp" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Email</div>
					<div class="forminput">
						<input name="guru_email" type="email" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Gender</div>
					<div class="forminput">
						<select name="guru_gender" class="form-control">
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Alamat</div>
					<div class="forminput">
						<textarea name="guru_alamat" class="form-control" required></textarea>
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Username</div>
					<div class="forminput">
						<input name="guru_username" type="text" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Password</div>
					<div class="forminput">
						<input name="guru_password" type="password" class="form-control" required />
					</div>
				</div>
				<div id="formbox" class="clearfix">
					<div class="formlabel">Status</div>
					<div class="forminput">
						<select name="guru_status" class="form-control">
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
			$adb = select("SELECT * FROM tb_guru ORDER BY nip ASC");
			while($adt = fetch($adb)){
		?>
			<div id="myModalEdit<?= $adt['nip']; ?>" class="modal">
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="closeedit" id="close<?= $adt['nip']; ?>" onclick="spanClick<?= $adt['nip']; ?>()">&times;</span>
				  <h2>Edit Admin</h2>
				</div>
				<div class="modal-body">
				  <form method="post" action="guru/update" enctype="multipart/form-data">
					<div id="formbox" class="clearfix">
						<div class="formlabel">Nip</div>
						<div class="forminput">
							<input name="nip" value="<?= $adt['nip']; ?>" type="text" class="form-control"/>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Nama</div>
						<div class="forminput">
							<input name="niplama" value="<?= $adt['nip']; ?>" type="hidden" class="form-control"/>
							<input name="guru_nama" value="<?= $adt['guru_nama']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">No.Telp</div>
						<div class="forminput">
							<input name="guru_notelp" value="<?= $adt['guru_notelp']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Email</div>
						<div class="forminput">
							<input name="guru_email" value="<?= $adt['guru_email']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Gender</div>
						<div class="forminput">
							<select name="guru_gender" class="form-control">
								<option value="<?= $adt['guru_gender']; ?>"><?= $adt['guru_gender']; ?></option>
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Alamat</div>
						<div class="forminput">
							<textarea name="guru_alamat" class="form-control" required><?= $adt['guru_alamat']; ?></textarea>
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Username</div>
						<div class="forminput">
							<input name="guru_username" value="<?= $adt['guru_username']; ?>" type="text" class="form-control" required />
						</div>
					</div>
					<div id="formbox" class="clearfix">
						<div class="formlabel">Status</div>
						<div class="forminput">
							<select name="guru_status" class="form-control">
								<option value="<?= $adt['guru_status']; ?>"><?= $adt['guru_status']; ?></value>
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
		$adb = select("SELECT * FROM tb_guru ORDER BY nip ASC");
		while($adt = fetch($adb)){
	?>
			var modaledit<?= $adt['nip'];?> 	= document.getElementById("myModalEdit<?= $adt['nip'];?>");
			var btnedit<?= $adt['nip'];?> 	= document.getElementById("myBtnEdit<?= $adt['nip'];?>");
			var spanedit<?= $adt['nip'];?> 	= document.getElementById("close<?= $adt['nip'];?>");
			
			function click<?=$adt['nip'] ?>() {
			  modaledit<?= $adt['nip'];?>.style.display = "block";
			}
			
			
			function spanClick<?=$adt['nip'] ?>() {
			  modaledit<?= $adt['nip'];?>.style.display = "none";
			}
			
			window.onclick = function(event) {
			  if (event.target == modaledit<?= $adt['nip'];?>) {
				modaledit<?= $adt['nip'];?>.style.display = "none";
			  }
			}
	<?php } ?>	
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
<script type="text/javascript" lang="javascript">
     $('.btnhapus').click(function(e) {
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
    })
</script>
<script type="text/javascript">
	function format ( d ) {
		return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" width="10%">'+
			'<tr>'+
				'<td>Email:</td>'+
				'<td>'+d.guru_email+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Gender:</td>'+
				'<td>'+d.guru_gender+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Alamat:</td>'+
				'<td>'+d.guru_alamat+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Username:</td>'+
				'<td>'+d.guru_username+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Status:</td>'+
				'<td>'+d.guru_status+'</td>'+
			'</tr>'+
		'</table>';
	}
 
	$(document).ready(function () {
    var table = $('#example').DataTable({
        ajax: 'libs/getGuru.php',
       "columns": [
				{
					"className":      'dt-control',
					"orderable":      false,
					"data":           null,
					"defaultContent": ''
				},
				{ "data": "no" },
				{ "data": "nip" },
				{ "data": "guru_nama" },
				{ "data": "guru_notelp" },
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
	
});
</script>
