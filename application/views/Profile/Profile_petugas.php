<!DOCTYPE html>
<html>
<head>
	<title>Profile | SPP</title>
</head>
<body>
	<br><br><br><br>

	<div class="content-home" style="align-content: left; margin-left: 5%; margin-right: 5%;">

		<div class="card">
			<h5 class="card-header">Profile</h5>
				
			<div class="container" style="text-align: left;"><br>
				<div class="row">
					<div class="col">
						<p>Nama Petugas</p>
					</div>
					<div class="col" style="max-width: 5px;">
						:
					</div>
					<div class="col">
						<p class="card-text"><?php echo $profile->nama_petugas; ?></p>
					</div>
				</div>
					
				<div class="row">
					<div class="col">
						<p>Username</p>
					</div>
					<div class="col" style="max-width: 5px;">
						:
					</div>
					<div class="col">
						<p class="card-text"><?php echo $profile->username; ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<p>Level</p>
					</div>
					<div class="col" style="max-width: 5px;">
						:
					</div>
					<div class="col">
						<p class="card-text"><?php echo $profile->level; ?></p>
					</div>
				</div>

				<br>

				<a href="<?php echo site_url('Admin/Edit_Profile') ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit Profile</a>&nbsp;&nbsp;
				<a href="<?php echo site_url('Admin/Ubah_Password') ?>" class="btn btn-sm btn-primary"><i class="fa fa-lock"></i>&nbsp;&nbsp;Ubah Password</a>

				<br><br>

			</div>
		</div>
		<br><br>
		<a href="<?php echo site_url('Petugas/Logout') ?>" class="btn btn-sm btn-danger"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Logout</a>
	</div>
</body>
</html>