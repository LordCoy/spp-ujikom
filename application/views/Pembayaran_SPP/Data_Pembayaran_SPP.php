<!DOCTYPE html>
<html>
<head>
	<title>Data Pembayaran SPP | SPP</title></head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">
	<h5>Data Pembayaran SPP</h5><br>

		<form method="post" action="<?php echo site_url('Excel/Excel_Pembayaran') ?>">
			<input type="hidden" name="nis2" value="<?php echo $ket2['nis']; ?>">
			<input type="hidden" name="nama2" value="<?php echo $ket2['nama']; ?>">
			<input type="hidden" name="kelas2" value="<?php echo $ket2['id_kelas']; ?>">
			<input type="hidden" name="tb2" value="<?php echo $ket2['tahun_dibayar']; ?>">
			<input type="hidden" name="tgl2" value="<?php echo $ket2['tgl_bayar']; ?>">
			<button class="btn btn-sm btn-primary"><i class="fa fa-file"></i>&nbsp;&nbsp;Export Excel</button>
		</form>

		<br>

		<form method="post" action="<?php echo site_url('Pembayaran/Data_Pembayaran_SPP') ?>" class="form-control">
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
						<?php foreach($data_kelas as $dk){ ?>
						<option value="<?php echo $dk['id_kelas']; ?>"><?php echo $dk['nama_kelas'].' '.$dk['kompetensi_keahlian']; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col">
					<select name="tb" class="form-control">
						<option value="">- Cari Tahun Dibayar</option>
						<option value="1">Tahun Pertama (1)</option>
						<option value="2">Tahun Kedua (2)</option>
						<option value="3">Tahun Ketiga (3)</option>
					</select> 
				</div>
				<div class="col">
					<input type="date" name="tgl" class="form-control">
				</div>
				<div class="col-md-1">
					<button class="btn btn-sm btn-success"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari</button>
				</div>
			</div>
		</form>

		<br>

		<table class="table table-striped">
			<tr class="thead-light">
				<th>NO</th>
				<th>PETUGAS</th>
				<th>NIS</th>
				<th>SISWA/SISWI</th>
				<th>TGL BAYAR</th>
				<th>TAHUN DIBAYAR</th>
				<th>BULAN DIBAYAR</th>
				<th>JUMLAH BAYAR</th>
				<th>STATUS SISWA</th>
			</tr>
			<?php 
				$no=1;
				$bb=0;
				$jb=0; 

				$data_bulan_nama = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

				foreach($data as $d){
					for ($i=0; $i < $d['bulan_dibayar']; $i++) { 
						$nama_bulan = $data_bulan_nama[$i];
					}
				?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $d['nama_petugas'] ?></td>
				<td><?php echo $d['nis'] ?></td>
				<td><?php echo $d['nama'] ?></td>
				<td><?php echo $d['tgl_bayar'] ?></td>
				<td><?php echo 'Tahun Ke '.$d['tahun_dibayar'] ?></td>
				<td><?php echo $nama_bulan; ?></td>
				<td><?php echo 'Rp.'.$d['jumlah_bayar'].';' ?></td>
				<td><?php echo $d['status_pembayaran_siswa']; ?></td>
			</tr>
			<?php 
				$bb = $bb+$d['bulan_dibayar'];
				$jb = $jb+$d['jumlah_bayar'];
			} ?>
			<tr>
				<th colspan="7" style="text-align: right;">Total:</th>
				<th colspan="2"><?php echo 'Rp.'.$jb.';'; ?></th>
			</tr>
		</table>
	</div>

	<br><br><br>
</body>
</html>