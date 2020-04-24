<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran SPP | SPP</title>
	
</head>
<body>

		<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;width: 300px;border: 1px solid red;">
			<div>
				<?php 
					$data_bulan_nama  = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

					foreach($ambil1 as $a1){
						$cek = count($a1);
						if($cek > 0){
							echo $data_bulan_nama[$a1->bulan_dibayar].' sudah status = '.$a1->status_siswa.'<br>';
						}else{
							echo 'belum status = <br>';
						}
					}
				?>
			</div>
		</div>

		<!-- <div class="content-home" style="width: 300px;border: 1px solid red;left: 25%;top: 0;position: absolute;">
			<div>
				<?php 
					foreach($ambil2 as $a2){
						$cek = count($a2);
						if($cek > 0){
							echo 'sudah    ';
						}else{
							echo 'belum    ';
						}
					}
				?>
			</div>
		</div> -->

</body>
</html>