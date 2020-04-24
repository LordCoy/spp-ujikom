<!DOCTYPE html>
<html>
<head>
	<title>Profile | SPP</title>
</head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">
		<h5>Ubah Password</h5><br>
		<?php if (!empty($this->session->flashdata('error_second_input'))) :?>
   				 <div class="alert alert-warning">
       				 <p> Password Baru Tidak Sesuai !!! </p>
   				 </div>
			<?php endif ?>
			<?php if (!empty($this->session->flashdata('error_oldpass_input'))) :?>
   				 <div class="alert alert-warning">
       				 <p> Password Lama Salah !!! </p>
   				 </div>
			<?php endif ?>
		<form method="post" action="<?php echo site_url('Admin/Proses_Ubah_Password') ?>" class="form-group col-md-6">
			Password Lama :
			<input type="password" name="pass_lama" required="" placeholder="Masukan Password Lama..." class="form-control">
			Password Baru :
			<input type="password" name="pass_baru" required="" placeholder="Masukan Password Baru..." class="form-control">
			Masukan Ulang  :
			<input type="password" name="pass_baru2" required="" placeholder="Masukan Ulang Password Baru..." class="form-control"><br>
			<button class="btn btn-sm btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Simpan</button>
		</form>
	</div>

	<br><br><br><br><br>
</body>
</html>