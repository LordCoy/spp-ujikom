<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/logo2.png') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Vpertama.css') ?>">

	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/bootstrap.min.js') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/jquery-3.2.1.js') ?>">
</head>
	<body>
	<center>

    <div class="card" id="card-login">
    	<div class="box">
        	<form method="post" class="form-signin" action="<?php echo site_url('Siswa/Proses_Login') ?>" class="form-group">
                <img src="<?php echo base_url('assets/img/logo.png') ?>">
                 <?php if (!empty($this->session->flashdata('error_login1'))) :?>
                 <div class="alert alert-warning">
                     <p> Username atau Password Salah !!! </p>
                 </div>
            <?php endif ?>
                <div class="form-group">
                    <input type="text" name="nis" placeholder="Masukan NIS" required="" class="form-control"><br>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password..." required="" class="form-control"><br>
                </div>
                <button class="btn btn-lg btn-block" style="background-color: #0000FF;" type="submit"><a style="color: #fff">Login</a>
                    </button>    
            </form>
            <div class="or-box">
                    <span class="or">Login Sebagai &nbsp;<i class="fa fa-user"></i>Siswa</span>
                    <div class="row">
                  <div class="col-md row-block">
                         <a style="color: black;" class="nav-link" href="<?php echo site_url('Admin') ?>"><i class="fa fa-arrow-left"></i>&nbsp;Kembali&nbsp;&nbsp;</a>
                   </div>
        </div>
    </div>
</center>
</body>


</html>