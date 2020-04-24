<!DOCTYPE html>
<html>
<head>
	<title>Home Petugas | SPP</title>
</head>
<body>
	<?php if($this->session->userdata('id_petugas') == ''){ ?>
		Silahkan Login terlebih dahulu! <a href="<?php echo site_url('Petugas') ?>">Login</a>
	<?php }else{ ?>
		<?php if($this->session->userdata('level') == 'petugas'){ ?>
			<a href="<?php echo site_url('Pembayaran/Pencarian_Data_Siswa') ?>">Input Pembayaran</a>
			<a href="<?php echo site_url('Pembayaran/Data_Pembayaran_SPP') ?>">Data Pembayaran</a>
			<a href="<?php echo site_url('Petugas/Profile') ?>">Profile</a>
		<?php }else{ ?>
			Silahkan Login terlebih dahulu! <a href="<?php echo site_url('Petugas') ?>">Login</a>
		<?php } ?>
	<?php } ?>
</body>
</html>