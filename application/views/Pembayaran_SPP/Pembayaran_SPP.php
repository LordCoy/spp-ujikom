<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran SPP | SPP</title>
</head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">
		<div class="hasil-search">
			<div class="row">
				<div class="col">
					<h5>Data Siswa/Siswi</h5><br>
					NISN <input type="text" name="nisn" readonly="" value="<?php echo $data_siswa->nisn ?>" class="form-control">
					NIS <input type="text" name="nis" readonly="" value="<?php echo $data_siswa->nis ?>" class="form-control">
					Nama Lengkap <input type="text" name="nama" readonly="" value="<?php echo $data_siswa->nama ?>" class="form-control">
					Kelas <input type="text" name="kelas" readonly="" value="<?php echo $data_siswa->nama_kelas.' '.$data_siswa->kompetensi_keahlian?>" class="form-control">
					Alamat <input type="text" name="alamat" readonly="" value="<?php echo $data_siswa->alamat ?>" class="form-control">
					Nomor Telepon <input type="text" name="no_telp" readonly="" value="<?php echo $data_siswa->no_telp ?>" class="form-control">
					SPP Tahun Ke <input type="text" name="spp" readonly="" value="<?php if($data_siswa->id_spp == 4){echo '0';}else{echo $data_siswa->id_spp;} ?>" class="form-control">
				</div>
				<div class="col">
					<h5>Pembayaran SPP</h5><br>
					<div class="form-group">
						<?php 
							$jumlah_bulan = 0;
							foreach($pembayaran as $p){ 
								$jumlah_bulan = $p['bulan_dibayar']+$jumlah_bulan;
							}

							if($jumlah_bulan == 1 || $jumlah_bulan == 13 || $jumlah_bulan == 25){
								$bulan_terakhir = 'Januari';
							  }else if($jumlah_bulan == 2 || $jumlah_bulan == 14 || $jumlah_bulan == 26){
								$bulan_terakhir = 'Februari';
							  }else if($jumlah_bulan == 3 || $jumlah_bulan == 15 || $jumlah_bulan == 27){
								$bulan_terakhir = 'Maret';
							  }else if($jumlah_bulan == 4 || $jumlah_bulan == 16 || $jumlah_bulan == 28){
								$bulan_terakhir = 'April';
							  }else if($jumlah_bulan == 5 || $jumlah_bulan == 17 || $jumlah_bulan == 29){
								$bulan_terakhir = 'Mei';
							  }else if($jumlah_bulan == 6 || $jumlah_bulan == 18 || $jumlah_bulan == 30){
								$bulan_terakhir = 'Juni';
							  }else if($jumlah_bulan == 7 || $jumlah_bulan == 19 || $jumlah_bulan == 31){
								$bulan_terakhir = 'Juli';
							  }else if($jumlah_bulan == 8 || $jumlah_bulan == 20 || $jumlah_bulan == 32){
								$bulan_terakhir = 'Agustus';
							  }else if($jumlah_bulan == 9 || $jumlah_bulan == 21 || $jumlah_bulan == 33){
								$bulan_terakhir = 'September';
							  }else if($jumlah_bulan == 10 || $jumlah_bulan == 22 || $jumlah_bulan == 34){
								$bulan_terakhir = 'Oktober';
							  }else if($jumlah_bulan == 11 || $jumlah_bulan == 23 || $jumlah_bulan == 35){
								$bulan_terakhir = 'November';
							  }else if($jumlah_bulan == 12 || $jumlah_bulan == 24 || $jumlah_bulan == 36){
								$bulan_terakhir = 'Desember';
							}else{
								$bulan_terakhir = 'Belum Bayar Sama Sekali';
							}


							if($jumlah_bulan > 0 && $jumlah_bulan < 13){
								$tahun_terakhir = 'Tahun Ke 1 (Pertama)';
							}else if($jumlah_bulan > 12 && $jumlah_bulan < 25){
								$tahun_terakhir = 'Tahun Ke 2 (Dua)';
							}else if($jumlah_bulan > 24 && $jumlah_bulan < 37){
								$tahun_terakhir = 'Tahun Ke 3 (Tiga)';
							}else{
								$tahun_terakhir = '';
							}

							if($jumlah_bulan > 0 && $jumlah_bulan < 36){
								$ket_pembayaran = 'Pembayaran terakhir bulan '.$bulan_terakhir.' di '.$tahun_terakhir.' atau '.$jumlah_bulan.' Bulan.';
							}else if($jumlah_bulan == 36){
								$ket_pembayaran = 'NIS tersebut sudah membayar seluruh pembayaran SPP selama 3 Tahun.';
							}else{
								$ket_pembayaran = 'Belum Bayar';
							}
						?>
						Keterangan<p style="color: red;"><?php echo $ket_pembayaran; ?></p>
					</div>
					<form method="post" action="<?php echo site_url('Pembayaran/Pembayaran_SPP/'.$data_siswa->nisn) ?>" class="form-group">
						<?php if($jumlah_bulan >= 0 && $jumlah_bulan < 36){ ?>
							Jumlah Bulan Dibayar
							<select name="bulan" required="" class="form-control col-md-9">
								<option value="">- Pilih Berapa Bulan</option>
								<option value="1">1 Bulan</option>
								<option value="2">2 Bulan</option>
								<option value="3">3 Bulan</option>
								<option value="4">4 Bulan</option>
								<option value="5">5 Bulan</option>
								<option value="6">6 Bulan</option>
								<option value="7">7 Bulan</option>
								<option value="8">8 Bulan</option>
								<option value="9">9 Bulan</option>
								<option value="10">10 Bulan</option>
								<option value="11">11 Bulan</option>
								<option value="12">12 Bulan</option>
							</select><br>
							<p><input type="checkbox" name="status_siswa" value="siswa pindahan">&nbsp;&nbsp;Siswa Pindahan</p>
							<input type="hidden" name="id_spp" value="<?php echo $data_siswa->id_spp; ?>">
						<button class="btn btn-sm btn-success">Simpan Pembayaran</button>
						<?php } ?>
						
					</form>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>