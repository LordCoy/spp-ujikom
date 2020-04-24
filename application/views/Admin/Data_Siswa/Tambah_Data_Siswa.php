<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Siswa | SPP</title>
	
</head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">
		<h5>Input Data Siswa</h5><br>
		<form method="post" action="<?php echo site_url('Admin/Proses_Tambah_Data_Siswa') ?>" class="form-group col-md-6">
			Nomor Induk Siswa Nasional :
			<input type="text" name="nisn" placeholder="NISN..." required="" class="form-control">
			Nomor Induk Siswa :
			<input type="text" name="nis" placeholder="NIS..." required="" class="form-control">
			Nama Lengkap :
			<input type="text" name="nama" placeholder="Nama Lengkap..." required="" class="form-control">
			Tempat Lahir :
			<input type="text" name="tempat" placeholder="Tempat Lahir..." required="" class="form-control">
			Tanggal Lahir :
			<input type="date" name="tgl_lahir" required="" class="form-control">
			Kelas :
			<select name="kelas" required="" class="form-control">
				<option value="">- Pilih Kelas</option>
				<?php foreach($kelas as $k){ ?>
					<option value="<?php echo $k['id_kelas'] ?>"><?php echo $k['nama_kelas'].' '.$k['kompetensi_keahlian']; ?></option>
				<?php } ?>
			</select>
			Nomor Telepon :
			<input type="text" name="no_telp" placeholder="No Telp..." required="" class="form-control">
			Alamat :
			<textarea name="alamat" placeholder="Alamat..." required="" class="form-control"></textarea>
			Status Siswa :
			<select name="status_siswa" class="form-control">
				<option value="">- Pilih Status Siswa</option>
				<option value="siswa pindahan ke kelas X">Siswa Pindahan Ke Kelas X (Sepuluh)</option>
				<option value="siswa pindahan ke kelas XI">Siswa Pindahan Ke Kelas XI (Sebelas)</option>
				<option value="siswa pindahan ke kelas XII">Siswa Pindahan Ke Kelas XII (Dua Belas)</option>
			</select><br>
			<button class="btn btn-sm btn-success">Tambah</button>
		</form>
	</div>

</body>
</html>