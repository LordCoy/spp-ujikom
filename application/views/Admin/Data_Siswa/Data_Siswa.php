<!DOCTYPE html>
<html>
<head>
	<title>Data Siswa | SPP</title>
</head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">
		<a href="<?php echo site_url('Admin/Tambah_Data_Siswa') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data Siswa</a><br><br>

		<form method="post" action="<?php echo site_url('Excel/Excel_Siswa') ?>">
			<input type="hidden" name="nis2" value="<?php echo $ket['nis']; ?>">
			<input type="hidden" name="nama2" value="<?php echo $ket['nama']; ?>">
			<input type="hidden" name="kelas2" value="<?php echo $ket['kelas']; ?>">
			<input type="hidden" name="kompetensi_keahlian2" value="<?php echo $ket['kompetensi_keahlian']; ?>">
			<input type="hidden" name="alamat2" value="<?php echo $ket['alamat']; ?>">
			<input type="hidden" name="spp2" value="<?php echo $ket['id_spp']; ?>">
			<button class="btn btn-sm btn-primary"><i class="fa fa-file"></i>&nbsp;&nbsp;Export Excel</button>
		</form> 

		<br>

		<form method="post" action="<?php echo site_url('Admin/Data_Siswa') ?>" class="form-control">
			<p>Filter Pencarian</p>
			<div class="row">
				<div class="col">
					<input type="text" name="nis" placeholder="Cari NIS..." class="form-control">
				</div>
				<div class="col">
					<input type="text" name="nama" placeholder="Cari Nama..." class="form-control">
				</div>
				<div class="col">
					<select name="kelas" class="form-control">
						<option value="">- Cari Kelas</option>
						<option value="X">X</option>
						<option value="XI">XI</option>
						<option value="XII">XII</option>
					</select>
				</div>
				<div class="col">
					<select name="kompetensi_keahlian" class="form-control">
						<option value="">- Cari Kompetensi Keahlian</option>
						<option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
						<option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
						<option value="Akuntansi dan Keuangan Lembaga">Akuntansi dan Keuangan Lembaga</option>
						<option value="Otomatisasi Tata Kelola Perkantoran">Otomatisasi Tata Kelola Perkantoran</option>
						<option value="Bisnis Daring Pemasaran">Bisnis Daring Pemasaran</option>
					</select>
				</div>
				<div class="col">
					<input type="text" name="alamat" placeholder="Cari Alamat..." class="form-control">
				</div>
				<div class="col">
					<select name="spp" class="form-control">
						<option value="">- Cari Tahun SPP</option>
						<?php foreach($spp as $s){ 
							  if($s['tahun'] == '0'){
							  	$tahun = 'Belum Bayar';
							  }else{
							  	$tahun = 'Tahun Ke '.$s['tahun'];
							  }
							?>
						<option value="<?php echo $s['id_spp'] ?>"><?php echo $tahun; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-1">
					<button class="btn btn-sm btn-success"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari</button>
				</div>
			</div>
		</form><br>

		<table class="table table-striped">
			<thead class="thead-light">
				<tr>
					<th>NO</th>
					<th>NISN</th>
					<th>NIS</th>
					<th>Nama</th>
					<th>Tempat, Tanggal Lahir</th>
					<th>Kelas</th>
					<th>Alamat</th>
					<th>No Telp</th>
					<th>SPP Tahun</th>
					<th>Status Siswa</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<?php $no=1; foreach($siswa as $s){ ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $s['nisn']; ?></td>
				<td><?php echo $s['nis']; ?></td>
				<td><?php echo $s['nama']; ?></td>
				<td><?php echo $s['tempat'].', '.$s['tgl_lahir']; ?></td>
				<td><?php echo $s['nama_kelas'].' '.$s['kompetensi_keahlian']; ?></td>
				<td><?php echo $s['alamat']; ?></td>
				<td><?php echo $s['no_telp']; ?></td>
				<td>
					<?php if($s['tahun'] == '0'){
							$tahun = 'Belum Bayar';
						  }else{
						  	$tahun = 'Tahun Ke '.$s['tahun'];
						  }
						  echo $tahun; ?>
				</td>
				<td><?php echo $s['status_siswa']; ?></td>
				<td>
					<a href="<?php echo site_url('Admin/Edit_Data_Siswa/'.$s['nisn']) ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit</a>&nbsp;&nbsp;
					<a href="<?php echo site_url('Admin/Hapus_data_Siswa/'.$s['nisn']) ?>" onclick="return confirm('Yakin Menghapus Data Ini?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</a>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>

	<br><br>
</body>
</html>