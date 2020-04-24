<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran SPP | SPP</title>

</head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">
		<h5>Data Siswa</h5><br>

		<!-- Data Siswa -->
		<div class="card">
			<div class="container">
				<div class="row" style="margin-top: 10px;margin-bottom: 10px;color: #444;">
					<div class="col">
						<?php 
						if($data_siswa->id_spp == 4){
							$spp = '<p class="card-text" style="color: red;"><b>Belum bayar</b></p>';
						}else{
							$spp = '<p class="card-text" style="color: red;"><b>Tahun Ke '.$data_siswa->id_spp.'</b></p>';
						}

						if(!empty($data_siswa->status_siswa)){
							$status_siswa = '<tr>
												<td>Status Siswa</td>
												<td style="width: 30px;text-align: center;">:</td>
												<td><b>'.$data_siswa->status_siswa.'</b></td>
											</tr>';
						}else{
							$status_siswa = '';
						}

						 ?>
						
						<table>
							<tr>
								<td>NISN</td>
								<td style="width: 30px;text-align: center;">:</td>
								<td><?php echo $data_siswa->nisn; ?></td>
							</tr>
							<tr>
								<td>NIS</td>
								<td style="width: 30px;text-align: center;">:</td>
								<td><?php echo $data_siswa->nis; ?></td>
							</tr>
							<tr>
								<td>Kelas</td>
								<td style="width: 30px;text-align: center;">:</td>
								<td><?php echo $data_siswa->nama_kelas.' '.$data_siswa->kompetensi_keahlian; ?></td>
							</tr>
							<tr>
								<td>SPP</td>
								<td style="width: 30px;text-align: center;">:</td>
								<td><?php echo $spp; ?></td>
							</tr>
							<?php echo $status_siswa; ?>
						</table>

					</div>

					<div class="col">
						
						<table>
							<tr>
								<td>Nama Lengkap</td>
								<td style="width: 30px;text-align: center;">:</td>
								<td><p class="card-text"><b><?php echo $data_siswa->nama; ?></b></p></td>
							</tr>
							<tr>
								<td>Tempat, Tanggal Lahir</td><td style="width: 30px;text-align: center;">:</td>
								<td><?php echo $data_siswa->tempat.', '.$data_siswa->tgl_lahir; ?></td>
							</tr>
							<tr>
								<td>Alamat</td><td style="width: 30px;text-align: center;">:</td>
								<td><?php echo $data_siswa->alamat; ?></td>
							</tr>
							<tr>
								<td>No Telepon</td><td style="width: 30px;text-align: center;">:</td>
								<td><?php echo $data_siswa->no_telp; ?></td>
							</tr>
						</table>

					</div>
				</div>
			</div>
		</div>

		<center><br>
			<h5>Pembayaran SPP</h5><br>
		</center>

		<div class="row">
			<div class="col"> 
				<center>
					<h6 style="padding: 10px;">Tahun Ke 1</h6>
				</center>

				<div class="container">
					<?php 
						$no 				= array('0','1','2','3','4','5','6','7','8','9','10','11');
						$data_bulan_nomor 	= array('1','2','3','4','5','6','7','8','9','10','11','12');
						$data_bulan_nama  	= array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

						foreach($no as $bn){
							$hitung = count((array)$ambil1[$bn]);

							if($hitung > 0){  ?>

							<div class="row" style="margin: 3px 0 3px 0;padding-top: 10px;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;background: rgba(200,200,200,.1);">
								<div class="col-md-4">
									<p style="text-align: left;"><?php echo $data_bulan_nama[$bn]; ?></p>
								</div>
								<div class="col">
									<small><?php echo $ambil1[$bn]->status_pembayaran_siswa; ?></small>
								</div>
								<div class="col-md-2">
									<p style="color: green;"><i class="fa fa-check"></i></p>
								</div>
							</div>

						<?php
							}else{ ?>

							<form method="post" action="<?php echo site_url('Pembayaran/Proses_Bayar_SPP') ?>">
		 						<div class="row" style="margin: 3px 0 3px 0;padding-top: 10px;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;">
		 							<div class="col-md-5">
		 								<p style="text-align: left;"><?php echo $data_bulan_nama[$bn]; ?></p>
		 								<input type="hidden" name="nisn" value="<?php echo $data_siswa->nisn ?>">
		 								<input type="hidden" name="nis" value="<?php echo $data_siswa->nis ?>">
		 								<input type="hidden" name="bulan" value="<?php echo $data_bulan_nomor[$bn]; ?>">
		 								<input type="hidden" name="id_spp" value="1">
		 							</div>
		 							<div class="col">
		 							</div>
		 							<div class="col">
		 								<button class="btn btn-sm btn-success">Bayar</button>
		 							</div>
		 						</div>
		 					</form>

						<?php		
							}
						}
					?>
				</div>
			</div>
				<?php 
					if($ket_TN['status'] == 'tidak naik ke kelas XI' || $ket_TN['status'] == 'tidak naik 2 kali'){ ?>
					<div class="col">
						<center>
							<h6 style="padding: 10px;">Tahun Ke 1 (Tidak Naik)</h6>
						</center>

						<div class="container">
					<?php foreach($no as $no_TN2){
							$hitungTN2 = count($TN2[$no_TN2]);
							if($hitungTN2 > 0){ ?>
								<div class="row" style="margin: 3px 0 3px 0;padding-top: 10px;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;background: rgba(200,200,200,.1);">
									<div class="col-md-4">
										<p style="text-align: left;"><?php echo $data_bulan_nama[$no_TN2]; ?></p>
									</div>
									<div class="col">
										<small><?php echo $TN2[$no_TN2]->status_pembayaran_siswa; ?></small>
									</div>
									<div class="col-md-2">
										<p style="color: green;"><i class="fa fa-check"></i></p>
									</div>
								</div>
					<?php 	}else{ ?>

								<form method="post" action="<?php echo site_url('Pembayaran/Proses_Bayar_SPP_TN') ?>">
			 						<div class="row" style="margin: 3px 0 3px 0;padding-top: 10px;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;">
			 							<div class="col-md-5">
			 								<p style="text-align: left;"><?php echo $data_bulan_nama[$no_TN2]; ?></p>
			 								<input type="hidden" name="nisn" value="<?php echo $data_siswa->nisn ?>">
			 								<input type="hidden" name="nis" value="<?php echo $data_siswa->nis ?>">
			 								<input type="hidden" name="bulan" value="<?php echo $data_bulan_nomor[$no_TN2]; ?>">
			 								<input type="hidden" name="id_spp" value="1">
			 							</div>
			 							<div class="col">
			 								<input type="hidden" name="status_siswa" value="<?php echo $data_siswa->status_siswa; ?>">
			 							</div>
			 							<div class="col">
			 								<button class="btn btn-sm btn-success">Bayar</button>
			 							</div>
			 						</div>
			 					</form>

					<?php 	}
						} ?>
						</div>
					</div>
			<?php	} ?>
			<div class="col">
				<center>
					<h6 style="padding: 10px;">Tahun Ke 2</h6>
				</center>

				<div class="container">
					<?php 
						foreach($no as $bn2){
							$hitung2 = count((array)$ambil2[$bn2]);

							if($hitung2 > 0){  ?>

							<div class="row" style="margin: 3px 0 3px 0;padding-top: 10px;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;background: rgba(200,200,200,.1);">
								<div class="col-md-4">
									<p style="text-align: left;"><?php echo $data_bulan_nama[$bn2]; ?></p>
								</div>
								<div class="col">
									<small><?php echo $ambil2[$bn2]->status_pembayaran_siswa; ?></small>
								</div>
								<div class="col-md-2">
									<p style="color: green;"><i class="fa fa-check"></i></p>
								</div>
							</div>

						<?php
							}else{ ?>

							<form method="post" action="<?php echo site_url('Pembayaran/Proses_Bayar_SPP') ?>">
		 						<div class="row" style="margin: 3px 0 3px 0;padding-top: 10px;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;">
		 							<div class="col-md-5">
		 								<p style="text-align: left;"><?php echo $data_bulan_nama[$bn2]; ?></p>
		 								<input type="hidden" name="nisn" value="<?php echo $data_siswa->nisn ?>">
		 								<input type="hidden" name="nis" value="<?php echo $data_siswa->nis ?>">
		 								<input type="hidden" name="bulan" value="<?php echo $data_bulan_nomor[$bn2]; ?>">
		 								<input type="hidden" name="id_spp" value="2">
		 							</div>
		 							<div class="col">
		 							</div>
		 							<div class="col">
		 								<?php if($numrows_1 < 12){ ?>
		 								<?php }else{ ?>
		 									<button class="btn btn-sm btn-success">Bayar</button>
		 								<?php } ?>
		 							</div>
		 						</div>
		 					</form>

						<?php		
							}
						}
					?>
				</div>
			</div>

			<?php 
					if($ket_TN['status'] == 'tidak naik ke kelas XII' || $ket_TN['status'] == 'tidak naik 2 kali'){ ?>
					<div class="col">
						<center>
							<h6 style="padding: 10px;">Tahun Ke 2 (Tidak Naik)</h6>
						</center>

						<div class="container">
					<?php foreach($no as $no_TN3){
							$hitungTN2 = count($TN3[$no_TN3]);
							if($hitungTN2 > 0){ ?>
								<div class="row" style="margin: 3px 0 3px 0;padding-top: 10px;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;background: rgba(200,200,200,.1);">
									<div class="col-md-4">
										<p style="text-align: left;"><?php echo $data_bulan_nama[$no_TN3]; ?></p>
									</div>
									<div class="col">
										<small><?php echo $TN3[$no_TN3]->status_pembayaran_siswa; ?></small>
									</div>
									<div class="col-md-2">
										<p style="color: green;"><i class="fa fa-check"></i></p>
									</div>
								</div>
					<?php 	}else{ ?>

								<form method="post" action="<?php echo site_url('Pembayaran/Proses_Bayar_SPP_TN') ?>">
			 						<div class="row" style="margin: 3px 0 3px 0;padding-top: 10px;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;">
			 							<div class="col-md-5">
			 								<p style="text-align: left;"><?php echo $data_bulan_nama[$no_TN3]; ?></p>
			 								<input type="hidden" name="nisn" value="<?php echo $data_siswa->nisn ?>">
			 								<input type="hidden" name="nis" value="<?php echo $data_siswa->nis ?>">
			 								<input type="hidden" name="bulan" value="<?php echo $data_bulan_nomor[$no_TN3]; ?>">
			 								<input type="hidden" name="id_spp" value="2">
			 							</div>
			 							<div class="col">
			 								<input type="hidden" name="status_siswa" value="<?php echo $data_siswa->status_siswa; ?>">
			 							</div>
			 							<div class="col">
			 								<button class="btn btn-sm btn-success">Bayar</button>
			 							</div>
			 						</div>
			 					</form>

					<?php 	}
						}?>
						</div>
					</div>
			<?php	} ?>

			<div class="col">
				<center>
					<h6 style="padding: 10px;">Tahun Ke 3</h6>
				</center>

				<div class="container">
					<?php 
						foreach($no as $bn3){
							$hitung3 = count((array)$ambil3[$bn3]);

							if($hitung3 > 0){  ?>

							<div class="row" style="margin: 3px 0 3px 0;padding-top: 10px;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;background: rgba(200,200,200,.1);">
								<div class="col-md-4">
									<p style="text-align: left;"><?php echo $data_bulan_nama[$bn3]; ?></p>
								</div>
								<div class="col">
									<small><?php echo $ambil3[$bn3]->status_pembayaran_siswa; ?></small>
								</div>
								<div class="col-md-2">
									<p style="color: green;"><i class="fa fa-check"></i></p>
								</div>
							</div>

						<?php
							}else{ ?>

							<form method="post" action="<?php echo site_url('Pembayaran/Proses_Bayar_SPP') ?>">
		 						<div class="row" style="margin: 3px 0 3px 0;padding-top: 10px;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;">
		 							<div class="col-md-5">
		 								<p style="text-align: left;"><?php echo $data_bulan_nama[$bn3]; ?></p>
		 								<input type="hidden" name="nisn" value="<?php echo $data_siswa->nisn ?>">
		 								<input type="hidden" name="nis" value="<?php echo $data_siswa->nis ?>">
		 								<input type="hidden" name="bulan" value="<?php echo $data_bulan_nomor[$bn3]; ?>">
		 								<input type="hidden" name="id_spp" value="3">
		 							</div>
		 							<div class="col">
		 							</div>
		 							<div class="col">
		 								<?php if($numrows_2 < 12){ ?>
		 								<?php }else{ ?>
		 									<button class="btn btn-sm btn-success">Bayar</button>
		 								<?php } ?>
		 							</div>
		 						</div>
		 					</form>

						<?php		
							}
						}
					?>
				</div>
			</div>
		</div>

	</div>

	<br><br><br>
</body>
</html>