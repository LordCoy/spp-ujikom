<!DOCTYPE html>
<html>
<head>
	<title>Ubah Nominal Pembayaran SPP</title>
</head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">
		<h5>Ubah Nominal Pembayaran SPP</h5><br>
		<form method="post" action="<?php echo site_url('Pembayaran/Proses_Ubah_Nominal_SPP') ?>" class="form-group col-md-6">
			<?php foreach($data as $d){ ?>
			<div class="form-group">
				<input type="checkbox" name="tahun" value="<?php echo $d['tahun']; ?>">&nbsp;&nbsp;<?php echo 'Tahun Ke '.$d['tahun']; ?>
			</div>
			<?php } ?>
			<input type="text" name="nominal" placeholder="Masukan Nominal Perbulan..." required="" class="form-control"><br>
			<button class="btn btn-sm btn-success">Simpan</button>
		</form>
	</div>
</body>
</html>