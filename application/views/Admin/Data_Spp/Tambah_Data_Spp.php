<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data SPP | SPP</title>
</head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">
		<h5>Input Data SPP</h5><br>
		<form method="post" action="<?php echo site_url('Admin/Proses_Tambah_Data_Spp') ?>" class="form-group col-md-6">
			Tahun Ke :
			<input type="text" name="tahun" required="" placeholder="Tahun..." class="form-control">
			Nominal 1 Tahun :
			<input type="text" name="nominal" required="" placeholder="Nominal..." class="form-control"><br>
			<button class="btn btn-sm btn-success">Tambah</button>
		</form>
	</div>
</body>
</html>