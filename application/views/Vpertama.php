<!DOCTYPE html>
<html>
<head>
	<title>E - SPP</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/logo2.png') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Vpertama.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/bootstrap.min.js') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/jquery-3.2.1.js') ?>">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<center>
    <div class="card" id="card-login">
    	<div class="box">
        	<form class="form-signin" action="#">
                <img src="<?php echo base_url('assets/img/logo.png') ?>">
            <fieldset disabled>	
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="---------" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="---------" />
                </div>
                <button class="btn btn-lg btn-block" style="background-color: #0000FF;" type="submit"><a style="color: #fff">Login</a>
                    </button> 
            </fieldset>    
            </form>
            <div class="or-box">
                    <span class="or">Login Sebagai</span>
                    <div class="row">
                  <div class="col-md-6 row-block">
                         <a style="color: black;" class="nav-link" href="<?php echo site_url('Petugas') ?>"><i class="fa fa-user-secret"></i>&nbsp;Admin&nbsp;&nbsp;</a>
                   </div>
                   <div class="col-md-6 row-block">
                        <a style="color: black;" class="nav-link" href="<?php echo site_url('Siswa/Login_Siswa') ?>"><i class="fa fa-user"></i>&nbsp;Siswa &nbsp;&nbsp;</a>
                   </div>
                    </div>
            </div>
        </div>
    </div>
</center>
</body>
</html>