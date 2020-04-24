<!DOCTYPE html>
<html>
<head>
	<title>Data Pembayaran | SPP</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Siswa/Home.css') ?>">
</head>
<body>
	<br><br>
	<center><h5>Data Pembayaran SPP</h5></center><br>

	<center>
	<?php $bulan 	= array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'); ?>
		<div class="container" style="border: 1px solid rgba(2,2,2,.1);border-radius: 2px;">
			<div class="row">
				<div class="col"><br>
					<center><h6>Tahun Ke 1</h6></center><br>

					<div class="container">
					<?php  
						for ($i=0; $i < 12; $i++) { 
							$cek1 = count((array)$spp_tahun1[$i]);
							if($cek1 > 0){ ?>

						<div class="row" style="width: 100%;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;background: rgba(200,200,200,.1);margin-bottom: 5px;padding-top: 10px;">
							<div class="col">
								<p style="text-align: left;"><?php echo $bulan[$i]; ?></p>
							</div>
							<div class="col">
								<small>Rp.<?php echo $spp_tahun1[$i]->jumlah_bayar; ?>;</small>
							</div>
							<div class="col">
								<p><i class="fa fa-check" style="color: green;font-size: 25px;"></i></p>
							</div>
						</div>
								
					<?php	}else{ ?>

						<div class="row" style="width: 100%;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;margin-bottom: 5px;padding-top: 10px;">
							<div class="col">
								<p style="text-align: left;"><?php echo $bulan[$i]; ?></p>
							</div>
							<div class="col" style="text-align: right;">
								<small>Belum</small>
							</div>
						</div>

					<?php	}
						}
					?>
					</div>
					<br><br>
				</div>

			<!-- tidak naik ke kelas XI atau tidak naik dua kali -->
			<?php if($ket_TN['status'] == 'tidak naik ke kelas XI' || $ket_TN['status'] == 'tidak naik dua kali'){ ?>

				<div class="col"><br>
					<center><h6>Tahun Ke 1 (Tidak naik)</h6></center><br>

					<div class="container">
					<?php  
						for ($i=0; $i < 12; $i++) { 
							$cek_TN2 = count((array)$spp_TN2[$i]);
							if($cek_TN2 > 0){ ?>

						<div class="row" style="width: 100%;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;background: rgba(200,200,200,.1);margin-bottom: 5px;padding-top: 10px;">
							<div class="col">
								<p style="text-align: left;"><?php echo $bulan[$i]; ?></p>
							</div>
							<div class="col">
								<small>Rp.<?php echo $spp_TN2[$i]->jumlah_bayar; ?>;</small>
							</div>
							<div class="col">
								<p><i class="fa fa-check" style="color: green;font-size: 25px;"></i></p>
							</div>
						</div>
								
					<?php	}else{ ?>

						<div class="row" style="width: 100%;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;margin-bottom: 5px;padding-top: 10px;">
							<div class="col">
								<p style="text-align: left;"><?php echo $bulan[$i]; ?></p>
							</div>
							<div class="col" style="text-align: right;">
								<small>Belum</small>
							</div>
						</div>

					<?php	}
						} ?>
					</div>
					<br><br>
				</div>

			<?php } ?>

				<div class="col"><br>
					<center><h6>Tahun Ke 2</h6></center><br>

					<div class="container">
					<?php  
						for ($i=0; $i < 12; $i++) { 
							$cek2 = count((array)$spp_tahun2[$i]);
							if($cek2 > 0){ ?>
								
						<div class="row" style="width: 100%;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;background: rgba(200,200,200,.1);margin-bottom: 5px;padding-top: 10px;">
							<div class="col">
								<p style="text-align: left;"><?php echo $bulan[$i]; ?></p>
							</div>
							<div class="col">
								<small>Rp.<?php echo $spp_tahun2[$i]->jumlah_bayar; ?>;</small>
							</div>
							<div class="col">
								<p><i class="fa fa-check" style="color: green;font-size: 25px;"></i></p>
							</div>
						</div>

					<?php	}else{ ?>
							
						<div class="row" style="width: 100%;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;margin-bottom: 5px;padding-top: 10px;">
							<div class="col">
								<p style="text-align: left;"><?php echo $bulan[$i]; ?></p>
							</div>
							<div class="col" style="text-align: right;">
								<small>Belum</small>
							</div>
						</div>

					<?php 	}
						}
					?>
					</div>
					<br><br>
				</div>

			<!-- tidak naik ke kelas XII -->
			<?php if($ket_TN['status'] == 'tidak naik ke kelas XII' || $ket_TN['status'] == 'tidak naik dua kali'){ ?>

				<div class="col"><br>
					<center><h6>Tahun Ke 2 (Tidak naik)</h6></center><br>

					<div class="container">
					<?php  
						for ($i=0; $i < 12; $i++) { 
							$cek_TN3 = count((array)$spp_TN3[$i]);
							if($cek_TN3 > 0){ ?>

						<div class="row" style="width: 100%;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;background: rgba(200,200,200,.1);margin-bottom: 5px;padding-top: 10px;">
							<div class="col">
								<p style="text-align: left;"><?php echo $bulan[$i]; ?></p>
							</div>
							<div class="col">
								<small>Rp.<?php echo $spp_TN3[$i]->jumlah_bayar; ?>;</small>
							</div>
							<div class="col">
								<p><i class="fa fa-check" style="color: green;font-size: 25px;"></i></p>
							</div>
						</div>
								
					<?php	}else{ ?>

						<div class="row" style="width: 100%;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;margin-bottom: 5px;padding-top: 10px;">
							<div class="col">
								<p style="text-align: left;"><?php echo $bulan[$i]; ?></p>
							</div>
							<div class="col" style="text-align: right;">
								<small>Belum</small>
							</div>
						</div>

					<?php	}
						} ?>
					</div>
					<br><br>
				</div>

			<?php } ?>

				<div class="col"><br>
					<center><h6>Tahun Ke 3</h6></center><br>

					<div class="container">
					<?php  
						for ($i=0; $i < 12; $i++) { 
							$cek3 = count((array)$spp_tahun3[$i]);
							if($cek3 > 0){ ?>

						<div class="row" style="width: 100%;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;background: rgba(200,200,200,.1);margin-bottom: 5px;padding-top: 10px;">
							<div class="col">
								<p style="text-align: left;"><?php echo $bulan[$i]; ?></p>
							</div>
							<div class="col">
								<small>Rp.<?php echo $spp_tahun3[$i]->jumlah_bayar; ?>;</small>
							</div>
							<div class="col">
								<p><i class="fa fa-check" style="color: green;font-size: 25px;"></i></p>
							</div>
						</div>

					<?php	}else{ ?>

						<div class="row" style="width: 100%;border-radius: 2px;border: 1px solid rgba(2,2,2,.1);color: #333;margin-bottom: 5px;padding-top: 10px;">
							<div class="col">
								<p style="text-align: left;"><?php echo $bulan[$i]; ?></p>
							</div>
							<div class="col" style="text-align: right;">
								<small>Belum</small>
							</div>
						</div>

					<?php	}
						}
					?>
					</div>
					<br><br>
				</div>
			</div>
			
			<div class="row" style="border: 1px solid rgba(2,2,2,.1);border-radius: 2px;padding-top: 12px;">
				<div class="col">
					<p style="text-align: right;"><b>Total Pembayaran :</b></p>
				</div>
				<div class="col">
					<?php 
						$total = 0;
						foreach($ambil_spp as $as){
							$total = $total+$as['jumlah_bayar'];
						}
					?>
					<p style="text-align: left;"><b>Rp.<?php echo $total; ?>;</b></p>
				</div>
			</div>

		</div>
			<br><br>
			 <a style="color: black;" class="nav-link" href="<?php echo site_url('Siswa/Home') ?>">
			 	<i class="fa fa-arrow-left"></i>&nbsp;Kembali&nbsp;&nbsp;
			 </a>

	</center>

	<br><br><br><br>
</body>
</html>