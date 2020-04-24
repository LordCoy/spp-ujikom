<!DOCTYPE html>
<html>
<head>
	<title>Profile | SPP</title>
</head>
<body>
	<br><br><br><br>

	<div class="content-home"style="align-content: left; margin-left: 5%; margin-right: 5%;">
		<h5>Edit Profile</h5><br>
		<form method="post" action="<?php echo site_url('Admin/Proses_Edit_Profile_Petugas/'.$edit->id_petugas) ?>" class="form-group col-md-6">
			Nama Petugas :
			<input type="text" name="nama" required="" placeholder="Nama Petugas..." value="<?php echo $edit->nama_petugas ?>" class="form-control">
			Username :
			<input type="text" name="username" required="" placeholder="Username..." value="<?php echo $edit->username ?>" class="form-control"><br>
			<button class="btn btn-sm btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Simpan</button>
		</form>
	</div>

	<br><br><br><br><br>
</body>
</html>