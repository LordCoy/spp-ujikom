<!DOCTYPE html>
<html>
<head>
	<title>Ubah Password | SPP</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Siswa/Account/Ubah_Password.css') ?>">
</head>
<body>
	<br><br><br><br>

	<center>
		<div class="container col-md-8">
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
			<form method="post" action="<?php echo site_url('Siswa/Proses_Ubah_Password') ?>" class="form-group col-md-6">
				<br><p>Password Lama :</p>
				<input type="password" name="pass_lama" required="" placeholder="Masukan Password Lama..." class="form-control">
				<br><p>Password Baru :</p>
				<input type="password" name="pass_baru" required="" placeholder="Masukan Password Baru..." class="form-control">
				<br><p>Masukan Ulang  :</p>
				<input type="password" name="pass_baru2" required="" placeholder="Masukan Ulang Password Baru..." class="form-control"><br>
				<button class="btn btn-sm btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Simpan</button>
				<br><br>
			 	<a style="color: black;" class="nav-link" href="<?php echo site_url('Siswa/Profile') ?>">
			 		<i class="fa fa-arrow-left"></i>&nbsp;Kembali&nbsp;&nbsp;
			 	</a>

			</form>
		</div>
	</center>

	<br><br><br><br><br>
</body>
</html>