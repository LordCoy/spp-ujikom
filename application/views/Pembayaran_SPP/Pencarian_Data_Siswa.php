<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran SPP | SPP</title>
</head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">
		<h5>Cari Data Siswa</h5><br>
		<form method="post" action="<?php echo site_url('Pembayaran/Cari_NIS_Pembayaran') ?>" class="form-group col-md-5">
			Masukan NIS Siswa :
			<input type="text" name="nis" required="" placeholder="NIS Siswa..." class="form-control"><br>
			<button class="btn btn-sm btn-success"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari</button>
		</form>
	</div>
</body>
</html>