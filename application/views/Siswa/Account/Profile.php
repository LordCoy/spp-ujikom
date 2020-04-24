<!DOCTYPE html>
<html>
<head>
	<title>Profile | SPP</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Siswa/Account/Profile.css') ?>">
</head>
<body>
	<br><br><br><br>

	<center>
		<div class="container col-md-8">
			<div class="card">
				<h5 class="card-header">Profile</h5>
				
				<div class="container" style="text-align: left;"><br>
					<div class="row">
						<div class="col">
							<p>NISN</p>
						</div>
						<div class="col" style="max-width: 5px;">
							:
						</div>
						<div class="col">
							<p class="card-text"><?php echo $profile->nisn; ?></p>
						</div>
					</div>
					
					<div class="row">
						<div class="col">
							<p>NIS</p>
						</div>
						<div class="col" style="max-width: 5px;">
							:
						</div>
						<div class="col">
							<p class="card-text"><?php echo $profile->nis; ?></p>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<p>Nama Lengkap</p>
						</div>
						<div class="col" style="max-width: 5px;">
							:
						</div>
						<div class="col">
							<p class="card-text"><?php echo $profile->nama; ?></p>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<p>Kelas</p>
						</div>
						<div class="col" style="max-width: 5px;">
							:
						</div>
						<div class="col">
							<p class="card-text"><?php echo $profile->nama_kelas.' '.$profile->kompetensi_keahlian; ?></p>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<p>Nomor Telepon</p>
						</div>
						<div class="col" style="max-width: 5px;">
							:
						</div>
						<div class="col">
							<p class="card-text"><?php echo $profile->no_telp; ?></p>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<p>Alamat</p>
						</div>
						<div class="col" style="max-width: 5px;">
							:
						</div>
						<div class="col">
							<p class="card-text"><?php echo $profile->alamat ?></p>
						</div>
					</div>
				</div>
			</div>
			<br>
			<a href="<?php echo site_url('Siswa/Ubah_Password') ?>" class="btn btn-primary"><i class="fa fa-lock"></i>&nbsp;&nbsp;Ubah Password</a>
			<br><br>
			<a href="<?php echo site_url('Siswa/Logout') ?>" class="btn btn-danger"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Logout</a>
			<br><br>
			 <a style="color: black;" class="nav-link" href="<?php echo site_url('Siswa/Home') ?>"><i class="fa fa-arrow-left"></i>&nbsp;Kembali&nbsp;&nbsp;</a>

		</div>
	</center>

	<br><br><br><br><br>
</body>
</html>