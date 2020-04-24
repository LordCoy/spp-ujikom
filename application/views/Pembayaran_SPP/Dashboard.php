<!DOCTYPE html>
<html>
<head>
	<title>Data Pembayaran SPP </title>
</head>
<body>
	<br><br><br><br>

	<div style="align-content: left; text-align: center; margin-left: 6.5%; margin-right: 5%;">
	<h5>Dashboard</h5><br>

	<?php $total_uang = 0;
		foreach($seluruh_pembayaran as $sp){
			$total_uang = $total_uang+$sp['jumlah_bayar'];
		}
	?>
	Total pembayaran SPP
	<h1 style="color: blue;"><?php echo 'Rp.'.$total_uang.';'; ?></h1>
	<p><i class="fa fa-check" style="color: blue;"></i>&nbsp;&nbsp; Dari <?php echo $siswa_bayar; ?> Siswa yang sudah bayar.</p>
	<p><i class="fa fa-asterisk"></i>&nbsp;&nbsp; <?php echo $siswa_belum_bayar; ?> Siswa yang belum membayar sama sekali.</p>

	</div>
	<br><br><br>
</body>
</html>