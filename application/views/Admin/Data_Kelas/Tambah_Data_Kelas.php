<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Kelas | SPP</title>
</head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">
		<h5>Tambah Data Kelas</h5><br>
		<form method="post" action="<?php echo site_url('Admin/Proses_Tambah_Data_Kelas') ?>" class="form-group col-md-6">
			Kelas :
			<select name="kelas" required="" class="form-control">
				<option value="">- Pilih Kelas</option>
				<option value="X">X (Sepuluh)</option>
				<option value="XI">XI (Sebelas)</option>
				<option value="XII">XII (Dua Belas)</option>
			</select>
			Kompetensi Keahlian :
			<input type="text" name="kompetensi" required="" placeholder="Kompetensi Keahlian..." class="form-control"><br>
			<button class="btn btn-sm btn-success">Tambah</button>
		</form>
	</div>
</body>
</html>